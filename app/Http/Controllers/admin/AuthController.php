<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('course');
        } else {
            return redirect()->back()->with('message', 'Email or password is invalid');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }

    public function admin_profile()
    {
        return view('admin.settings.settings');
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        if ((Hash::check($request->old_password, auth('admin')->user()->password))) {
            $admin = Admin::where('id', auth('admin')->id())->update([
                'password' => Hash::make($request['new_password']),
            ]);
        } else {
            return redirect()->back()->with('profile_false', 'The entered password is not valid');
        }
        if ($admin) {
            return redirect()->back()->with('profile_true', 'Password has been updated successfully');
        }
    }

    function upload_files($file, $oldName = null)
    {
        if (empty($file)) {
            return $oldName;
        }

        if (!file_exists(storage_path('app/public/admin/profile'))) {
            mkdir(storage_path('app/public/admin/profile'), 0755, true);
        }
        $fileName =  time() . mt_rand(300, 9000) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/admin/profile', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }


    public function update_admin_profile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'job' => 'required',
            'en_name' => 'required',
            'phone_number' => 'required',
            'image' => 'mimes:jpeg,png,jpg',
            'address' => 'required',
            'introduction' => 'required',
        ]);
        $admin_profile_photo = $this->upload_files($request['image'] ?? null, auth('admin')->user()->profile_img);

        $admin = Admin::where('id', auth('admin')->id())->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'job' => $request['job'],
            'english_name' => $request['en_name'],
            'phone_number' => $request['phone_number'],
            'profile_img' => $admin_profile_photo,
            'address' => $request['address'],
            'introduction' => $request['introduction']
        ]);
        if ($admin) {
            return redirect()->back()->with('msg', 'Admin Profile has been Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again');
        }
    }
}
