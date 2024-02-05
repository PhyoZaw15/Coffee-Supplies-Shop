<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_deleted', 0)->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Check your required fields');
        }

        $shop_code = $this->generateShopCode($request->name);
        $category = Category::create([
                        'name' => $request->name,
                        'code' => $shop_code,
                    ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Check your required fields');
        }

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect(route('categories.index'))->with('success', 'Category updated successfully.');

    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    public function generateShopCode($name)
    {
        // Get the first character of the name
        $firstCharacter = strtoupper(substr($name, 0, 1));

        // Get the initials of each word in the name
        $initials = implode('', array_map('ucfirst', preg_split('/\s+/', $name)));

        // Convert the initials to uppercase
        $remainingCharacters = strtoupper(substr($initials, 1));

        // Shuffle the remaining characters and take the first 2 (to make a total of 3 characters)
        $randomCharacters = substr(str_shuffle($remainingCharacters), 0, 2);

        // Combine the first character, random characters, and sort them in the order they appear
        $shopCode = $firstCharacter . $randomCharacters;
        $shopCode = implode('', array_unique(str_split($shopCode)));

        return $shopCode;
    }
}
