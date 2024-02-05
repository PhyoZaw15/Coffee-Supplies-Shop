@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              @can('user-create')
              <ol class="breadcrumb float-sm-right">
                {{-- <li class="breadcrumb-item">
                  <a href="{{ route('users.create') }}" class="btn btn-success btn-xs float-right"><i class="fa fa-plus"></i> Add New</a>
                </li> --}}
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
                  <h3 class="card-title">Subscribers are the following:</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Subscribed at</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1;
                        @endphp
                    @foreach($subscribers as $data)
                      <tr>
                        <td>{{ $index++ }}</td>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->user->email }}</td>
                        <td>{{ $data->subscription_type }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>
                          <a  href="{{ url('admin/subscribers/'.$data->id.'/show') }}"><i class="fa fa-eye"></i> </a> &nbsp;
                        </td>
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