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
        $categories = Category::with(['section' => function ($q) {
            $q->select('id', 'name');
        }, 'parent_category'])->get();
        $categories = json_decode((json_encode($categories)));
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
            $title = "Edit Category";
            $categoryData = Category::find($id);
            $categoriesDropdown = Category::with('subcategories')->where([
                'section_id' => $categoryData['section_id'],
                'parent_id' => 0,
                'status' => 1,
            ])->get();

            $category = Category::find($id);
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
                if ($request->current_category_image) {
                    unlink($request->current_category_image);
                }
            } elseif ($request->current_category_image && $request->current_category_image != "") {
                $img_src = $request->current_category_image;
            } else {
                $img_src = '';
            }
            $category->category_image = $img_src;

            $category->save();

            $categories = Category::with(['section' => function ($q) {
                $q->select('id', 'name');
            }, 'parent_category'])->get();
            if (isset($categoryData)) {
                return redirect("admin/categories")->with('success', "Category <strong>" . $data['category_name'] . "</strong> Edited Successfully!");
            } else {
                return redirect("admin/categories")->with('success', "Category <strong>" . $data['category_name'] . "</strong> Added Successfully!");
            }
        }

        if (isset($categoryData)) {
            return view('admin.categories.add_edit_category', compact('title', 'sections', 'categoryData', 'categoriesDropdown'));
        } else {
            return view('admin.categories.add_edit_category', compact('title', 'sections'));
        }
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
    public function deleteCategoryImg(Request $request)
    {
        Category::find($request->id)->update(['category_image' => ""]);
        unlink($request->img);
        return response("Image Deleted");
    }
}
