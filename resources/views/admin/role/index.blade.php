@extends('admin.layouts.app')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            @can('role-create')
            <a href="{{ route('roles.create') }}" class="btn btn-success btn-xs float-right"><i class="fa fa-plus"></i> Add New</a>
            {{-- <a href="{{ route('roles.index') }}" class="btn btn-success btn-xs float-right"><i class="fa fa-arrow-left"></i> Back</a> --}}
            @endcan
          </div><!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      @include('admin.message.flash-message')
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">All Roles</h5>
              </div>
              <div class="card-body">
                <table id="dt_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                   <tbody>
                     @php
                         $i = 1;
                     @endphp
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                          @can('role-edit')
                            <a  href="{{ url('admin/roles/'.$role->id.'/edit') }}"><i class="fa fa-edit"></i> </a> &nbsp;
                          @endcan

                          @can('role-delete')
                            @if($role->name !== 'SuperAdmin')
                            <a href="" data-toggle="modal" data-target="#deleteModal" data-id="{{$role->id}}" data-url="{{ url('admin/roles/'.$role->id) }}" ><i class="fa fa-trash" style="color:rgb(182, 6, 6);"></i></a>
                            @endif
                          @endcan
                        </td>
                    </tr>
                    @endforeach
                   </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    
@endsection

@section('script')
  <!-- DataTables -->
  <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

  <script>
    $(document).ready(function(){
      // data table
      $("#dt_table").DataTable({
      "responsive": true,
      "autoWidth": false,
      });

    });
  </script>
@endsection