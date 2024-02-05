@extends('admin.layouts.app')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a href="{{ route('roles.index') }}" class="btn btn-success btn-xs float-right"><i class="fa fa-reply"></i> Back</a>
          </div><!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">       
            <div class="card card-primary card-outline">
              {{-- <div class="card-header">
                <h5 class="m-0">Role</h5>
              </div> --}}
            <form action="{{ route('roles.store') }}" method="POST">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="card-body">
                <div class="form-group row">
                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="role" placeholder="Role Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Permissions</label>
                    @foreach($permissions as $permission)
                    <div class="offset-sm-2 col-sm-10">
                        <div class="form-check">
                        <input type="checkbox" name="permissions[]" class="form-check-input" id="exampleCheck2" value="{{ $permission->id }}">
                        <label class="form-check-label" for="exampleCheck2">{{ $permission->name }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
              </div>
              <div class="card-footer">
                    <button type="submit" class="btn btn-info">Create</button>
                    {{-- <button type="submit" class="btn btn-default float-right">Cancel</button> --}}
              </div>
            </form>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    
@endsection