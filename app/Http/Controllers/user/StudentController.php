<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\StudentLoginRequest;
use App\Http\Requests\user\StudentRegisterRequest;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Online_enrollment;
use App\Models\Offline_enrollment;
use App\Service\Cart;
use App\Models\Student_online_price_control;
use App\Models\Student_offline_price_control;

class StudentController extends Controller
{
    public function student_register(StudentRegisterRequest $request)
    {
        $email = $request['email_name'] . '@' . $request['email_extension'];
        $check_user = User::where('email', $email)->first();
        if (!empty($check_user)) {
            return json_encode(
                [
                    'success' => false,
                    'message' => __('translation.Email already exists')
                ]
            );
        }
        $en_name = $request->first_name.$request->last_name;
        $student = User::create([
            'name' => $request['name'],
            'english_name' => $en_name,
            'user_id' => $request['user_id'],
            'password' => Hash::make($request->password),
            'job' => $request['job'],
            'mobile_number' => $request['mobile'],
            'email' => $request['email_name'] . '@' . $request['email_extension'],
            'address' => $request['address'],
        ]);

        if ($student) {
            return json_encode(
                [
                    'success' => true,
                    'message' => __('translation.Student has been registered successfully')
                ]
            );
        } else {
            return json_encode(
                [
                    'success' => false,
                    'message' => __('translation.Something went wrong Please try again'),
                ]
            );
        }
    }

    public function student_login(StudentLoginRequest $request)
    {
        $user = User::where('user_id', $request->email)->orWhere('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                auth()->login($user);
                if (session()->has('shopping_cart')) {
                    $cart = session()->get('shopping_cart');
                    foreach ($cart as $cart_item) {
                        if ($cart_item['type'] == 'online') {
                            $check_online_enrolment = Online_enrollment::where('user_id', auth()->id())->where('course_id', $cart_item['course_id'])->first();
                            if (!empty($check_online_enrolment)) {
                                $del_cart_item = Cart::del_cart_item($cart_item['course_id'], $cart_item['type']);
                            }else{
                                $check_discount = Student_online_price_control::where('course_id', $cart_item['course_id'])->where('user_id', auth()->id())->first();
                                if(!empty($check_discount)){
                                    if($check_discount->is_free == 1){
                                        Cart::update_cart_item($cart_item['course_id'], $cart_item['type'], 0, 0);
                                    }
                                    if(!empty($check_discount->discounted_price) && ($check_discount->is_free == 0)){
                                        Cart::update_cart_item($cart_item['course_id'], $cart_item['type'], $cart_item['price'], $check_discount->discounted_price);
                                    }
                                }
                            }
                        }
                        if ($cart_item['type'] == 'offline') {
                            $check_offline_enrolment = Offline_enrollment::where('user_id', auth()->id())->where('course_id', $cart_item['course_id'])->first();
                            if (!empty($check_offline_enrolment)) {
                                $del_cart_item = Cart::del_cart_item($cart_item['course_id'], $cart_item['type']);
                            }else{
                                $check_discount = Student_offline_price_control::where('course_id', $cart_item['course_id'])->where('user_id', auth()->id())->first();
                                if(!empty($check_discount)){
                                    if($check_discount->is_free == 1){
                                        Cart::update_cart_item($cart_item['course_id'], $cart_item['type'], 0, 0);
                                    }
                                    if(!empty($check_discount->discounted_price) && ($check_discount->is_free == 0)){
                                        Cart::update_cart_item($cart_item['course_id'], $cart_item['type'], $cart_item['price'], $check_discount->discounted_price);
                                    }
                                }
                            }
                        }
                    }
                    // dd($cart);
                    // Cart::empty_cart();
                    // $update_cart = Cart::update_cart($cart);
                    // dd($update_cart, $cart);
                }
                return json_encode([
                    'error' => false,
                    'message' => __('translation.Welcome to Student Portal'),
                ]);
            } else {
                return json_encode([
                    'error' => true,
                    'message' => __('translation.Email or Password is Incorrect'),
                ]);
            }
        } else {
            return json_encode([
                'error' => true,
                'message' => __('translation.Email or Password is Incorrect'),
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
            'user_id' => 'required|unique:users'
        ]);
        return response()->json(
            [
                'success' => true,
                'message' => __('translation.The value is not duplicated')
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
                'message' => __('translation.Your Entered Credentails are Valid'),
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Credentails are Invalid'),
            ]);
        }
    }

    public function reset_password(Request $request)
    {
        $id = session()->get('forget_id');

        if ($id == null) {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again'),
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
                'message' => __('translation.Your Password has been changed Successfully')
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again'),
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
                'message' => __('translation.Your Entered Credentails are Valid'),
                'user_id' => $find_id->user_id
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Credentails are Invalid'),
            ]);
        }
    }

    function upload_files($file)
    {
        if (!file_exists(storage_path('app/public/student'))) {
            mkdir(storage_path('app/public/student'), 0755, true);
        }
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
            return redirect()->back()->with('msg', __('translation.Student Profile has been updated Successfully'));
        } else {
            return redirect()->back()->with('error', __('translation.Something went wrong Please try again'));
        }
    }
    public function delete_profile_image()
    {
        $delete_profile_img = User::where('id', auth()->id())->update([
            'profile_img' => null,
        ]);
        if ($delete_profile_img) {
            return redirect()->back()->with('msg', __('translation.Your Profile image has been deleted successfully'));
        } else {
            return redirect()->back()->with('error', __('translation.Something went wrong Please try again'),);
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
            return redirect()->back()->with('error', __('translation.Password you entered is incorrect'));
        }

        if ($change_password) {
            return redirect()->back()->with('msg', __('translation.Your Password has been Updated Successfully'));
        } else {
            return redirect()->back()->with('error', __('translation.Something went wrong Please try again'),);
        }
    }
}
