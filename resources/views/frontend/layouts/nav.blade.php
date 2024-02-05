<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <img src="{{ asset('adminlte/images/c3.webp') }}" alt="Logo" style="height: 50px; width: 50px;" class="navbar-brand brand-image img-circle elevation-3"
           style="opacity: .8">
        <a class="navbar-brand" href="#!">CF Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ url('/products') }}">All Products</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        @php
                            $categories = categoryList();
                        @endphp
                        @foreach ($categories as $category)
                            <li><a class="dropdown-item" href="{{ url('/products?cat_id='.$category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>

            @if (isUserAuth())
                @php
                    if (isUserAuth()) {
                        $user = getUserInformation();
                    }
                    $cart = getUserInformationWithCart();
                @endphp

                @if(empty($cart))
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                @else
                    {{-- <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                        </button>
                    </form> --}}
                    <a href="{{ url('carts') }}" class="btn btn-outline-dark">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">{{ count($cart) }}</span>
                    </a>
                @endif
                
                <!-- Logout Form -->
                <form method="post" action="{{ route('users.logout') }}">
                    @csrf
                    <button class="btn btn-outline-default" type="submit">Logout</button>
                </form>
            @else
                <!-- Login Form -->
                <form class="d-flex">
                    <a href="{{ url('/login') }}" class="btn btn-outline-dark">
                        Login
                    </a>
                </form>
            @endif

            
        </div>
    </div>
</nav>