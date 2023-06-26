<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Like_course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function online_course()
    {
        return view('user.online-course');
    }

    public function like_courses(Request $request)
    {
        $id = decrypt($request->course_id);
        $create = Like_course::create([
            'user_id' => auth()->id(),
            'course_id' => $id,
            'type' => $request->type
        ]);

        if ($create) {
            return response()->json([
                'success' => true,
                'message' => 'Course has been liked successfully',
            ]);
        }
    }

    public function dislike_courses(Request $request)
    {
        $id = decrypt($request->course_id);
        $deleted = Like_course::where('course_id', $id)->where('user_id', auth()->id())->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Course has been dis liked successfully',
            ]);
        }
    }

    public function getLiveCourse()
    {
        $liveCourses = Course::whereHas('category', function ($query) {
            $query->where('name', 'Live Course');
        })->paginate(8);

        return view('user.live_courses', compact('liveCourses'));
    }

    public function getSpecialCourse()
    {
        $specialCourse = Course::whereHas('category', function ($query) {
            $query->where('name', 'Special Lecture');
        })->paginate(8);

        return view('user.special_courses', compact('specialCourse'));
    }
}
