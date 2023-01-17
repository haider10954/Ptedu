<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course_tracking;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function check_completed_courses(Request $request)
    {
        $id = $request->id;
        $completed_courses = Certificate::with('getCourses')->where('course_id', $id)->where('user_id', auth()->id())->first();
        if ($completed_courses) {
            $created_time = $completed_courses->created_at->format('Y-m-d');
            $end_time = $completed_courses->updated_at->format('Y-m-d');
            return json_encode([
                'success' => true,
                'message' => 'Request completed successfully',
                'data' => $completed_courses,
                'date' => $created_time,
                'end_date' => $end_time,
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }
}
