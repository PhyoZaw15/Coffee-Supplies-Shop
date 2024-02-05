@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              @can('user-create')
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="{{ route('users.create') }}" class="btn btn-success btn-xs float-right"><i class="fa fa-plus"></i> Add New</a>
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
                  <h3 class="card-title">Users are the following:</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $data)
                      <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>
                          @can('user-edit')
                          <a  href="{{ url('admin/users/'.$data->id.'/edit') }}"><i class="fa fa-edit"></i> </a> &nbsp;
                          @endcan

                          @can('user-delete')
                          <a href="" data-toggle="modal" data-target="#deleteModal" data-id="{{$data->id}}" data-url="{{ url('admin/users/'.$data->id) }}" ><i class="fa fa-trash" style="color:rgb(182, 6, 6);"></i></a>
                          @endcan
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