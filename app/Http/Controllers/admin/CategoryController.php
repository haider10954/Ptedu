<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category_listing()
    {
        $category = Category::get();
        return view('admin.category.category', compact('category'));
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

    
}
