<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\Models\User;
use App\Models\Subscription;

use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('user_type', 'USER')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['user_type'] = 'USER';
    
        $user = User::create($input);
    
        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {    
        $input = $request->all();
        
        if(!empty($input['password'])) { 
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));    
        }
        
        $user = User::find($id);
        $user->update($input);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back();
    }

    public function subscriber()
    {
        $users = User::has('subscriptions')->get();
        return view('admin.users.subscriber', compact('users'));
    }

    public function subscriberDetails($id)
    {
        // $subscriber = Subscription::with(['user', 'products'])->where('user_id', $id)->latest()->get();
        $subscriber = \DB::select("
                        SELECT 
                            products.name as productName,
                            users.name as username, 
                            users.email as userEmail,
                            subscriptions.*
                        FROM subscriptions
                        JOIN users ON subscriptions.user_id = users.id
                        JOIN products ON subscriptions.product_id = products.id
                        WHERE users.id = ?
                    ", [$id]);
        // return $subscriber;
        return view('admin.users.subscriberDetails', compact('subscriber'));
    }
}
