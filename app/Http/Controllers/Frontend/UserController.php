<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($fieldType, $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Authentication successful
            session(['user_id' => $user->id]);
            return redirect()->route('items.index'); // Redirect to items page after login
        }

        // Authentication failed
        return back()->with('error', 'Invalid credentials');
    }
}
