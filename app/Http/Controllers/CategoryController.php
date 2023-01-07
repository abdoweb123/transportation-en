<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /*** index function  ***/
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('pages.Categories.index', compact('categories'));
    }



    /*** store function  ***/
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->admin_id = auth('admin')->id();
        $category->active = 1;
        $category->save();
        return redirect()->back()->with('alert-success','Data is saved successfully');
    }



    /*** update function  ***/
    public function update(CategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->admin_id = auth('admin')->id();
        $category->active = $request->active;
        $category->update();
        return redirect()->back()->with('alert-info','Data is updated successfully');
    }



    /*** destroy function  ***/
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('alert-info','Data iss deleted successfully');
    }

} //end of class
