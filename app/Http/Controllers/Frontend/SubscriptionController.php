<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscription_type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Check your required fields');
        }

        if (isUserAuth()) {
            $user = getUserInformation();
            $user_id = $user->id;
        } else {
            return redirect()->back()->with('error', 'You need to login!');
        }

        $product_id = isset($request->product_id) ? $request->product_id : null;

        $product_ids = $request->product_ids;
        foreach ($product_ids as $product_id) {
            Subscription::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'subscription_type' => $request->subscription_type,
            ]);
        }

        return redirect()->route('frontend.products')->with('success', 'Successfully subscribed!');
    }

    public function goToSubscribe(){
        return view('frontend.cart.subscription');
    }
}
