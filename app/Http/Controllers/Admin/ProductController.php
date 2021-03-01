<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::all();
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
}
