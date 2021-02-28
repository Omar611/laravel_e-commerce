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
            <form name="categoryForm" id="categoryForm" @if (isset($categoryData))
                action="{{url("/admin/add-edit-category/".$categoryData->id)}}" @else
                action="{{url("/admin/add-edit-category")}}" @endif enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{$title}} Form</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input name="category_name" id="category_name" type="text" class="form-control"
                                        placeholder="Enter Category Name"
                                        value="{{isset($categoryData->category_name) ? $categoryData->category_name : old("category_name")}}">
                                    @error('category_name')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Section</label>
                                    <select name="section_id" id="section_id" class="form-control select2"
                                        style="width: 100%;">
                                        <option @if (!isset($categoryData->section_id))
                                            selected="selected"
                                            @endif disabled>Select</option>
                                        @foreach ($sections as $section)
                                        <option value="{{$section->id}}" @if (isset($categoryData->section_id) &&
                                            $categoryData->section_id == $section->id)
                                            selected ="selected"
                                            @endif>{{$section->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Category Level</label>
                                    <select name="parent_id" id="parent_id" class="form-control select2"
                                        style="width: 100%;">
                                        <option selected="selected" value="0">Main Category</option>
                                        @isset($categoriesDropdown)
                                        @foreach ($categoriesDropdown as $catdd)
                                        <option value="{{$catdd->id}}" @if (isset($categoryData->parent_id) &&
                                            $categoryData->parent_id == $catdd->id)
                                            selected ="selected"
                                            @endif>{{$catdd->category_name}}</option>
                                        @foreach ($catdd->subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}" @if (isset($categoryData->parent_id) &&
                                            $categoryData->parent_id == $subcategory->id)
                                            selected ="selected"
                                            @endif>---{{$subcategory->category_name}}</option>
                                        @endforeach
                                        @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <!-- /.Category Level -->
                                @error('parent_id')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Category Discount</label>
                                    <input type="number" min="0" step="0.5" name="category_discount"
                                        id="category_discount" class="form-control"
                                        placeholder="Enter Category discount"
                                        value="{{isset($categoryData->category_discount) ? $categoryData->category_discount : old("category_discount")}}">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Category URL</label>
                                    <input type="text0" name="category_url" id="category_url" class="form-control"
                                        placeholder="Enter Category url"
                                        value="{{isset($categoryData->url) ? $categoryData->url : old("category_url")}}">
                                    @error('category_url')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
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
                                    <textarea name="category_desc" id="category_desc" cols="20" rows="5"
                                        class="form-control"
                                        placeholder="Enter Category description">{{isset($categoryData->description) ? $categoryData->description : old("category_desc")}}
                                    </textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Category Image</label>
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" class="custom-file-input"
                                            name="category_image" id="upload_image" onchange="loadFile(event)">
                                        <label class="custom-file-label" for="customFile">Choose Category Image</label>
                                        <input type="hidden" id="old_img" name="current_category_image"
                                            value="{{isset($categoryData->category_image) ? $categoryData->category_image : ""}}">
                                    </div>
                                    <img src="{{isset($categoryData->category_image) ? asset($categoryData->category_image) : ""}}"
                                        alt="" class="m-3" id="output" width="200px">
                                    <span>
                                        <a href="" class="text-danger" cat-id="{{isset($categoryData->id) ? $categoryData->id : ""}}"
                                            id="delete_image">Delete
                                            Image</a>
                                        <p class="text-success" id="deleted_message" style="display: none"></p>
                                    </span>
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
                                    <input type="text" name="category_meta_title" id="category_meta_title"
                                        class="form-control" placeholder="Enter Meta Title"
                                        value="{{isset($categoryData->meta_title) ? $categoryData->meta_title : old("category_meta_title")}}">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <input type="text" name="category_meta_keywords" id="category_meta_keywords"
                                            class="form-control" placeholder="Separate with commas ' , '"
                                            value="{{isset($categoryData->meta_keywords) ? $categoryData->meta_keywords : old("category_meta_keywords")}}">
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea name="category_meta_desc" id="category_meta_desc" cols="20" rows="5"
                                        class="form-control"
                                        placeholder="Enter Category description">{{isset($categoryData->meta_description) ? $categoryData->meta_description : old("category_meta_desc")}}</textarea>
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
            </form>
        </div>
        <!-- /.card -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
