<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function faq_listing()
    {
        $faq = Faq::paginate(3);
        return view('admin.faqs.faqs', compact('faq'));
    }

    public function add_faqs_view()
    {
        $category = Category::get();
        return view('admin.faqs.add_faqs', compact('category'));
    }

    public function edit_faqs_view($id)
    {
        $faq = Faq::where('id', $id)->first();
        $category = Category::get();
        return view('admin.faqs.edit_faqs', compact('category', 'faq'));
    }

    public function add_faq(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'category' => 'required',
            'answer' => 'required'
        ]);

        $faq = Faq::create([
            'title' => $request['question'],
            'category_id' => $request['category'],
            'content' => $request['answer']
        ]);

        if ($faq) {
            return redirect()->route('faqs');
        } else {
            return redirect()->back()->with('msg', 'Something went wrong Please try again.');
        }
    }

    public function delete_faq(Request $request)
    {
        $faq = Faq::where('id', $request['id'])->delete();
        if ($faq) {
            return redirect()->back()->with('msg', 'Faqs has been deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }

    public function edit_faq(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'category' => 'required',
            'answer' => 'required'
        ]);

        $faq = Faq::where('id', $request['id'])->update([
            'title' => $request['question'],
            'category_id' => $request['category'],
            'content' => $request['answer']
        ]);

        if ($faq) {
            return redirect()->route('faqs');
        } else {
            return redirect()->back()->with('msg', 'Something went wrong Please try again.');
        }
    }
}
