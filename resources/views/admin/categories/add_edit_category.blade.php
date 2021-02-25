@extends('layouts.admin_layout.admin_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Catalouges</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add Category Form</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" placeholder="Enter Category Name">
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Section</label>
                                <select name="section_id" class="form-control select2" style="width: 100%;">
                                    <option selected="selected" disabled value="">Select</option>
                                    @foreach ($sections as $section)
                                    <option value="{{$section->id}}">{{$section->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Category Level</label>
                                <select name="parent_id" class="form-control select2" style="width: 100%;">
                                    <option selected="selected" value="0">Main Category</option>
                                    {{-- @foreach ($sections as $section)
                                <option value="{{$section->id}}">{{$section->name}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Category Discount</label>
                                <input type="number" class="form-control" placeholder="Enter Category discount">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Category URL</label>
                                <input type="url" class="form-control" placeholder="Enter Category url">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Category Description</label>
                                <textarea name="" id="" cols="20" rows="5" class="form-control"
                                    placeholder="Enter Category description"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Category Image</label>
                                <div class="custom-file">
                                    <input type="file" accept="image/*" class="custom-file-input" name="admin_image"
                                        id="upload_image" onchange="loadFile(event)">
                                    <label class="custom-file-label" for="customFile">Choose Category Image</label>
                                    <input type="hidden" name="current_category_image">
                                </div>
                                <img src="{{asset("")}}" alt="" class="m-3" id="output" width="200px">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <h5>----- Meta Data For SEO ----- </h5>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Meta title</label>
                                <input type="text" class="form-control" placeholder="Enter Meta Title">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Meta Keywords</label>
                                    <input type="text" class="form-control" placeholder="Separate with commas ' , '">
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="" id="" cols="20" rows="5" class="form-control"
                                    placeholder="Enter Category description"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
