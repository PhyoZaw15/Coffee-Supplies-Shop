<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
// use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_deleted', 0)->get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_deleted', 0)->get();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'brand_id' => 'required',
            'name' => 'required',
            'price' => 'required',
        ]);
        
        DB::beginTransaction();
        try {
            // Generate Product Code
            $latest_product = Product::select('sku_code')
                            ->where('category_id', $request->category_id)
                            ->latest()
                            ->first();
            
            $latest_number = $latest_product ? intval(substr($latest_product->sku_code, -4)) + 1 : 1;

            $category = Category::find($request->category_id);
            $sku_code = sprintf('%s-%04d', $category->code, $latest_number);
            $description = isset($request->description) ? $request->description : null;

            $product = Product::create([
                'sku_code' => $sku_code,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $description
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('products.index')->with('error', $e->getMessage());
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::where('is_deleted', 0)->get();
        $brands = Brand::all();
        return view('admin.product.edit', compact('categories', 'brands', 'product'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try { 

            $product = Product::find($id);
            $product->update($request->all());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect(route('products.index'))->with('success', 'Product updated successfully.');

    }

    public function destroy($id)
    {
        Product::find($id)->update([ 'is_deleted' => 1 ]);
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
