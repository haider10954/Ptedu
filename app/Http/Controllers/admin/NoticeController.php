<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function notice_listing()
    {
        $notice = Notice::paginate(3);
        return view('admin.notice.notice', compact('notice'));
    }

    public function add_notice_view()
    {
        $category = Category::get();
        return view('admin.notice.add_notice', compact('category'));
    }

    public function edit_notice_view($id)
    {
        $notice = Notice::where('id', $id)->first();
        $category = Category::get();
        return view('admin.notice.edit_notice', compact('category', 'notice'));
    }

    public function add_notice(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'content' => 'required'
        ]);

        $notice = Notice::create([
            'title' => $request['title'],
            'category_id' => $request['category'],
            'content' => $request['content']
        ]);

        if ($notice) {
            return redirect()->route('notice');
        } else {
            return redirect()->back()->with('msg', 'Something went wrong Please try again.');
        }
    }

    public function delete_notice(Request $request)
    {
        $notice = Notice::where('id', $request['id'])->delete();
        if ($notice) {
            return redirect()->back()->with('msg', 'Notice has been deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }

    public function edit_notice(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'content' => 'required'
        ]);

        $notice = Notice::where('id', $request['id'])->update([
            'title' => $request['title'],
            'category_id' => $request['category'],
            'content' => $request['content']
        ]);

        if ($notice) {
            return redirect()->route('notice');
        } else {
            return redirect()->back()->with('msg', 'Something went wrong Please try again.');
        }
    }
}
