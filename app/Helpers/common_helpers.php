<?php
use App\Models\Category;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Product;

function categoryList()
{
    $categories = Category::where('is_deleted', 0)->get();
    return $categories;
}

function isUserAuth()
{
    return session()->has('user_id');
}

function getUserInformation()
{
    if (isUserAuth()) {
        $userId = session('user_id');
        $user = User::find($userId);

        return $user;
    }

    return false;
}

function getUserInformationWithCart()
{
    if (isUserAuth()) {
        $user_id = session('user_id');
        $user = User::find($user_id);

        if (!$user) {
            return false;
        }

        $cart = session()->get('cart', []);

        // Get the user's specific cart based on user_id
        $userCart = isset($cart[$user_id]) ? $cart[$user_id] : [];

        return $userCart;
    }

    return false;
}

function calculateTotalAmount($cart)
{
    $user = getUserInformation();
    $totalAmount = 0;

    foreach ($cart as $item) {
        $subcriber = isSubscriber($user->id, $item['product_id']);
        if($subcriber['status'] == true) {
            $discount_percentage = $subcriber['discount_percentage'];
            $discount_price = $subcriber['discount_price'];

            $total_price = $discount_price * $item['quantity'];
        } else {
            $total_price = $item['price'] * $item['quantity'];
        }

        $totalAmount += $total_price;
    }

    return $totalAmount;
}

function isSubscriber($user_id, $product_id)
{
    $subscription = Subscription::where('user_id', $user_id)->where('product_id', $product_id)->latest()->first();

    if ($subscription != null) {

        $product = Product::find($product_id);

        if ($subscription->subscription_type == 'daily') {
            if ($subscription->created_at->isToday()) {

                $discount_percentage = 5;
                $discount_amount = ($discount_percentage / 100) * $product->price;

                return [
                    'status' => true,
                    'subscription_type' => 'daily',
                    'discount_percentage' => $discount_percentage,
                    'discount_price' => $product->price - $discount_amount
                ];
            } else {
                return [
                    'status' => false,
                    'discount_price' => 0
                ];
            }
        } else {
            if ($subscription->created_at->isCurrentMonth()) {

                $discount_percentage = 10;
                $discount_amount = ($discount_percentage / 100) * $product->price;

                return [
                    'status' => true,
                    'subscription_type' => 'monthly',
                    'discount_percentage' => $discount_percentage,
                    'discount_price' => $product->price - $discount_amount
                ];
            } else {
                return [
                    'status' => false,
                    'discount_price' => 0
                ];
            }
        }
        
    }
    
    return [
        'status' => false,
        'discount_price' => 0
    ];
}
