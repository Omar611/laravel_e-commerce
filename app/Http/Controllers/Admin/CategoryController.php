<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories.categories', compact('categories'));
    }

    public function updateCategory(Request $request)
    {
        $status = $request->status == "Active" ? 0 : 1;
        Category::find($request->category_id)->update([
            'status' => $status,
        ]);
        return response($status);
    }
}
