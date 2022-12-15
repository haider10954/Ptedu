<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category_listing()
    {
        $category = Category::paginate(10);
        return view('admin.category.category', compact('category'));
    }

    public function edit_category_view($id)
    {
        $cat = Category::where('id', $id)->first();
        return view('admin.category.edit_category', compact('cat'));
    }

    public function add_category(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required'
        ]);

        $cat = Category::create([
            'name' => $request['category_name'],
        ]);

        if ($cat) {
            return redirect()->route('category');
        } else {
            return redirect()->back()->with('msg', 'Something went wrong Please try again.');
        }
    }

    public function delete_category(Request $request)
    {
        $category = Category::where('id', $request['id'])->delete();
        if ($category) {
            return redirect()->back()->with('msg', 'Category has been deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }

    public function edit_category(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required'
        ]);

        $category = Category::where('id', $request['id'])->update([
            'name' => $request['category_name']
        ]);
        if ($category) {
            return redirect()->route('category');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }
}
