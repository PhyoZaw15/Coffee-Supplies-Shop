@extends('frontend.layouts.app')

@section('content')

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
      @include('admin.message.flash-message')

        <div class="row gx-4 gx-lg-5 justify-content-center">

            <div class="col-12">
                <h2 class="mb-4">Checkout</h2>

                @php
                    if (isUserAuth()) {
                        $user = getUserInformation();
                    }
                    $userCart = getUserInformationWithCart();
                @endphp

                @if(count($userCart) > 0)
                    <form action="{{ route('checkout.ajax') }}", method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userCart as $item)
                                    <tr>
                                        @php
                                            $discount_percentage = 0;
                                            $subcriber = isSubscriber($user->id, $item['product_id']);
                                            if($subcriber['status'] == true) {
                                                $discount_percentage = $subcriber['discount_percentage'];
                                            }
                                        @endphp

                                        <td>{{ $item['product_name'] }}</td>
                                        <td>
                                            @if ($subcriber['status'] == true)
                                                $ <del>{{ $item['price'] }}</del>
                                                $ {{ $subcriber['discount_price'] }}
                                            @else
                                                $ {{ $item['price'] }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $discount_percentage }}
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="{{ url('carts/reduce-qty/'.$item['product_id']) }}" class="btn btn-outline-danger">-</a>

                                                    &nbsp; {{ $item['quantity'] }} &nbsp;

                                                    <a href="{{ url('carts/add-qty/'.$item['product_id']) }}" class="btn btn-outline-success">+</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($subcriber['status'] == true)
                                                $ <del>{{ $item['price'] * $item['quantity'] }}</del>
                                                $ {{ $subcriber['discount_price'] * $item['quantity'] }}
                                            @else
                                                $ {{ $item['price'] * $item['quantity'] }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('carts/remove-item/'.$item['product_id']) }}" class="btn btn-outline-danger">Remove</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-end">
                            <a href="{{ route('frontend.products') }}" class="btn btn-secondary">Continue Shopping</a>
                            <button class="btn btn-success" id="proceedToCheckoutBtn">Proceed to Checkout</button>
                        </div>
                    </form>
                @else
                    <p>Your cart is empty.</p>
                    <a href="{{ route('frontend.products') }}" class="btn btn-secondary">Continue Shopping</a>
                @endif
            </div>

        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        // Ajax request on clicking "Proceed to Checkout"
        $('#proceedToCheckoutBtn').on('click', function () {
            $.ajax({
                url: "{{ route('checkout.ajax') }}",
                method: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function (data) {
                    alert('Order placed successfully!')
                }
            });
        });
    });
</script>

@endsection


