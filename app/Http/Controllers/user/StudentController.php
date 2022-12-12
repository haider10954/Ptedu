<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            'mobile_number' => $request['country_code'] . '-' . $request['sim_code'] . $request['mobile'],
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
                'success' => 'true',
                'message' => 'Welcome to Student Portal'
            ]);
        } else {
            return json_encode([
                'success' => 'false',
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
}
