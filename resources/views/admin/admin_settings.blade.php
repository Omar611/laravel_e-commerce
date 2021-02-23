@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Admin Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{url('admin/update-current-pwd')}}"
                            name="updatePasswordForm" id="updatePasswordForm">
                            @csrf
                            <div class="card-body">
                                {{-- <div class="form-group">
                                        <label>User Name</label>
                                        <input type="text" class="form-control" value="{{ $adminDetails->name }}"
                                placeholder="Enter Your Name" name="admin_name" id="admin_name">
                            </div> --}}
                            <div class="form-group">
                                <label>Email address</label>
                                <input readonly class="form-control" value="{{  $adminDetails->email }}">
                            </div>
                            <div class="form-group">
                                <label>User Type</label>
                                <input readonly class="form-control" value="{{  $adminDetails->type }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Current Password</label>
                                <input type="password" class="form-control" name="current_pwd" id="current_pwd"
                                    placeholder="Enter Password" required>
                                <span class="text-danger" id="check-pass"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">New Password</label>
                                <input type="password" class="form-control" name="new_pwd" id="new_pwd"
                                    placeholder="Enter New Password" required>
                                @error('new_pwd')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <input type="password" class="form-control" name="new_pwd_confirmation" id="new_pwd_confirmation"
                                    placeholder="Confirm New Password" required>
                            </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
<!-- /.content -->
</div>
@endsection
