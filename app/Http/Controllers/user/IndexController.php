<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Faq;

class IndexController extends Controller
{
    //
    public function index(){
        return view('user.index');
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
