<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Section;
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

    public function addEditCategory(Request $request, $id = null)
    {
        if ($id == null) {
            $title = "Add Category";

        } else {
            $title = "Add Category";

        }

        $sections = Section::all();

        return view('admin.categories.add_edit_category', compact('title', 'sections'));
    }
}
