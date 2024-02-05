@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Product edit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin/') }}">Home</a></li>
                <li class="breadcrumb-item active">Product</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <div class="content">
    <div class="container-fluid">
      @include('admin.message.flash-message')

        <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Product update</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::model($product, ['method' => 'PATCH','route' => ['products.update', $product->id]]) !!}
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="card-body">
                    <div class="row col-sm-12">
                      <div class="form-group col-sm-6">
                        <label for="category">Select Category</label>
                        <select id="category" class="form-control" name="main_category_id">
                          <option value="">--- Select Category ---</option>
                          @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                          <span class="text-danger">
                              <strong>{{ $errors->first('category_id') }}</strong>
                          </span>
                        @endif
                      </div>
  
                      <div class="form-group col-sm-6">
                        <label for="brands">Select Brand</label>
                        <select id="brands" class="form-control" name="brand_id">
                          <option value="">--- Select Brand ---</option>
                          @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('brand_id'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('brand_id') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>

                    <div class="row col-sm-12">
                      <div class="form-group col-sm-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="name" placeholder="Enter product name">
                        @if ($errors->has('name'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="price">Price</label>
                        <input type="number" name="price" value="{{ $product->price }}" class="form-control" id="sale_price" placeholder="Enter original price">
                        @if ($errors->has('price'))
                          <span class="text-danger">
                              <strong>{{ $errors->first('price') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>

                    <div class="row col-sm-12">
                      <div class="form-group col-sm-6">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Update</button>
                    <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>
                  </div>
                {!! Form::close() !!}
            </div>
        </div>
        </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection