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
                        <h3 class="card-title">Categories</h3>
                        <a href="{{url('admin/add-edit-category')}}" class="btn btn-primary float-right">Add
                            Category</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="sections" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Parent Category</th>
                                    <th>Section Name</th>
                                    <th>Category Image</th>
                                    <th>Discount</th>
                                    <th>Description</th>
                                    <th>URL</th>
                                    {{-- <th>Meta Title</th>
                                    <th>Meta Description</th>
                                    <th>Meta Keywords</th> --}}
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->category_name}}</td>
                                    @if ($category->parent_category)
                                    <td>{{$category->parent_category->category_name}}</td>
                                    @else
                                    <td>Root</td>
                                    @endif
                                    <td>{{$category->section->name}}</td>
                                    <td>
                                        <img src="{{asset($category->category_image)}}" width="100px" alt="">
                                    </td>
                                    <td>{{$category->category_discount}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>{{$category->url}}</td>
                                    <td><a href="{{url('admin/add-edit-category/' . $category->id)}}">Edit</a></td>
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
