<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Online_enrollment;
use App\Models\Offline_enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Course_tracking;

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
            'extended_duration' => 'required|numeric'
        ]);
        try {
            $data['extended_duration'] = $request->extended_duration;
            $extend_duration = Course_tracking::where('id', $request->record)->update($data);
            return view('admin.student.student_course_access_control')->with('message', __('translation.Course duration extended successfully'));
        } catch (\Throwable $th) {
            return view('admin.student.student_course_access_control')->with('error', __('translation.Error : Please try again'));
        }
    }

    public function student_course_change_access(Request $request){
        $this->validate($request, [
            'course_tracking' => 'required|exists:course_trackings,id',
            'currentAccess' => 'required|boolean'
        ]);
        try {
            if($request->currentAccess == 1){
                $data['access'] = 0;
            }else{
                $data['access'] = 1;
            }
            $changeAccess = Course_tracking::where('id', $request->course_tracking)->update($data);
            return view('admin.student.student_course_access_control')->with('message', __('translation.Course access changed successfully'));
        } catch (\Throwable $th) {
            return view('admin.student.student_course_access_control')->with('error', __('translation.Error : Please try again'));
        }
    }
}
