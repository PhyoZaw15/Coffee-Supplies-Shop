@extends('frontend.layouts.app')

@section('content')

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
      @include('admin.message.flash-message')


        @if (isUserAuth())
        <!-- Subscription Form -->
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col-lg-12">
                <div class="card mb-6">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-8">Subscribe</h2>
                        <form action="{{ route('subscribe') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="subscription_type" class="form-label">Subscription Type</label>
                                <select class="form-select" id="subscription_type" name="subscription_type" required>
                                    <option value="daily">Daily</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="products" class="form-label">Select Products</label>
                                <select class="form-select" id="products" name="products[]" multiple required>
                                    <!-- You can dynamically populate the product options here -->
                                    <option value="product1">Product 1</option>
                                    <option value="product2">Product 2</option>
                                    <option value="product3">Product 3</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div> --}}
                            <div class="mb-3">
                                <label for="description" class="form-label">Description (Optional)</label>
                                <textarea name="description" id="description" cols="30" rows="3"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Subscription Form -->
        @endif

        <br>
        {{-- @if (isUserAuth())
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    $ {{ $product->price }}
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif --}}
    </div>
</section>

@endsection