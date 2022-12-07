<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Faq;
use App\Models\Offline_course;

class IndexController extends Controller
{
    //
    public function index(){
        $offline_courses = Offline_course::with('getTutorName')->get();
        return view('user.index',compact('offline_courses'));
    }
    
    public function notice(){
        $notices = Notice::orderBy('id','desc')->paginate(10);
        return view('user.notice',compact('notices'));
    }

    public function faq(){
        $faqs = Faq::paginate(10);
        return view('user.faq',compact('faqs'));
    }

}
