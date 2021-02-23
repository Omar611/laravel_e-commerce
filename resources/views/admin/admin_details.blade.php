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
                        <li class="breadcrumb-item active">Admin Details</li>
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
                    {{-- @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif --}}
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
                    <form role="form" method="POST" action="{{url('admin/update-admin-details')}}"
                        name="updatePasswordForm" id="updatePasswordForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Admin Name</label>
                                <input type="text" class="form-control" value="{{ $adminDetails->name }}"
                                    placeholder="Enter Your Name" name="admin_name" id="admin_name">
                                @error('admin_name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{  $adminDetails->email }}">
                            </div>
                            <div class="form-group">
                                <label>User Type</label>
                                <input readonly class="form-control" value="{{  $adminDetails->type }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mobile</label>
                                <input type="tel" class="form-control" name="mobile" id="mobile"
                                    placeholder="Enter Mobile Number" value="{{  $adminDetails->mobile }}" required>
                                @error('mobile')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Image</label>
                                <input type="file" accept="image/*" class="form-control" name="admin_image"
                                    id="admin_image" onchange="loadFile(event)">
                                <img src="{{asset($adminDetails->image)}}" alt="" class="m-3" id="output" width="200px">
                                @error('admin_image')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                                @if ($adminDetails->image)
                                <input type="hidden" name="current_admin_image">
                                @endif
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
