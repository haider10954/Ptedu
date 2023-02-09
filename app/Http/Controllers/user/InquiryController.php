<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function not_answer_inquiry($id)
    {
        $inquiry = Inquiry::where('id', $id)->first();
        return view('user.inquiry_not_answered', compact('inquiry'));
    }

    public function answered_inquiry($id)
    {
        $inquiry = Inquiry::where('id', $id)->first();
        return view('user.inquiry_answered', compact('inquiry'));
    }

    public function answer_inquiry_admin($id)
    {
        $inquiry = Inquiry::where('id', $id)->first();
        return view('admin.inquiry.answer', compact('inquiry'));
    }
    public function inquiry_listing_admin()
    {
        $inquiry = Inquiry::latest()->paginate(10);
        return view('admin.inquiry.inquiry', compact('inquiry'));
    }

    public function add_answer(Request $request)
    {
        $this->validate($request, [
            'answer' => 'required',
        ]);
        $inquiry = Inquiry::where('id', $request->id)->update([
            'answer' => $request['answer'],
        ]);
        if ($inquiry) {
            return redirect()->route('inquiry');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again');
        }
    }
    public function inquiry_listing()
    {
        $inquiry = Inquiry::where('user_id', auth()->id())->orderBy('id', 'DESC')->latest()->paginate(10);
        return view('user.inquiry', compact('inquiry'));
    }
    public function add_inquiry(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'files*' => 'required|mimes:jpeg,png,jpg,xls,ppt,doc',
        ]);
        $filesList = [];
        if ($request->hasFile('files')) {
            if(!file_exists(storage_path('app/public/inquiry/files')))
            {
                mkdir(storage_path('app/public/inquiry/files'),0755,true);
            }
            foreach ($request['files'] as $file) {
                $name = time() . mt_rand(300, 9000) . '.' . $file->extension();
                $file->storeAs('public/inquiry/files', $name);
                $filesList[] =  $name;
            }
        }
        $inquiry = Inquiry::create([
            'user_id' => auth()->id(),
            'name' => auth()->user()->name,
            'mobile_number' => auth()->user()->mobile_number,
            'title' => $request['title'],
            'content' => $request['content'],
            'file' => $filesList,
        ]);

        if ($inquiry) {
            return json_encode([
                'success' => true,
                'message' => __('translation.Inquiry has been added Successfully'),
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again')
            ]);
        }
    }
}
