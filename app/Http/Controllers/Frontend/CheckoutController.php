<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class CheckoutController extends Controller
{
    public function checkoutAjax(Request $request)
    {
        DB::beginTransaction();

        try {
            $user_id = session('user_id');
            $cart = Session::get('cart', []);

            $order = new Order();
            $order->user_id = $user_id;
            $order->total_amount =calculateTotalAmount($cart[$user_id]);
            $order->payment_status = 'pending';
            $order->save();

            // Save individual items into the order_products table
            foreach ($cart[$user_id] as $item) {

                // Calculate to Discount
                $subcriber = isSubscriber($user_id, $item['product_id']);
                if($subcriber['status'] == true) {
                    $discount_percentage = $subcriber['discount_percentage'];
                    
                    $discount_price = $subcriber['discount_price'];
                    $total_price = $discount_price * $item['quantity'];
                } else {
                    $discount_price = 0;
                    $total_price = $item['price'] * $item['quantity'];
                }

                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $item['product_id'];
                $orderProduct->quantity = $item['quantity'];
                $orderProduct->price = $item['price'];
                $orderProduct->discount_price = $discount_price;
                $orderProduct->total_price = $total_price;
                $orderProduct->save();
            }

            // Clear the cart
            Session::forget('cart');

            // If everything is successful, commit the transaction
            DB::commit();

            return redirect()->route('order.details', ['order_id' => $order->id]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function orderDetails($order_id)
    {
        $order = Order::find($order_id);
        $orderProducts = OrderProduct::with('product')->where('order_id', $order_id)->get();

        return view('frontend.order.details', compact('order', 'orderProducts'));
    }
}
