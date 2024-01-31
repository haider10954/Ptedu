<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Student_log;
use App\Models\Course_tracking;

class ClassController extends Controller
{
    public function class($course_id, $slug){
        $lectures = [];
        $course = Course::where('id', $course_id)->with('getCourseStatus')->first();
        dd($course);
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
            'lecture_id' => $request->lecture_id,
            'course_id' => $request->course_id
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

    public function lecture_time_completed(Request $request){
        $getLog = Student_log::where('course_id',$request->course_id)->where('lecture_id',$request->lecture_id)->where('user_id',auth()->id())->first();
        if($getLog){
            $updateLog = Student_log::where('course_id',$request->course_id)->where('lecture_id',$request->lecture_id)->where('user_id',auth()->id())->update([
                'status' => 1
            ]);
            if($updateLog){
                return json_encode(['success' => true , 'message' => 'Updated log successfully']);
            }else{
                return json_encode(['success' => false , 'message' => 'An unknown error occurred']);
            }
        }else{
            return json_encode(['success' => false , 'message' => 'An unknown error occurred']);
        }
    }

    public function course_completion_action(Request $request){
        $completedLectures = Student_log::where('user_id',auth()->id())->where('course_id',$request->course_id)->where('status',1)->count();
        $courseTrack = Course_tracking::where('user_id',auth()->id())->where('course_id',$request->course_id)->update([
            'viewed_lectures' => $completedLectures
        ]);
        if($courseTrack){
            $courseTrackRecord = Course_tracking::where('user_id',auth()->id())->where('course_id',$request->course_id)->first();
            if(($courseTrackRecord->no_of_lectures) == ($courseTrackRecord->viewed_lectures)){
                $courseCompletion = Course_tracking::where('user_id',auth()->id())->where('course_id',$request->course_id)->update([
                    'status' => 1
                ]);
                if($courseCompletion){
                    return json_encode(['success' => true , 'message' => 'Request processed successfully']);
                }else{
                    return json_encode(['success' => false , 'message' => 'An unknown error occurred']);
                }
            }
        }else{
            return json_encode(['success' => false , 'message' => 'An unknown error occurred']);
        }
    }
}
