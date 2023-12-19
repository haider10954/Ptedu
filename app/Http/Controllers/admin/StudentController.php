<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Online_enrollment;
use App\Models\Offline_enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Course_tracking;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Models\Student_online_price_control;

class StudentController extends Controller
{
    public function student_admin_listing()
    {
        $student = User::with(['getOfflineEnrolments', 'getOnlineEnrolments'])->paginate(10);
        return view('admin.student.student_list', compact('student'));
    }

    public function delete_student(Request $request)
    {
        $student = User::where('id', $request->id)->delete();
        if ($student) {
            return redirect()->back()->with('message', __('translation.Student has been deleted Successfully'));
        } else {
            return redirect()->back()->with('error',  __('translation.Something went wrong Please try again'));
        }
    }

    public function edit_student($id)
    {
        $student =  User::where('id', $id)->first();
        $online_courses_enrolled = Online_enrollment::where('user_id', $student->id)->with('getCourses')->get();
        $offline_courses_enrolled = Offline_enrollment::where('user_id', $student->id)->with('getCousreName')->get();
        return view('admin.student.student_info', compact('student', 'online_courses_enrolled', 'offline_courses_enrolled'));
    }

    public function edit_student_info(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'en_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'job' => 'required',
            'address' => 'required',
        ]);

        $student = User::where('id', $request->id)->update([
            'name' => $request['name'],
            'english_name' => $request['en_name'],
            'email' => $request['email'],
            'mobile_number' => $request['phone_number'],
            'job' => $request['job'],
            'address' => str_replace(',', '|', $request['address']),
        ]);

        if ($student) {
            return json_encode([
                'success' => true,
                'message' =>  __('translation.Student Record has been Updated Successfully'),
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' =>  __('translation.Something went wrong Please try again')
            ]);
        }
    }

    public function downloadFile($hash)
    {
        $path = Crypt::decryptString($hash);
        return response()->download(storage_path('app/public/'.trim($path,'/')));
       
    }

    public function student_course_access_control($student_id){
        $online_courses_enrolled = Course_tracking::where('user_id', $student_id)->with('getCourses')->get();
        return view('admin.student.student_course_access_control', compact('online_courses_enrolled'));
    }

    public function student_extend_course_duration(Request $request){
        $this->validate($request, [
            'record' => 'required|exists:course_trackings,id',
            'extended_duration' => 'required|numeric',
            'student_id' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $data['extended_duration'] = $request->extended_duration;
            $extend_duration = Course_tracking::where('id', $request->record)->update($data);
            DB::commit();
            return redirect()->route('student_course_access_control',$request->student_id)->with('message', __('translation.Course duration extended successfully'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('student_course_access_control',$request->student_id)->with('error', __('translation.Error : Please try again'));
        }
    }

    public function student_course_change_access(Request $request){
        $this->validate($request, [
            'course_tracking' => 'required|exists:course_trackings,id',
            'currentAccess' => 'required|boolean',
            'student_id' => 'required'
        ]);
        try {
            DB::beginTransaction();
            if($request->currentAccess == 1){
                $data['access'] = 0;
            }else{
                $data['access'] = 1;
            }
            $changeAccess = Course_tracking::where('id', $request->course_tracking)->update($data);
            DB::commit();
            return redirect()->route('student_course_access_control',$request->student_id)->with('message', __('translation.Course access changed successfully'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('student_course_access_control',$request->student_id)->with('error', __('translation.Error : Please try again'));
        }
    }

    public function student_online_course_price_control($course_id){
        $course = Course::where('id', $course_id)->first();
        $records = Student_online_price_control::where('course_id', $course_id)->get();
        $users = User::get();
        return view('admin.courses.student_online_course_price_control', compact('records','users','course'));
    }

    public function add_student_online_course_price_discount_entry(Request $request){
        $validate = \Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'discounted_price' => 'nullable|numeric',
            'course_id' => 'required|exists:courses,id',
            'original_price' => 'required|numeric'
        ],[
            'course_id.required' => __('translation.Something went wrong, please try again'),
            'course_id.exists' => __('translation.Something went wrong, please try again')
        ]);
        if ($validate->fails()) {
            return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', $validate->errors()->first());
        }
        try {
            if(empty($request->discounted_price) && empty($request->is_free)){
                return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', __('translation.Free status or discount price should be given'));
            }
            $checkEntry = Student_online_price_control::where('course_id', $request->course_id)->where('user_id', $request->user_id)->count();
            if($checkEntry > 0){
                return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', __('translation.Entry for this user is already entered'));
            }
            $data = [];
            DB::beginTransaction();
            $data['course_id'] = $request->course_id;
            $data['user_id'] = $request->user_id;
            $data['original_price'] = $request->original_price;
            if(!empty($request->is_free)){
                if(!in_array($request->is_free, ['true','false'])){
                    return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', __('translation.Error : Please try again'));
                }
                if($request->is_free == 'true'){
                    $data['is_free'] = 1;
                }else{
                    $data['is_free'] = 0;
                }                
            }
            if(!empty($request->discounted_price)){
                if($request->discounted_price > $request->original_price){
                    return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', __('translation.Discounted price must be less than original price'));
                }
                $data['discounted_price'] = $request->discounted_price;
            }
            $addEntry = Student_online_price_control::create($data);
            DB::commit();
            return redirect()->route('student_online_course_price_control',$request->course_id)->with('message', __('translation.Course discount entry added successfully'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', __('translation.Error : Please try again'));
        }
    }

    public function edit_student_online_course_price_discount_entry(Request $request){
        $validate = \Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'discounted_price' => 'nullable|numeric',
            'course_id' => 'required|exists:courses,id',
            'original_price' => 'required|numeric'
        ],[
            'course_id.required' => __('translation.Something went wrong, please try again'),
            'course_id.exists' => __('translation.Something went wrong, please try again'),
            'user_id.required' => __('translation.Something went wrong, please try again'),
            'user_id.exists' => __('translation.Something went wrong, please try again')
        ]);
        if ($validate->fails()) {
            return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', $validate->errors()->first());
        }
        try {
            if(empty($request->discounted_price) && empty($request->is_free)){
                return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', __('translation.Free status or discount price should be given'));
            }
            $data = [];
            DB::beginTransaction();
            $data['course_id'] = $request->course_id;
            $data['user_id'] = $request->user_id;
            $data['original_price'] = $request->original_price;
            if(!empty($request->is_free)){
                if(!in_array($request->is_free, ['true','false'])){
                    return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', __('translation.Error : Please try again'));
                }
                if($request->is_free == 'true'){
                    $data['is_free'] = 1;
                }else{
                    $data['is_free'] = 0;
                }                
            }
            if(!empty($request->discounted_price)){
                if($request->discounted_price > $request->original_price){
                    return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', __('translation.Discounted price must be less than original price'));
                }
                $data['discounted_price'] = $request->discounted_price;
            }
            $editEntry = Student_online_price_control::where('id', $request->record_id)->update($data);
            DB::commit();
            return redirect()->route('student_online_course_price_control',$request->course_id)->with('message', __('translation.Course discount entry added successfully'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', __('translation.Error : Please try again'));
        }
    }

    public function del_student_online_course_price_discount_entry(Request $request){
        $validate = \Validator::make($request->all(), [
            'record_id' => 'required|exists:student_online_price_controls,id',
            'course_id' => 'required|exists:courses,id'
        ],[
            'record_id.required' => __('translation.Something went wrong, please try again'),
            'record_id.exists' => __('translation.Something went wrong, please try again'),
            'course_id.required' => __('translation.Something went wrong, please try again'),
            'course_id.exists' => __('translation.Something went wrong, please try again')
        ]);
        if ($validate->fails()) {
            return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', $validate->errors()->first());
        }
        try {
            DB::beginTransaction();
            $delRecord = Student_online_price_control::where('id', $request->record_id)->delete();
            DB::commit();
            return redirect()->route('student_online_course_price_control',$request->course_id)->with('message', __('translation.Course discount entry deleted successfully'));
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect()->route('student_online_course_price_control',$request->course_id)->with('error', __('translation.Error : Please try again'));
        }
    }

    public function student_course_refund(Request $request){
        $validate = \Validator::make($request->all(), [
            'student_id' => 'required|exists:users,id',
            'course_tracking_id' => 'required|exists:course_trackings,id',
            'course_id' => 'required|exists:courses,id',
            'amount' => 'required|numeric'
        ],[
            'student_id.required' => __('translation.Something went wrong, please try again'),
            'student_id.exists' => __('translation.Something went wrong, please try again'),
            'course_tracking_id.required' => __('translation.Something went wrong, please try again'),
            'course_tracking_id.exists' => __('translation.Something went wrong, please try again'),
            'course_id.required' => __('translation.Something went wrong, please try again'),
            'course_id.exists' => __('translation.Something went wrong, please try again'),
        ]);
        if ($validate->fails()) {
            return redirect()->route('student_course_access_control',$request->student_id)->with('error', $validate->errors()->first());
        }
        try {
            dd($request->all());
            DB::beginTransaction();
            $delRecord = Student_online_price_control::where('id', $request->record_id)->delete();
            DB::commit();
            return redirect()->route('student_online_course_price_control',$request->course_id)->with('message', __('translation.Course discount entry deleted successfully'));
        } catch (\Throwable $th) {
            DB::rollback(); 
            return redirect()->route('student_course_access_control',$request->student_id)->with('error', $validate->errors()->first());
        }
    }
}
