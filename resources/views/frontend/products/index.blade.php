@extends('frontend.layouts.app')

@section('content')

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
      @include('admin.message.flash-message')

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            @foreach ($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
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
                            {{-- <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div> --}}
                            <form method="post" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                {{-- <label for="quantity">Quantity:</label> --}}
                                <input type="hidden" name="quantity" value="1" min="1">
                                <button type="submit" class="btn btn-outline-dark mt-auto text-center">Add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</section>

@endsection