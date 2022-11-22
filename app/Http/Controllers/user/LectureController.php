<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function offline_lectures(){
        return view('user.offline-lectures');
    }

    public function lecture_detail(){
        return view('user.lecture-detail');
    }
}
