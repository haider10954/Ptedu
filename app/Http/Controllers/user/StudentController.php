<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function student_register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'en_name' => 'required',
            'user_id' => 'required|unique:users',
            'password' => 'required|min:6|same:confirm_password',
            'job' => 'required',
            'country_code' => 'required',
            'sim_code' => 'required',
            'mobile' => 'required',
            'email_name' => 'required',
            'email_extension' => 'required',
            'address' => 'required',
            'house_no' => 'required',
            'street_no' => 'required',
        ]);
        $student = User::create([
            'name' => $request['name'],
            'english_name' => $request['en_name'],
            'user_id' => $request['user_id'],
            'password' => Hash::make($request->password),
            'job' => $request['job'],
            'mobile_number' => $request['country_code'] . $request['sim_code'] . $request['mobile'],
            'email' => $request['email_name'] . '@' . $request['email_extension'],
            'address' => $request['address'] . ' ' . $request['house_no'] . ' ' . $request['street_no'],
        ]);

        if ($student) {
            return json_encode(
                [
                    'success' => true,
                    'message' => 'Student has been registered successfully.'
                ]
            );
        } else {
            return json_encode(
                [
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ]
            );
        }
    }

    public function student_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return json_encode([
                'success' => true,
                'message' => 'Welcome to Student Portal'
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something Went wrong'
            ]);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('user_login');
    }

    public function checkUserId(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|unique:users',
        ]);
        return json_encode(
            [
                'success' => true,
                'message' => 'The value is not duplicated'
            ]
        );
    }

    public function Password_reset(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile_number' => 'required',
            'user_id' => 'required',
        ]);

        $find_password = User::where('name', $request->name)->where('mobile_number', $request->mobile_number)->where('user_id', $request->user_id)->first();
        if ($find_password) {
            session()->put('forget_id', $find_password->id);
            session()->save();
            return json_encode([
                'success' => true,
                'message' => 'Your Entered Credentails are Valid',
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Credentails are Invalid',
            ]);
        }
    }

    public function reset_password(Request $request)
    {
        $id = session()->get('forget_id');

        if ($id == null) {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
        $request->validate([
            'password' => 'required|min:6|same:confirm_password',
        ]);

        $reset_password = User::where('id', $id)->update([
            'password' => Hash::make($request->password),
        ]);
        if ($reset_password) {
            session()->forget('forget_id');
            session()->save();
            return json_encode([
                'success' => true,
                'message' => 'Your Password has been changed Successfully'
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function find_id(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
        ]);

        $find_id = User::where('name', $request->name)->where('mobile_number', $request->phone_number)->first();
        if ($find_id) {
            return json_encode([
                'success' => true,
                'message' => 'Your Entered Credentails are Valid',
                'user_id' => $find_id->user_id
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Credentails are Invalid',
            ]);
        }
    }
}
