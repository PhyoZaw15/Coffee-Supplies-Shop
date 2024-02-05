<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Default quantity is 1

        $product = Product::find($product_id);

        if (!$product) {
            return back()->with('error', 'Product not found!');
        }

        if (isUserAuth()) {
            $user = getUserInformation();
            $user_id = $user->id;
        } else {
            return back()->with('error', 'You need to login!');
        }

        $cart = session()->get('cart', []);

        if (!isset($cart[$user_id])) {
            $cart[$user_id] = [];
        }

        // Check if the product is already in the user's cart using array functions
        $productExists = array_filter($cart[$user_id], function ($item) use ($product_id) {
            return $item['product_id'] == $product_id;
        });

        // If the product is not in the user's cart, add it
        if (empty($productExists)) {
            $cart[$user_id][] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        } else {
            // If the product exists, update the quantity
            $cart[$user_id] = array_map(function ($item) use ($product_id, $quantity) {
                if ($item['product_id'] == $product_id) {
                    $item['quantity'] += $quantity;
                }
                return $item;
            }, $cart[$user_id]);
        }

        session()->put('cart', $cart);

        return redirect()->route('frontend.products')->with('success', 'Product added to cart successfully!');
    }

    public function goToCheckout()
    {
        return view('frontend.cart.cart');
    }

    public function removeFromCart($product_id)
    {
        $user_id = session('user_id');

        $cart = Session::get('cart', []);

        // Check if the product exists in the cart
        foreach ($cart[$user_id] as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart[$user_id][$key]);
                Session::put('cart', $cart);
                return redirect()->route('cart')->with('success', 'Product removed from cart successfully!');
            }
        }

        return redirect()->route('cart')->with('error', 'Product not found in cart!');
    }

    public function addQuantity($product_id)
    {
        $user_id = session('user_id');

        $cart = Session::get('cart', []);

        foreach ($cart[$user_id] as $key => $item) {
            if ($item['product_id'] == $product_id) {
                // Increase the quantity by 1
                $cart[$user_id][$key]['quantity']++;
                Session::put('cart', $cart);
    
                return redirect()->route('cart')->with('success', 'Quantity increased successfully!');
            }
        }

        return redirect()->route('cart')->with('error', 'Product not found in cart!');
    }

    public function reduceQuantity($product_id)
    {
        $user_id = session('user_id');
        $cart = Session::get('cart', []);

        foreach ($cart[$user_id] as $key => $item) {
            if ($item['product_id'] == $product_id) {
                // Decrease the quantity by 1, ensuring it doesn't go below 1
                $cart[$user_id][$key]['quantity'] = max(1, $item['quantity'] - 1);
                Session::put('cart', $cart);
    
                return redirect()->route('cart')->with('success', 'Quantity reduced successfully!');
            }
        }

        return redirect()->route('cart')->with('error', 'Product not found in cart!');
    }
}
