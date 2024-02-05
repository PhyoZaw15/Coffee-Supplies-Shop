@extends('frontend.layouts.app')

@section('content')

<!-- Header-->
{{-- <header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header> --}}

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
      @include('admin.message.flash-message')
        @if (isUserAuth())
        <!-- Subscription Form -->
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col-lg-12">
                <h5 style="color: green"><b>Order placed successfully!</b></h5>
                <br>
                <div class="card mb-6">
                    <div class="card-body">
                        <h6 class="card-title text-center mb-8">You Can Subscribe <br> for your item.</h6>
                        <br>
                        <hr>
                        <form action="{{ route('subscribe') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="mb-3">
                                <label for="subscription_type" class="form-label">Subscription Type</label>
                                <select class="form-select" id="subscription_type" name="subscription_type" required>
                                    <option value="daily">Daily</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="products" class="form-label">Select Products</label>
                                <select class="form-select" id="products" name="product_ids[]" multiple required>
                                    @foreach ($orderProducts as $order_product)
                                        <option value="{{ $order_product->product->id }}" selected>{{ $order_product->product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description (Optional)</label>
                                <textarea name="description" id="description" cols="30" rows="3"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-primary">Subscribe</button>
                                <br><br>
                                <a href="{{ url('products') }}" class="btn btn-outline-success">Continue Shopping</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Subscription Form -->
        @endif
    </div>
</section>

@endsection