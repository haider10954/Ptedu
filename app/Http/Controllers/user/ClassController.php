<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Student_log;

class ClassController extends Controller
{
    public function class($course_id, $slug){
        $lectures = [];
        $course = Course::where('id', $course_id)->with('getCourseStatus')->first();
        $lecture = Lecture::where('slug',$slug)->with('getSection')->first();
        $student_logs = Student_log::where('user_id',auth()->id())->get();
        $current_lecture_track = Student_log::where('user_id',auth()->id())->where('lecture_id',$lecture->id)->first();
        if(!empty($current_lecture_track)){
            $lecture['viewed'] = $current_lecture_track->viewed;
        }else{
            $lecture['viewed'] = null;
        }
        if($course->getCourseStatus->count() > 0){
            foreach ($course->getCourseStatus as $value) {
                if($value->getLectures->count() > 0){
                    foreach($value->getLectures as $v){
                        $user_log_get = $v->getLogRecord->where('user_id',auth()->id())->first();
                        if(!empty($user_log_get)){
                            $v['viewed_time'] = $user_log_get->viewed;
                        }else{
                            $v['viewed_time'] = null;
                        }   
                        array_push($lectures,$v);
                    }
                }   
            }
        }
        return view('user.class',compact('course','lectures','lecture'));
    }

    public function lecture_time_track(Request $request){
        $saveLog =  Student_log::updateOrCreate([
            'lecture_id' => $request->lecture_id
        ],[
            'user_id' => auth()->id(),
            'viewed' => $request->viewed_duration
        ]);
        if($saveLog){
            return json_encode(['success' => true , 'message' => 'Logged Maintained Successfully']);
        }else{
            return json_encode(['success' => false , 'message' => 'An unknown error occurred']);
        }
    }
}
