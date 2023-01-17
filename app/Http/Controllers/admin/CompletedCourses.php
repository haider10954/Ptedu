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
        return view('admin.certificate.add_certificate', compact('add_certificate', 'certificate'));
    }

    public function generate_certificate(Request $request)
    {
        $request->validate([
            'certificate_number' => 'required',
            'issue_date' => 'required',
        ]);
        $generate_certificate = Certificate::updateOrCreate([
            'id' => $request->id,
        ], [
            'course_id' =>  $request->course_id,
            'user_id' => $request->user_id,
            'course_duration' => $request->course_period,
            'certificate_number' => rand($request->certificate_number, 999999),
            'issue_date' => $request->issue_date
        ]);
        if ($generate_certificate) {
            return redirect()->back()->with('success', 'Certificate has been generated successfully.');
        } else {
            return redirect()->back()->with('error', 'Somerthing went wrong.');
        }
    }

    public function delete_record(Request $request)
    {
        $delete_record = Course_tracking::where('id', $request->course_id)->delete();
        if ($delete_record) {
            return redirect()->back()->with('success', 'Record deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Record not deleted.');
        }
    }

    public function certicate_view($id, $course_track)
    {
        $certificate = Certificate::with('getCourses', 'getUser')->where('id', $id)->first();
        $download = Course_tracking::where('id', $course_track)->first();
        return view('admin.certificate.certificate', compact('certificate', 'download'));
    }

    public function download_certificate(Request $request)
    {
        try {
            Course_tracking::where('id', $request->id)->update([
                'generate_certificate' => 1,
            ]);
            return json_encode([
                'successs' => true,
                'message' => 'Certificate has been generated successfully.'
            ]);
        } catch (\Exception $th) {
            return json_encode([
                'successs' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
