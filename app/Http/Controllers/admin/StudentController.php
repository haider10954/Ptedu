<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function student_admin_listing()
    {
        $student = User::paginate(10);
        return view('admin.student.student_list', compact('student'));
    }

    public function delete_student(Request $request)
    {
        $student = User::where('id', $request->id)->delete();
        if ($student) {
            return redirect()->back()->with('message', 'Student has been deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try agian later.');
        }
    }

    public function edit_student($id)
    {
        $student =  User::where('id', $id)->first();
        return view('admin.student.student_info', compact('student'));
    }

    public function edit_student_info(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'en_name' => 'required',
            'email' => 'required',
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
                'message' => 'Student Record has been Updated Successfully'
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong.Please try again later'
            ]);
        }
    }
}
