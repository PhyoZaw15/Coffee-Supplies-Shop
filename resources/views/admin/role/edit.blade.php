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

            {!! Form::open(['method' => 'patch','route' => ['roles.update', $role->id]]) !!}
                {{-- <div class="card-header">
                    <h5 class="m-0">Role</h5>
                </div> --}}
                <div class="card-body">
                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            {!! Form::text('name', $role->name, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Permissions</label>
                        @foreach($permissions as $value)
                        <div class="offset-sm-2 col-sm-10">
                            <div class="form-check">
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                    {{ $value->name }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    {!! Form::submit('Save', ['class' => 'btn btn-info']) !!}
                </div>
            {!! Form::close() !!}
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    
@endsection