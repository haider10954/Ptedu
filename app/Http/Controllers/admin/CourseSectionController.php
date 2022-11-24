<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseSectionController extends Controller
{
    public function section_listing()
    {
        return view('admin.course_section.section');
    }

    public function add_section_view()
    {
        return view('admin.course_section.add_section');
    }

    public function edit_section_view()
    {
        return view('admin.course_section.edit_section');
    }
}
