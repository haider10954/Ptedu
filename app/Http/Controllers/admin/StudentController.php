<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Online_enrollment;
use App\Models\Offline_enrollment;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Course_tracking;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Models\Student_online_price_control;
use App\Models\Refund;
use App\Models\Transaction;

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
        $online_courses_enrolled = Course_tracking::query()->where('user_id', $student_id)->with('getCourses')->get();
        foreach ($online_courses_enrolled as $value)
        {
            $get_enrollment = Online_enrollment::query()->where('user_id',$student_id)->where('course_id',$value->course_id)->with('getOrder')->first();

            $value['course_schedule'] = $get_enrollment->course_schedule;

            $value['payment_response'] = $get_enrollment->payment_response;

            $value['order'] = $get_enrollment->getOrder;

//            $get_orders = Order::query()->where('user_id',$student_id)->get();
//            for ($i= $get_orders->count() - 1 ; $i > 0 ; $i--) {
//                $order_items = json_decode($get_orders[$i]['order_items']);
//                foreach ($order_items as $item)
//                {
//
//                    if($item->course_id == $value->course_id && $item->type == 'online')
//                    {
//                        if(!empty($item->course_schedule))
//                        {
//                            $get_enrollment->update([
//                                'course_schedule' => $item->course_schedule,
//                                'order_id' => $get_orders[$i]['id']
//                            ]);
//                        }
//                    }
//                }
//
//            }//            $get_orders = Order::query()->where('user_id',$student_id)->get();
//            for ($i= $get_orders->count() - 1 ; $i > 0 ; $i--) {
//                $order_items = json_decode($get_orders[$i]['order_items']);
//                foreach ($order_items as $item)
//                {
//
//                    if($item->course_id == $value->course_id && $item->type == 'online')
//                    {
//                        if(!empty($item->course_schedule))
//                        {
//                            $get_enrollment->update([
//                                'course_schedule' => $item->course_schedule,
//                                'order_id' => $get_orders[$i]['id']
//                            ]);
//                        }
//                    }
//                }
//
//            }
        }
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
            'amount' => 'required|numeric',
            'paid_price' => 'required|numeric',
            'order_id' => 'required|exists:orders,id'
        ],[
            'student_id.required' => __('translation.Something went wrong, please try again'),
            'student_id.exists' => __('translation.Something went wrong, please try again'),
            'course_tracking_id.required' => __('translation.Something went wrong, please try again'),
            'course_tracking_id.exists' => __('translation.Something went wrong, please try again'),
            'course_id.required' => __('translation.Something went wrong, please try again'),
            'course_id.exists' => __('translation.Something went wrong, please try again'),
            'order_id.required' => __('translation.Something went wrong, please try again'),
            'order_id.exists' => __('translation.Something went wrong, please try again')
        ]);
        if ($validate->fails()) {
            return redirect()->route('student_course_access_control',$request->student_id)->with('error', $validate->errors()->first());
        }
        try {
            if($request->amount > $request->paid_price){
                return redirect()->route('student_course_access_control',$request->student_id)->with('error', __('translation.Amount cannot be greater than paid price.'));
            }
            $getTransaction = Transaction::where('order_id', $request->order_id)->first();
            if(empty($getTransaction)){
                return redirect()->route('student_course_access_control',$request->student_id)->with('error', __('translation.Error : Please try again'));
            }
            $payment_response = json_decode($getTransaction->payment_response, true);
            DB::beginTransaction();
            
            //refund payment gateway
            
            $res_data = "";
            $req_data = "";
            $kcp_sign_data = "";
            $tno = $payment_response['tno'];
            $site_cd = 'AIYNH';
            // refund amount
            $mod_mny = $request->amount;
            // remaining amount
            $rem_mny = $payment_response['amount'] - $request->amount;
            // Certificate information (serialized)
            $kcp_cert_info = "-----BEGIN CERTIFICATE-----MIIDjDCCAnSgAwIBAgIHBy/vlsKxuDANBgkqhkiG9w0BAQsFADBzMQswCQYDVQQGEwJLUjEOMAwGA1UECAwFU2VvdWwxEDAOBgNVBAcMB0d1cm8tZ3UxFTATBgNVBAoMDE5ITktDUCBDb3JwLjETMBEGA1UECwwKSVQgQ2VudGVyLjEWMBQGA1UEAwwNc3BsLmtjcC5jby5rcjAeFw0yMzAzMDkwMTIzNTdaFw0yODAzMDcwMTIzNTdaMHsxCzAJBgNVBAYTAktSMQ4wDAYDVQQIDAVTZW91bDEQMA4GA1UEBwwHR3Vyby1ndTEWMBQGA1UECgwNTkhOIEtDUCBDb3JwLjEXMBUGA1UECwwOUEdXRUJERVYgVGVhbS4xGTAXBgNVBAMMEDIwMjMwMzA5MTAwMDQ4ODYwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQCg2269Ns2iWkFdthzarNBX/l3ChWhVds/0nje01/MtLG5DSfTXhgg8iH8JPbszOuvGYCMytKF7oGfV7c8XMjSRK+QPWYOQ5zx428oZUhx2Y62eFdzP4ScC65e+kagc9H05AGAlA+cgSWdKS63ckqN2ydZOcTlSTlQeMfd85jdC5iyIT/mLC3GCFldmZdVcVNCbfpLoX7PerO5n/pW280l+rotA1OQZF/mmMGsp+ZkrI5BeOFNcWoWrvKfXWz1MEBZ/ZvHGnOuiRRr2utcDCV0tQ3F6DEuXmi89MTWJPx8KWBsrRj5iyTUmUsEu0waQxjdI15vsRmtQ5RJIBSB7IbsfAgMBAAGjHTAbMA4GA1UdDwEB/wQEAwIHgDAJBgNVHRMEAjAAMA0GCSqGSIb3DQEBCwUAA4IBAQC7L7nBRts0YPRHTjMZxXmCVdLJ9JBn/8qy7XEB0WSAaPcMkKl7nCT0kxnxEPUcmsGQp/stJ2exJBk3OECzl6t6yX6bZLi7XBm57bjjJo9rvBD8wtNsPJJfeyBi+yIOKBGPxri3CgiIkHl5vtJBVfshzZYwK+P6AcnGiCAbtLRfXx+pcAF76GJ1Lc3CnEmpDaO++ZXqvGgkWrwUcYlWIyXmph581rYGDkbHx6H3NUM7Wl6tbTRgXWlcaqUpqIxAaTfhtLUiUUKuaxoFG0YrpW9YUsiz8/ed34PppgYtrsCpWww/Ep2cod6gQesDymTaIlRFURCOtXFiWA00AmaCOVp1-----END CERTIFICATE-----";
            /*
            ==========================================================================
            cancellation API URL
            --------------------------------------------------------------------------
            */
            // $target_URL = "https://stg-spl.kcp.co.kr/gw/mod/v1/cancel"; // development server
            $target_URL = "https://spl.kcp.co.kr/gw/mod/v1/cancel"; // operation server

            // Signature data creation time
            // site_cd(site code) + "^" + tno(transaction number) + "^" + mod_type(Cancellation type)
            // NHN KCPprivate key issued by(PRIVATE KEY)로 SHA256withRSA String encoding value using algorithm
            $cancel_target_data = $site_cd . "^" . $tno . "^" . "STSC";
            /*
            ==========================================================================
            privatekey file read
            --------------------------------------------------------------------------
            */
            $key_data = "-----BEGIN ENCRYPTED PRIVATE KEY-----
            MIIE9jAoBgoqhkiG9w0BDAEDMBoEFJmxyV3ht1DZqtbtA47AhX5xGZwrAgIIAASC
            BMgZmdmAW281T7KRZtrcHDzzuUcgX3jR+mBU7ow/PcbL4IMtSVYp4KO8MmPkNpI9
            5kyr3MtbyVl1qw2AmMCw69iLBjtCj2ZMU6jkNgC1po36BR4yNgHt1yAIlyvqvZJi
            BlIBOAWqXIRy0AiiFaldNzngoNQhilHxA9FTRGl2OjshKWPoYA3/Tn8U9ENT5uwz
            GAYcxyxbOIg9V/XcVn9DIZn+UGcs5qDIfTKxs98ULHbJl8XMdMAPSOMCL6UKEzLI
            7hp302X3wMrydskuAYeoC5EHSfbmcqz98fAkL30ievcCsj5SX4amloVlWc3hZzqW
            mS7gFdU8cg9NmOZMk0kqD08ucBDeW1t87OOg4dUOJkax7xu3JoVhNQIhKsoPileD
            HaFKmTT65Ci+PtCYPsmq95zxxSMi4oiqWz4Cs+PYFJaU5k83oYW4sCm/uvvtEPgg
            Q8f7qQ1LbVPP3SvZ+pUtEskSL0ZJ7dTA0UKyUxWY7uUP5CyCWDpmRud0d8FPN8jh
            d3wOlAOLz0Bp6jstCc1YxEkeDmQTRMBzpN12W+Oc2sDlnLCswADBvYFixLCTKdXU
            ZXeLOi1wqI75Xln13DmgU6JxT7FCn18Km5jH/s0iQ/uuxawy+OxwxRBgpU9M5qmK
            VXEjGf4z+ap0d2/TXOh1dyqczXHUFLp0+94torcuHctDE1MuJE0tyFdU+XTXmc+R
            XBghHHUarfUUINJrlSn1qxCcchSPJ3Of67ufhcrpsbvAgrmhzbJpNCOBnsNjmjur
            9YYNiqCCWDHY4MMxpcoetZP0U07Y1apznnz/DkZNodztsyFR/7x8N8/DBpkJOxVi
            mXulvTLr8Tugz1b91hVYzSvkeU3c7cfTTIS+2OVrsKbqZzYsTHCY03C0nVM6NDIQ
            MIzTSTKOvVlAGs5p3CzhT1HknP57FcCCKH5ivNR7rBni5BaY870mGLULd63ObZ2N
            EQ++bBJNgSBK7HfEUr3AhRD5fyhzZ2okCvsMogS4RE3QYvTKvK1t6QdiJGZmp+t7
            CQ+18bXVrCxASG6vTXTJqeq821c6JvYrbK/VuoGtXYSyuPhirDirMPWCrXjrZEeL
            3Jbi9WTkh3uv2sF4BpeHs6/wyo/PggzxTSMWeDrp1r/j+91O2YV5xmlUMVYDkwSi
            KQh0sToIjKnlxEkMA8PZFrEP2zpOPBxDTIaD8jHD71cxLv7gSNiadg1FXfC9ymhy
            ey+Xp4eXKhMDSuXfcegOrpplg5fdzGiCy4/tj4fnGSpt3LuJT/6mguhKpl2JNEvC
            u9YZYfoKJxYOgypQ+UU5nrjvS9H+1mvwFG+TMu//dCrpj5QIXE6F6nm1etT4I/Kz
            VQfA62DA0IYOtu0qIgh4/vayESgCeIc8u4bJG2LZowwUYtDnkmI4DK3CdKFMiIF1
            MV70obwstw22sp+h9kZ1BRz/6cxexOuVHfJcSlqaJrMYA/RlZ8nBwgzzVS2IRJC6
            64uQHmUqwipKkjBI37uAjOg8dmQb6T0sA/jAvfPmLtWJvnw7jsFhS9fRRdvwCSsb
            sz+2de49RHPnkaXI+D900f2T4YTPQD9qsS9HU7O1MUy8a7SZX7XHYEi4asrVjie8
            nKJZKwQJKhzoX8i2Ty8AsO7VFZUXngfPXnM=
            -----END ENCRYPTED PRIVATE KEY-----";

            /*
            ==========================================================================
            privatekey extraction
            'changeit' is the private key password for testing
            --------------------------------------------------------------------------
            */
            $pri_key = openssl_pkey_get_private($key_data, 'changeit');

            /*
            ==========================================================================
            sign data produce
            --------------------------------------------------------------------------
            */
            // cancel payment signature produce
            openssl_sign($cancel_target_data, $signature, $pri_key, 'sha256WithRSAEncryption');
            //echo "cancel_signature :".base64_encode($signature)."<br><br>";
            $kcp_sign_data = base64_encode($signature);

            $data = array(
                "site_cd" => $site_cd,
                "kcp_cert_info" => $kcp_cert_info,
                "kcp_sign_data" => $kcp_sign_data,
                "mod_type" => "STPC",
                "tno" => $tno,
                "mod_mny" => $mod_mny,
                "rem_mny" => $rem_mny,
                "mod_desc" => "강좌 환불"
            );

            $req_data = json_encode($data);

            $header_data = array("Content-Type: application/json", "charset=utf-8");

            // API REQ
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $target_URL);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $req_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // API RES
            $res_data = curl_exec($ch);

            // RES JSON DATA Parsing
            $json_res = json_decode($res_data, true);

            $res_cd = $json_res["res_cd"];
            $res_msg = $json_res["res_msg"];

            curl_close($ch);

            //refund payment gateway end

            if($res_cd == '0000'){
                // Adding refund amount entry
                $addRefund = Refund::create([
                    'user_id' => $request->student_id,
                    'course_id' => $request->course_id,
                    'refund_amount' => $request->amount
                ]);
                // Deleting course tracking entry
                $delCourseTracking = Course_tracking::where('id', $request->course_tracking_id)->delete();

                // Deleting course enrolment entry
                $delOnlineEnrolment = Online_enrollment::where('user_id', $request->student_id)->where('course_id', $request->course_id)->delete();
            }else{
                return redirect()->route('student_course_access_control',$request->student_id)->with('error', __('translation.Error : Please try again'));
            }

            DB::commit();

            return redirect()->route('student_course_access_control',$request->course_id)->with('message', __('translation.Course refunded successfully'));
            
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('student_course_access_control',$request->student_id)->with('error', __('translation.Error : Please try again'));
        }
    }
}
