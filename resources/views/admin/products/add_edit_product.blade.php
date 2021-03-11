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
                                    <label>Product Name</label>
                                    <input name="product_name" id="product_name" type="text" class="form-control"
                                        placeholder="Enter Product Name"
                                        value="{{isset($productData->product_name) ? $productData->product_name : old("product_name")}}"
                                        required>
                                    @error('product_name')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select name="category_id" id="category_id" class="form-control select2" required>
                                        <option @if (!isset($productData->category_id) || !$productData->category_id)
                                            selected="selected"
                                            @endif disabled>Select</option>
                                        @foreach ($categories as $section)
                                        <optgroup label="{{$section->name}}"></optgroup>
                                        @foreach ($section->categories as $category)
                                        <option @if (isset($productData->category_id) && $productData->category_id ==
                                            $category->id)
                                            selected="selected"
                                            @endif
                                            value="{{$category->id}}">&nbsp; --
                                            <strong>{{$category->category_name}}</strong></option>
                                        @foreach ($category->subcategories as $subcat)
                                        <option @if (isset($productData->category_id) && $productData->category_id ==
                                            $subcat->id)
                                            selected="selected"
                                            @endif
                                            value="{{$subcat->id}}">&nbsp;&nbsp;&nbsp;&nbsp; --
                                            {{$subcat->category_name}}
                                        </option>
                                        @endforeach
                                        @endforeach
                                        @endforeach
                                    </select>
                                    @error('category_id')
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
                                        value="{{isset($productData->product_code) ? $productData->product_code : old("product_code")}}"
                                        required>
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
                                        value="{{isset($productData->product_color) ? $productData->product_color : old("product_color")}}"
                                        required>
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
                                    <input type="number" min="0" step="0.01" name="product_price" id="product_price"
                                        class="form-control" placeholder="Enter Product Price"
                                        value="{{isset($productData->product_price) ? $productData->product_price : old("product_price")}}"
                                        required>
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
                                    @error('product_discount')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Pattern</label>
                                    <select name="pattern" id="pattern" class="form-control select2">
                                        <option @if (!isset($productData->pattern) || !$productData->pattern)
                                            selected="selected"
                                            @endif disabled>Select</option>
                                        @foreach ($patternArray as $pattern)
                                        <option @if (isset($productData->pattern) && $productData->pattern ==
                                            $pattern)
                                            selected="selected"
                                            @endif
                                            value="{{$pattern}}">{{$pattern}}</option>
                                        @endforeach
                                    </select>
                                    @error('pattern')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Fabric</label>
                                    <select name="fabric" id="fabric" class="form-control select2">
                                        <option @if (!isset($productData->fabric) || !$productData->fabric)
                                            selected="selected"
                                            @endif disabled>Select</option>
                                        @foreach ($fabricArray as $fabric)
                                        <option @if (isset($productData->fabric) && $productData->fabric ==
                                            $fabric)
                                            selected="selected"
                                            @endif
                                            value="{{$fabric}}">{{$fabric}}</option>
                                        @endforeach
                                    </select>
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
                                    <select name="sleev" id="sleev" class="form-control select2">
                                        <option @if (!isset($productData->sleev) || !$productData->sleev)
                                            selected="selected"
                                            @endif disabled>Select</option>
                                        @foreach ($sleevArray as $sleev)
                                        <option @if (isset($productData->sleev) && $productData->sleev ==
                                            $sleev)
                                            selected="selected"
                                            @endif
                                            value="{{$sleev}}">{{$sleev}}</option>
                                        @endforeach
                                    </select>
                                    @error('sleev')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Fit</label>
                                    <select name="fit" id="fit" class="form-control select2" required>
                                        <option @if (!isset($productData->fit) || !$productData->fit)
                                            selected="selected"
                                            @endif disabled>Select</option>
                                        @foreach ($fitArray as $fit)
                                        <option @if (isset($productData->fit) && $productData->fit == $fit)
                                            selected="selected"
                                            @endif value="{{$fit}}">{{$fit}}</option>
                                        @endforeach
                                    </select>
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
                                    <input type="number" min="0" step="0.01" name="product_weight" id="product_weight"
                                        class="form-control" placeholder="Enter Product Weight"
                                        value="{{isset($productData->product_weight) ? $productData->product_weight : old("product_weight")}}">
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
                                    <select name="ocasion" id="ocasion" class="form-control select2">
                                        <option @if (!isset($productData->ocasion) || !$productData->ocasion)
                                            selected="selected"
                                            @endif disabled>Select</option>
                                        @foreach ($occasionArray as $ocasion)
                                        <option @if (isset($productData->ocasion) && $productData->ocasion ==
                                            $ocasion)
                                            selected="selected"
                                            @endif
                                            value="{{$ocasion}}">{{$ocasion}}</option>
                                        @endforeach
                                    </select>
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
                                        class="form-control" placeholder="Enter Product description"
                                        required>{{isset($productData->description) ? $productData->description : old("product_desc")}}</textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Product Image</label>
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" class="custom-file-input"
                                            name="product_image" id="upload_image">
                                        <label class="custom-file-label" for="customFile">Choose Product
                                            Image</label>
                                        <input type="hidden" id="old_img" name="current_product_image"
                                            value="{{isset($productData->main_image) ? $productData->main_image : ""}}">
                                    </div>
                                    <img src="{{isset($productData->main_image) ? asset("images/product/small/".$productData->main_image) : ""}}"
                                        alt="" class="m-3" id="output" width="200px">
                                    @if (!empty($productData->main_image))
                                    <a class="text-danger confirmDelete" record="product-image"
                                        recordid="{{isset($productData->id) ? $productData->id : ""}}"
                                        href="javascript(void)">Delete Image</a>
                                    @endif
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
                                        placeholder="Enter Product wash care">{{isset($productData->wash_care) ? $productData->wash_care : old("wash_care")}}</textarea>
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
                                                id="product_video" accept="video/*">
                                            <label class="custom-file-label" for="customFile">Choose Product
                                                Video</label>
                                            <div id="display_vid" class="m-2">
                                            </div>
                                        </div>
                                        <video width="200" class="m-3" controls>
                                            <source
                                                src="{{!empty($productData->product_video) ? asset("videos/product_videos/".$productData->product_video) : ""}}"
                                                id="video_prev">
                                            Your browser does not support HTML5 video.
                                        </video>
                                        @if (!empty($productData->product_video))
                                        <a class="text-danger confirmDelete" record="product-video"
                                            recordid="{{isset($productData->id) ? $productData->id : ""}}"
                                            href="javascript(void)">Delete video</a>
                                        @endif
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
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
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="is_featured" id="is_featured"
                            value="1" @if (isset($productData->is_featured) && $productData->is_featured=='Yes')
                        checked
                        @endif>
                        <label for="is_featured" class="custom-control-label">Featured Product</label>
                    </div>
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
