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
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="sections" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category Image</th>
                                    <th>Discount</th>
                                    <th>Description</th>
                                    <th>URL</th>
                                    {{-- <th>Meta Title</th>
                                    <th>Meta Description</th>
                                    <th>Meta Keywords</th> --}}
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>
                                        <img src="{{$category->category_image}}" alt="">
                                    </td>
                                    <td>{{$category->category_discount}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>{{$category->url}}</td>
                                    {{-- <td>{{$category->meta_title}}</td>
                                    <td>{{$category->meta_description}}</td>
                                    <td>{{$category->meta_keywords}}</td> --}}
                                    <td>
                                        <a href="javascript:void(0)" id="category-{{$category->id}}"
                                            category_id="{{$category->id}}"
                                            class=" updateCategoryStatus {{$category->status == 1 ? "text-success" : "text-danger"}}">
                                            {{$category->status == 1 ? "Active" : "Inactive"}}
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
