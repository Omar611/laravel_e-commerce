<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;
use Image;

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
        $sections = Section::all();

        if ($id == null) {
            $title = "Add Category";
            $category = new Category();
        } else {
            $title = "Add Category";
        }
        if ($request->isMethod('POST')) {
            $rules = [
                'parent_id' => 'required',
                'section_id' => 'required',
                'category_name' => 'required',
                'category_url' => 'required',
            ];
            $customMessages = [
                'parent_id.required' => 'This field is requied',
                'section_id.required' => 'This field is requied',
                'category_name.required' => 'This field is requied',
                'category_url.required' => 'This field is requied',
            ];
            $request->validate($rules, $customMessages);

            $data = $request->all();

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['category_desc'];
            $category->url = $data['category_url'];
            $category->meta_title = $data['category_meta_title'];
            $category->meta_description = $data['category_meta_desc'];
            $category->meta_keywords = $data['category_meta_keywords'];
            $category->status = 1;

            if ($request->hasFile('category_image')) {

                $category_image = $request->file('category_image');

                $name_hex = hexdec(uniqid()); //will generate a unique hexcode
                $img_ext = strtolower($category_image->getClientOriginalExtension());

                $img_name = $name_hex . '.' . $img_ext;
                $upload_location = 'images/category_images/';
                $img_src = $upload_location . $img_name;

                Image::make($category_image)->save($img_src);
            } else {
                $img_src = '';
            }
            $category->category_image = $img_src;

            $category->save();

            return view('admin.categories.add_edit_category')
                ->with(compact('title', 'sections'))
                ->with('success', "Category Added Successfully!");
        }

        return view('admin.categories.add_edit_category', compact('title', 'sections'));
    }
    public function appendCategoryLevel(Request $request)
    {
        $data = $request->all();
        $categories = Category::with('subcategories')->where([
            'section_id' => $data['section_id'],
            'parent_id' => 0,
            'status' => 1,
        ])->get();
        // return view('admin.categories.append_categories_level', compact('categories'));
        return response($categories);
    }
}
