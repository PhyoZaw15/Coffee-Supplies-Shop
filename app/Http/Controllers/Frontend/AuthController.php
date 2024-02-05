<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function goToLogin(){
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $user = User::where($fieldType, $request->username)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                session(['user_id' => $user->id]);
                return redirect()->route('frontend.products');
            } else {
                return redirect()->back()->with('error', 'Invalid Password!');
            }
        }
    
        return redirect()->back()->with('error', 'User not found!');
    }

    public function logout()
    {
        session()->forget('user_id');
        return redirect()->route('home');
    }
}
