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
            'mobile_number' => $request['country_code'] . $request['mobile'],
            'email' => $request['email_name'] . '@' . $request['email_extension'],
            'address' => $request['address'] . '|' . $request['house_no'] . '|' . $request['street_no'],
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
                'message' => 'Email or Password is Incorrect'
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
            'user_id' => 'required|unique:users,user_id,' . auth()->id(),
        ]);
        return response()->json(
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

    function upload_files($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/student', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    public function update_student_profile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'en_name' => 'required',
            'user_id' => 'required|unique:users,user_id,' . auth()->id(),
            'job' => 'required',
            'country_code' => 'required',
            'mobile' => 'required',
            'email_name' => 'required',
            'email_extension' => 'required',
            'address' => 'required',
            'user_profile' => 'max:2000'
        ]);

        $request['user_profile'] = auth()->user()->profile_img;
        if ($request->hasFile('user_profile')) {
            $profile_img = $this->upload_files($request['user_profile']);
        } else {
            $profile_img = $request['old_image'];
        }

        $user = User::where('id', auth()->id())->update([
            'name' => $request['name'],
            'english_name' => $request['en_name'],
            'user_id' => $request['user_id'],
            'job' => $request['job'],
            'mobile_number' => $request['country_code'] . $request['mobile'],
            'address' => $request['address'],
            'profile_img' => $profile_img,
            'email' => $request['email_name'] . '@' . $request['email_extension'],
        ]);
        if ($user) {
            return redirect()->back()->with('msg', 'Student Profile has been updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went Wrong. Please try again later');
        }
    }
    public function delete_profile_image()
    {
        $delete_profile_img = User::where('id', auth()->id())->update([
            'profile_img' => null,
        ]);
        if ($delete_profile_img) {
            return redirect()->back()->with('msg', 'Your Profile image has been deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong.Please try again.');
        }
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|same:confirm_password',
        ]);

        if (Hash::check($request['current_password'], auth()->user()->password)) {
            $change_password = User::where('id', auth()->id())->update([
                'password' => Hash::make($request['new_password'])
            ]);
        } else {
            return redirect()->back()->with('error', 'Password you entered is incorrect');
        }

        if ($change_password) {
            return redirect()->back()->with('msg', 'Your Password has been Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went Wrong. Please try again.');
        }
    }
}
