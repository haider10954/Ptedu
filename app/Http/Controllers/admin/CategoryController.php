<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Faq;
use App\Models\Offline_course;
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
            'category_name' => 'required',
            'type' => 'required',
        ]);

        $cat = Category::create([
            'name' => $request['category_name'],
            'type' => $request['type'],
        ]);

        if ($cat) {
            return redirect()->route('category');
        } else {
            return redirect()->back()->with('msg', __('translation.Something went wrong Please try again'));
        }
    }

    public function delete_category(Request $request)
    {
        $categoryId =$request->id;

        $isUsedInFaqs = Faq::query()->where('category_id',$categoryId)->exists();
        $isUsedInCourses = Course::query()->where('category_id', $categoryId)->exists();
        $isUsedInOfflineCourses = Offline_course::query()->where('category_id', $categoryId)->exists();

        if($isUsedInFaqs)
        {
            // Get Faqs
            Faq::query()->where('category_id',$categoryId)->delete();
        }

        if ($isUsedInCourses  || $isUsedInOfflineCourses) {
            return redirect()->back()->with('error', __('translation.Category is present in courses. You cannot delete it but you can edit it'));
        }

        $category = Category::query()->where('id', $categoryId)->delete();
        if ($category) {
            return redirect()->back()->with('msg', __('translation.Category has been deleted Successfully'));
        } else {
            return redirect()->back()->with('error', __('translation.Something went wrong Please try again'));
        }
    }

    public function edit_category(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
            'type' => 'required',
        ]);

        $category = Category::where('id', $request['id'])->update([
            'name' => $request['category_name'],
            'type' => $request['type'],
        ]);
        if ($category) {
            return redirect()->route('category');
        } else {
            return redirect()->back()->with('error', __('translation.Something went wrong Please try again'));
        }
    }
}
