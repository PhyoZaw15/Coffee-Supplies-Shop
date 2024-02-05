@extends('frontend.layouts.app')

@section('content')

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
      @include('admin.message.flash-message')
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <form method="post" action="{{ url('login') }}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email or Username</label>
                  <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email or username" required>
                </div>
                <br>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                </div><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>

@endsection