<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;

class CourseSectionController extends Controller
{
    public function section_listing($id)
    {
        $course = Course::where('id', $id)->first();
        $section = Section::where('course_id', $id)->paginate(10);
        return view('admin.course_section.section', compact('course', 'section'));
    }

    public function add_section_view($id)
    {
        $course = Course::where('id', $id)->first();
        return view('admin.course_section.add_section', compact('course'));
    }

    public function add_section(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'section_title' => 'required',
            'section_description' => 'required',
        ]);
        $section = Section::create([
            'course_id' => $request['id'],
            'section_title' => $request['section_title'],
            'section_description' => $request['section_description']
        ]);

        if ($section) {
            return redirect()->back()->with('msg', 'Course Section has been Added Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }

    public function delete_course_section(Request $request)
    {
        $section = Section::where('id', $request['id'])->delete();
        if ($section) {
            return redirect()->back()->with('msg', 'Section has been deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }


    public function edit_section_view($id)
    {
        $section = Section::where('id', $id)->first();
        return view('admin.course_section.edit_section', compact('section'));
    }

    public function edit_course_section(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'section_title' => 'required',
            'section_description' => 'required',
        ]);

        $data['section_title'] = $request['section_title'];
        $data['section_description'] = $request['section_description'];
        $section = Section::where('id', $request->id)->update($data);
        if ($section) {
            return redirect()->back()->with('msg', 'Course Section has been updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }
}
