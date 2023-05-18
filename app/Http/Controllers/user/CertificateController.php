<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course_tracking;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CertificateController extends Controller
{
    public function check_completed_courses(Request $request)
    {
        $id = $request->id;
        $completed_courses = Certificate::with('getCourses')->where('course_id', $id)->where('user_id', auth()->id())->first();
        $certificate = Crypt::encryptString(str_replace("storage/", "", $completed_courses->certificate));
        if ($completed_courses) {
            return json_encode([
                'success' => true,
                'message' => __('translation.Request completed successfully'),
                'data' => $completed_courses,
                'name' => $completed_courses->getCourses->course_title,
                'hash' => $certificate
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again'),
            ]);
        }
    }
}
