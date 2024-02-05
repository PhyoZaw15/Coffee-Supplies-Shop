@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              @can('brand-create')
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="{{ url('admin/orders') }}" class="btn btn-success btn-xs float-right"><i class="fa fa-reply"></i> Back</a>
                </li>
              </ol>
            @endcan
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <div class="content">
    <div class="container-fluid">
      @include('admin.message.flash-message')
        <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3>Details Information</h3>
                    <h6><b>Order ID: #CFS_{{ $order->id }}</b></h6>
                    <h6><b>Username: {{ $order->user->name }}</b></h6>
                    <h6><b>Payment Status: {{ $order->payment_status }}</b></h6>
                </div>
                <!-- /.card-header -->
                
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Product SKU code</th>
                      <th>Product Name</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Discount Price</th>
                      <th>Total Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $index = 1;
                    @endphp
                    @foreach($order->orderProducts as $order_product)
                      <tr>
                        <td>{{ $index++ }}</td>
                        <td>{{ $order_product->product->sku_code }}</td>
                        <td>{{ $order_product->product->name }}</td>
                        <td>{{ $order_product->price }}</td>
                        <td>{{ $order_product->quantity }}</td>
                        <td>{{ $order_product->discount_price }}</td>
                        <td>{{ $order_product->total_price }}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('script')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection