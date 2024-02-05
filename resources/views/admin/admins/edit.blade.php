@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Admin User edit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin/') }}">Home</a></li>
                <li class="breadcrumb-item active">Admin</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Admin update</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::model($user, ['method' => 'PATCH','route' => ['admin-accounts.update', $user->id]]) !!}
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="card-body">
                    <div class="form-group row">
                        <label for="user" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirmpassword" class="col-sm-2 control-label">ConfirmPassword</label>
                        <div class="col-sm-10">
                            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="roles" class="col-sm-2 control-label">Select Role</label>
                        <div class="col-sm-10">
                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                        </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Update</button>
                    <a href="{{ route('admin-accounts.index') }}" class="btn btn-default">Cancel</a>
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