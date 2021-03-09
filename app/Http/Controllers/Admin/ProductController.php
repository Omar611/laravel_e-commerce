<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Section;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::with(['category', 'section'])->get();
        // dd($products);
        return view('admin.products.products', compact('products'));
    }

    public function updateProduct(Request $request)
    {
        $status = $request->status == "Active" ? 0 : 1;
        Product::find($request->product_id)->update([
            'status' => $status,
        ]);
        return response($status);
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::find($request->id);
        if ($product->product_image)
            unlink($product->product_image);
        $product->delete();
        return redirect()->back()->with("success", "Product Deleted Successfully");
    }

    public function addEditProduct(Request $request, $id = null)
    {
        if ($id == null) {
            $title = "Add Product";
            $product = new Product();
        } else {
            $title = "Edit Product";

            $product = Product::find($id);
        }

        if ($request->isMethod('POST')) {
            // Validation
            $rules = [
                'product_name' => 'required|unique:products',
                'category_id' => 'required',
                'product_code' => 'required',
                'product_color' => 'required',
                'product_price' => 'required|numeric',
                'product_discount' => 'nullable|numeric',
                'product_weight' => 'nullable|numeric',
                'product_desc' => 'required',
                'fit' => 'required',
            ];
            $customMessages = [
                'product_name.required' => 'This field is requied',
                'category_id.required' => 'This field is requied',
                'product_code.required' => 'This field is requied',
                'product_color.required' => 'This field is requied',
                'product_price.required' => 'This field is requied',
                'product_desc.required' => 'This field is requied',
                'fit.required' => 'This field is requied',
            ];
            $request->validate($rules, $customMessages);

            // Save Image
            if ($request->hasFile('product_image')) {
                $img_tmp = $request->file('product_image');
                if ($img_tmp->isValid()) {
                    $extension = $img_tmp->getClientOriginalExtension();
                    $imageName = hexdec(uniqid()) . '.' . $extension;
                    $large_img_path = 'images/product/large/' . $imageName;
                    $medium_img_path = 'images/product/medium/' . $imageName;
                    $small_img_path = 'images/product/small/' . $imageName;
                    Image::make($img_tmp)->save($large_img_path);
                    Image::make($img_tmp)->resize(520, 600)->save($medium_img_path);
                    Image::make($img_tmp)->resize(260, 300)->save($small_img_path);

                    $product->main_image = $imageName;
                }
            }

            // Save Video
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = hexdec(uniqid()) . '.' . $extension;
                    $video_path = 'videos/product_videos/';

                    $video_tmp->move($video_path, $videoName);

                    $product->product_video = $videoName;
                }
            }

            // Save Product details in product table
            $categoryDtails = Category::find($request->category_id);
            $product->section_id = $categoryDtails->section_id;
            $product->category_id = $request->category_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->product_color = $request->product_color;
            $product->product_price = $request->product_price;
            $product->product_discount = $request->product_discount;
            $product->product_weight = $request->product_weight;
            $product->description = $request->product_desc;
            $product->wash_care = $request->wash_care;
            $product->fabric = $request->fabric;
            $product->pattern = $request->pattern;
            $product->sleev = $request->sleev;
            $product->fit = $request->fit;
            $product->occasion = $request->pattern;
            $product->meta_title = $request->product_meta_title;
            $product->meta_description = $request->product_meta_desc;
            $product->meta_keywords = $request->product_meta_keywords;
            $product->is_featured = isset($request->is_featured) ? "Yes" : "No";
            $product->status = 1;
            $product->save();

            return redirect('/admin/products')->with('success', 'Product <strong>"' . $request->product_name . '"</strong> added successfully');
        }

        // Filter Array
        $fabricArray = ['Cotton', 'Polyester', 'Wool'];
        $sleevArray = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless'];
        $patternArray = ['Checked', 'Plain', 'Printed', 'Self', 'Solid'];
        $fitArray = ['Regular', 'Small', 'Large', "X Large"];
        $occasionArray = ['Casual', 'Formal'];

        // Section with categories and sub-categories
        $categories = Section::with("categories")->get();
        $categories = json_decode(json_encode($categories));
        // dd($categories);
        return view('admin.products.add_edit_product', compact("title", 'fabricArray', 'sleevArray', 'patternArray', 'fitArray', 'occasionArray', 'categories'));
    }
}
