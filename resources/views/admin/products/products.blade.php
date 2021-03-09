@extends('layouts.admin_layout.admin_layout')
@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Catalogues</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if (session('success'))
    <div class="content-header">
        <div class="container-fluid">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products</h3>
                        <a href="{{url('admin/add-edit-product')}}" class="btn btn-primary float-right">Add
                            Product</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="sections" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Product Color</th>
                                    <th>Product Image</th>
                                    <th>Product Category</th>
                                    <th>Product Section</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->product_code}}</td>
                                    <td>{{$product->product_color}}</td>
                                    <td>
                                        @if ($product->main_image &&
                                        file_exists('images/product/small/'.$product->main_image))
                                        <img src="{{asset('images/product/small/' .$product->main_image)}}"
                                            width="100px" alt="" class="d-block mx-auto">
                                        @else
                                        <img src="{{asset('images/product/small/small-no-image.jpg')}}" width="100px"
                                            alt="" class="d-block mx-auto">
                                        @endif
                                    </td>
                                    <td>{{$product->category->category_name}}</td>
                                    <td>{{$product->section->name}}</td>
                                    <td>
                                        <a href="{{url('admin/add-edit-product/' . $product->id)}}">Edit</a>
                                        &nbsp;&nbsp;
                                        <a href="javascript:void(0)" class="confirmDelete" record="product"
                                            recordid="{{$product->id}}">Delete</a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" id="product-{{$product->id}}"
                                            product_id="{{$product->id}}"
                                            class=" updateProductStatus {{$product->status == 1 ? "text-success" : "text-danger"}}">
                                            {{$product->status == 1 ? "Active" : "Inactive"}}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
