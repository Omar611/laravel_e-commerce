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
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form name="productForm" id="productForm" @if (isset($productData))
                action="{{url("/admin/add-edit-product/".$productData->id)}}" @else
                action="{{url("/admin/add-edit-product")}}" @endif enctype="multipart/form-data" method="POST">
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
                                    <label>Select Category</label>
                                    <select name="category_id" id="category_id" class="form-control select2"
                                        style="width: 100%;">
                                        <option @if (!isset($productData->section_id))
                                            selected="selected"
                                            @endif disabled>Select</option>
                                    </select>
                                    @error('section_id')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input name="product_name" id="product_name" type="text" class="form-control"
                                        placeholder="Enter Product Name"
                                        value="{{isset($productData->product_name) ? $productData->product_name : old("product_name")}}">
                                    @error('product_name')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <input name="product_code" id="product_code" type="text" class="form-control"
                                        placeholder="Enter Product Code"
                                        value="{{isset($productData->product_code) ? $productData->product_code : old("product_code")}}">
                                    @error('product_code')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Color</label>
                                    <input name="product_color" id="product_color" type="text" class="form-control"
                                        placeholder="Enter Product Color"
                                        value="{{isset($productData->product_color) ? $productData->product_color : old("product_color")}}">
                                    @error('product_color')
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
                                    <label>Product Price</label>
                                    <input ttype="number" min="0" step="0.01" name="product_price" id="product_price"
                                        class="form-control" placeholder="Enter Product Price"
                                        value="{{isset($productData->price) ? $productData->price : old("product_price")}}">
                                    @error('product_price')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Product Discount</label>
                                    <input type="number" min="0" step="0.5" name="product_discount"
                                        id="product_discount" class="form-control" placeholder="Enter Product discount"
                                        value="{{isset($productData->product_discount) ? $productData->product_discount : old("product_discount")}}">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Pattern</label>
                                    <input name="pattern" id="pattern" type="text" class="form-control"
                                        placeholder="Enter Product Code"
                                        value="{{isset($productData->pattern) ? $productData->pattern : old("pattern")}}">
                                    @error('pattern')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Fabric</label>
                                    <input name="fabric" id="fabric" type="text" class="form-control"
                                        placeholder="Enter Product Fabric"
                                        value="{{isset($productData->fabric) ? $productData->fabric : old("fabric")}}">
                                    @error('fabric')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Sleeve</label>
                                    <input name="sleev" id="sleev" type="text" class="form-control"
                                        placeholder="Enter Product Code"
                                        value="{{isset($productData->sleev) ? $productData->sleev : old("sleev")}}">
                                    @error('sleev')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Fit</label>
                                    <input name="fit" id="fit" type="text" class="form-control"
                                        placeholder="Enter Product Fit"
                                        value="{{isset($productData->fit) ? $productData->fabric : old("fit")}}">
                                    @error('fit')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Product Weight</label>
                                    <input ttype="number" min="0" step="0.01" name="product_weight" id="product_weight"
                                        class="form-control" placeholder="Enter Product Weight"
                                        value="{{isset($productData->price) ? $productData->price : old("product_weight")}}">
                                    @error('product_weight')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Product Occasion</label>
                                    <input name="ocasion" id="ocasion" type="text" class="form-control"
                                        placeholder="Enter Product Occasion"
                                        value="{{isset($productData->ocasion) ? $productData->fabric : old("ocasion")}}">
                                    @error('ocasion')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Product Description</label>
                                    <textarea name="product_desc" id="product_desc" cols="20" rows="5"
                                        class="form-control"
                                        placeholder="Enter Product description">{{isset($productData->description) ? $productData->description : old("product_desc")}}</textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Product Image</label>
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" class="custom-file-input"
                                            name="product_image" id="upload_image" onchange="loadFile(event)">
                                        <label class="custom-file-label" for="customFile">Choose Product
                                            Image</label>
                                        <input type="hidden" id="old_img" name="current_product_image"
                                            value="{{isset($productData->product_image) ? $productData->product_image : ""}}">
                                    </div>
                                    <img src="{{isset($productData->product_image) ? asset($productData->product_image) : ""}}"
                                        alt="" class="m-3" id="output" width="200px">
                                    <span>
                                        <a href="" class="text-danger"
                                            cat-id="{{isset($productData->id) ? $productData->id : ""}}"
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
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Product Wash Care</label>
                                    <textarea name="wash_care" id="wash_care" cols="20" rows="5" class="form-control"
                                        placeholder="Enter Product description">{{isset($productData->description) ? $productData->description : old("wash_care")}}</textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Product Video</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="product_video"
                                                id="product_video">
                                            <label class="custom-file-label" for="customFile">Choose Product
                                                Video</label>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
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
                                    <input type="text" name="product_meta_title" id="product_meta_title"
                                        class="form-control" placeholder="Enter Meta Title"
                                        value="{{isset($productData->meta_title) ? $productData->meta_title : old("product_meta_title")}}">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <input type="text" name="product_meta_keywords" id="product_meta_keywords"
                                            class="form-control" placeholder="Separate with commas ' , '"
                                            value="{{isset($productData->meta_keywords) ? $productData->meta_keywords : old("product_meta_keywords")}}">
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea name="product_meta_desc" id="product_meta_desc" cols="20" rows="5"
                                        class="form-control"
                                        placeholder="Enter Product description">{{isset($productData->meta_description) ? $productData->meta_description : old("product_meta_desc")}}</textarea>
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
