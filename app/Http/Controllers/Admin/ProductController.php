<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

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

        // Filter Array
        $fabricArray = ['Cotton', 'Polyester', 'Wool'];
        $sleevArray = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless'];
        $patternArray = ['Checked', 'Plain', 'Printed', 'Self', 'Solid'];
        $fitArray = ['Regular', 'Small', 'Large', "X Large"];
        $occasionArray = ['Casual', 'Formal'];

        return view('admin.products.add_edit_product', compact("title", 'fabricArray', 'sleevArray', 'patternArray', 'fitArray', 'occasionArray'));
    }
}
