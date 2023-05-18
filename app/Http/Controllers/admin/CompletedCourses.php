<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course_tracking;
use Illuminate\Http\Request;

class CompletedCourses extends Controller
{
    public function CompletedCourses()
    {
        $completed_courses = Course_tracking::with('getCourses')->where('status', 1)->paginate(6);
        return view('admin.certificate.completed_student', compact('completed_courses'));
    }

    public function add_certificate($course_id, $user_id)
    {
        $add_certificate = Course_tracking::with('getCourses', 'getUser')->where('course_id', $course_id)->where('user_id', $user_id)->first();
        $certificate = Certificate::where('course_id', $course_id)->first();
        if (empty($certificate)) {
            $certificate = new Certificate();
            $certificate->certificate_number = '';
            $certificate->id = '';
            $certificate->issue_date = '';
        }
        return view('admin.certificate.add_certificate', compact('add_certificate', 'certificate'));
    }

    public function generate_certificate(Request $request)
    {
        $request->validate([
            'certificate' => 'required|mimes:png,jpg,jpeg,pdf',
        ]);

        if ($request->hasfile('certificate')) {
            $name = time() . mt_rand(300, 9000) . '.' . $request->certificate->extension();
            $request->certificate->storeAs('public/certificate', $name);
            $path = 'storage/certificate/' . $name;
        }

        $generate_certificate = Certificate::updateOrCreate([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id
        ], [
            'course_id' =>  $request->course_id,
            'user_id' => $request->user_id,
            'certificate' => $path
        ]);
        Course_tracking::where('course_id', $request->course_id)->update([
            'generate_certificate' => 1,
        ]);

        if ($generate_certificate) {
            return redirect()->route('certicate-view', $request->course_id);
        } else {
            return redirect()->back()->with('error', __('translation.Something went wrong Please try again'));
        }
    }

    public function delete_record(Request $request)
    {
        $delete_record = Course_tracking::where('id', $request->course_id)->delete();
        if ($delete_record) {
            return redirect()->back()->with('success', __('translation.Record deleted successfully'));
        } else {
            return redirect()->back()->with('error', __('translation.Record not deleted'));
        }
    }

    public function certicate_view($id)
    {
        $certificate = Certificate::with('getCourses', 'getUser')->where('course_id', $id)->first();
    
        return view('admin.certificate.certificate', compact('certificate'));
    }
}
