<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Cart;
use App\Models\Order;
use App\Models\Course;
use App\Models\Online_enrollment;
use App\Models\Offline_enrollment;
use App\Models\Course_tracking;

class CartController extends Controller
{
    public function add_to_cart(Request $request){
        // session()->remove('shopping_cart');
        // session()->save();
        // dd('working');
        $encrypted_course = $request->course_id;
        $course = decrypt($encrypted_course);
        $course['type'] = $request->type;
        $cart = Cart::add_to_cart($course);
        if($cart == true){
            return json_encode(['Success' => true, 'Msg' => __('translation.Course successfully added') , 'cart_items_count' => count(session('shopping_cart'))]);
        }else{
            return json_encode(['Success' => false, 'Msg' => __('translation.Course already added to cart') , 'cart_items_count' => count(session('shopping_cart'))]);
        }
    } 

    public function shopping_bag(){
        $cart = collect(session()->get('shopping_cart'));
        return view('user.shopping_bag',compact('cart'));
    }

    public function del_cart_item(Request $request){
        $course_type = decrypt($request->type);
        $course_id = decrypt($request->course_id);
        $del_cart_item = Cart::del_cart_item($course_id,$course_type);
        if($del_cart_item == true){
            $cart = collect(session()->get('shopping_cart'));
            $html =  view('user.includes.cart',compact('cart'))->render();
            return json_encode(['Success' => true, 'Msg' => 'Cart Updated added' , 'cart_items_count' => count(session('shopping_cart')) , 'html' => $html]);
        }else{
            return json_encode(['Success' => true, 'Msg' => 'Error : Try Again']);
        }
    }

    public function del_cart_items(Request $request){
        foreach ($request->courses as $value) {
            $course = decrypt($value);
            $course_type = $course['type'];
            $course_id = $course['course_id'];
            $del_cart_item = Cart::del_cart_item($course_id,$course_type);
            if($del_cart_item == true){
                $status = true;
            }else{
                $status = false;
            }      
        }
        if($status == true){
            $cart = collect(session()->get('shopping_cart'));
            $html =  view('user.includes.cart',compact('cart'))->render();
            return json_encode(['Success' => true, 'Msg' => __('translation.Cart Updated added') , 'cart_items_count' => count(session('shopping_cart')) , 'html' => $html]);
        }else{
            return json_encode(['Success' => true, 'Msg' => __('translation.Something went wrong Please try again')]);
        }
    }

    public function order(){
        $cart = collect(session()->get('shopping_cart'));
        return view('user.order',compact('cart'));
    }

    public function proceed_checkout(Request $request){
        $cart = session()->get('shopping_cart');
        try {
            $place_order = Order::create([
                'user_id' => auth()->id(),
                'order_items' => json_encode(session()->get('shopping_cart')),
                'status' => 1,
                'payment_status' => 1,
                'payment_method' => $request->payment_method
            ]);
            if($place_order){
                foreach($cart as $cart_item){
                    if($cart_item['type'] == 'online'){
                        $check_enrollment = Online_enrollment::where('course_id', $cart_item['course_id'])->where('user_id', auth()->id())->first();
                        if (empty($check_enrollment)) {
                            $course = Course::where('id', $cart_item['course_id'])->with('getCourseStatus')->first();
                            $lecture_count = 0;
                            if ($course->getCourseStatus->count() > 0) {
                                foreach ($course->getCourseStatus as $value) {
                                    $lecture_count = $lecture_count + $value->getLectures->count();
                                }
                            }
                            $enrollment = Online_enrollment::create([
                                'course_id' => $cart_item['course_id'],
                                'user_id' => auth()->id()
                            ]);
                            if($enrollment){
                                $course_tracking = Course_tracking::create([
                                    'course_id' => $cart_item['course_id'],
                                    'user_id' => auth()->id(),
                                    'no_of_lectures' => $lecture_count,
                                    'viewed_lectures' => 0
                                ]);
                            }
                        }
                    }else{
                        $check_enrollment = Offline_enrollment::where('course_id', $cart_item['course_id'])->where('user_id', auth()->id())->first();
                        if(empty($check_enrollment)){
                            $enrollment = Offline_enrollment::create([
                                'course_id' => $cart_item['course_id'],
                                'user_id' => auth()->id()
                            ]);
                        }
                    }
                }
                Cart::empty_cart();
                return json_encode(['Success' => true, 'Message' => __('translation.Order was created successfully')]);
            }
        } catch (\Throwable $th) {
            return json_encode(['Success' => false, 'Message' => $th->getMessage() ]);
        }
    }

    public function proceed_payment(Request $request){
        /* 
    ==========================================================================
         결제 API URL                                                                 
    --------------------------------------------------------------------------
    */
    // $target_URL = "https://stg-spl.kcp.co.kr/gw/enc/v1/payment"; // development server
    $target_URL = "https://spl.kcp.co.kr/gw/enc/v1/payment"; // operation server
    /* 
    ==========================================================================
         요청정보                                                                
    --------------------------------------------------------------------------
    */
    $tran_cd            = $request->tran_cd; // request code
    $site_cd            = $request->site_cd; // site code
    // Certificate information (serialized)
    $kcp_cert_info      = "-----BEGIN CERTIFICATE-----MIIDjDCCAnSgAwIBAgIHBy/vlsKxuDANBgkqhkiG9w0BAQsFADBzMQswCQYDVQQGEwJLUjEOMAwGA1UECAwFU2VvdWwxEDAOBgNVBAcMB0d1cm8tZ3UxFTATBgNVBAoMDE5ITktDUCBDb3JwLjETMBEGA1UECwwKSVQgQ2VudGVyLjEWMBQGA1UEAwwNc3BsLmtjcC5jby5rcjAeFw0yMzAzMDkwMTIzNTdaFw0yODAzMDcwMTIzNTdaMHsxCzAJBgNVBAYTAktSMQ4wDAYDVQQIDAVTZW91bDEQMA4GA1UEBwwHR3Vyby1ndTEWMBQGA1UECgwNTkhOIEtDUCBDb3JwLjEXMBUGA1UECwwOUEdXRUJERVYgVGVhbS4xGTAXBgNVBAMMEDIwMjMwMzA5MTAwMDQ4ODYwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQCg2269Ns2iWkFdthzarNBX/l3ChWhVds/0nje01/MtLG5DSfTXhgg8iH8JPbszOuvGYCMytKF7oGfV7c8XMjSRK+QPWYOQ5zx428oZUhx2Y62eFdzP4ScC65e+kagc9H05AGAlA+cgSWdKS63ckqN2ydZOcTlSTlQeMfd85jdC5iyIT/mLC3GCFldmZdVcVNCbfpLoX7PerO5n/pW280l+rotA1OQZF/mmMGsp+ZkrI5BeOFNcWoWrvKfXWz1MEBZ/ZvHGnOuiRRr2utcDCV0tQ3F6DEuXmi89MTWJPx8KWBsrRj5iyTUmUsEu0waQxjdI15vsRmtQ5RJIBSB7IbsfAgMBAAGjHTAbMA4GA1UdDwEB/wQEAwIHgDAJBgNVHRMEAjAAMA0GCSqGSIb3DQEBCwUAA4IBAQC7L7nBRts0YPRHTjMZxXmCVdLJ9JBn/8qy7XEB0WSAaPcMkKl7nCT0kxnxEPUcmsGQp/stJ2exJBk3OECzl6t6yX6bZLi7XBm57bjjJo9rvBD8wtNsPJJfeyBi+yIOKBGPxri3CgiIkHl5vtJBVfshzZYwK+P6AcnGiCAbtLRfXx+pcAF76GJ1Lc3CnEmpDaO++ZXqvGgkWrwUcYlWIyXmph581rYGDkbHx6H3NUM7Wl6tbTRgXWlcaqUpqIxAaTfhtLUiUUKuaxoFG0YrpW9YUsiz8/ed34PppgYtrsCpWww/Ep2cod6gQesDymTaIlRFURCOtXFiWA00AmaCOVp1-----END CERTIFICATE-----";
    $enc_data           = $request->enc_data; // Encryption authentication data
    $enc_info           = $request->enc_info; // Encryption authentication data  
    $ordr_mony          = '1000'; // Payment request amount   ** 1 For Won, you must enter the amount of Won that you actually have to pay at the company. Payment amount validation **
    /* = -------------------------------------------------------------------------- = */
    $use_pay_method     = $request->use_pay_method; // Payment Method
    $ordr_idxx          = $request->ordr_idxx; // Order Number
    
    $data = array( "tran_cd"        => $tran_cd, 
				   "site_cd"        => $site_cd,
				   "kcp_cert_info"  => $kcp_cert_info,
				   "enc_data"       => $enc_data,
				   "enc_info"       => $enc_info,
				   "ordr_mony"      => $ordr_mony
                 );
    
    $req_data = json_encode($data);
    
    $header_data = array( "Content-Type: application/json", "charset=utf-8" );
    
    // API REQ
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $target_URL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data); 
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    // API RES
    $res_data  = curl_exec($ch); 
    
    /* 
    ==========================================================================
    Response information                                                               
    --------------------------------------------------------------------------
    */
    // common
    $res_cd         = "";
    $res_msg        = "";
    $res_en_msg     = "";
    $tno            = "";
    $amount         = "";
    $app_time       = ""; // Common (card: approval time, account transfer: account transfer time, virtual account: virtual account numbering time)
    // card
    $card_cd     = ""; // card code
    $card_name   = ""; // card company
    $app_no      = ""; // Approval number
    $quota       = ""; // installment month
    $noinf       = ""; // interest free
    // point
    $pnt_issue        = ""; // point service company
    $add_pnt          = ""; // occurrence point
    $use_pnt          = ""; // available points
    $rsv_pnt          = ""; // earned points
    $pnt_app_time     = ""; // approval time
    $pnt_app_no       = ""; // Approval number
    $pnt_amount       = ""; // Accumulated amount or used amount
    // account transfer
    $bank_name        = ""; // name of bank
    $bank_code        = ""; // bank code
    // Virtual Account
    $bankname         = ""; // bank to deposit
    $bankcode         = ""; // bank code to deposit
    $depositor        = ""; // Depositor of the account to be deposited
    $account          = ""; // account number to deposit
    $va_date          = ""; // Virtual account deposit deadline
    // cell phone
    $commid           = ""; // carrier code
    $mobile_no        = ""; // phone number
    // gift card
    $tk_van_code      = ""; // issuer code
    $tk_app_no        = ""; // Approval number
    $tk_app_time      = ""; // Gift certificate approval time
    // Cash receipts
    $cash_yn        = $request->cash_yn; // Registered Cash Receipt
    $cash_tr_code   = $request->cash_tr_code; // Issuance of cash receipt
    $cash_id_info   = $request->cash_id_info; // Cash Receipt Registration Number
    $cash_authno    = ""; // Cash Receipt Authorization Number
    $cash_no        = ""; // Cash Receipt Transaction Number    
    
    // RES JSON DATA Parsing
    $json_res = json_decode($res_data, true);
    
    $res_cd = $json_res["res_cd"];
    $res_msg = $json_res["res_msg"];
    
    if ( $res_cd == "0000" )
    {
        $tno       = $json_res["tno"];
        $res_cd    = $json_res["res_cd"];
        $res_msg   = $json_res["res_msg"];
        $amount    = $json_res["amount"];
        
        // card
        if ( $use_pay_method == "100000000000" )
        {
            $card_cd   = $json_res["card_cd"];
            $card_name = $json_res["card_name"];
            $app_no    = $json_res["app_no"];
            $app_time  = $json_res["app_time"];
            $noinf     = $json_res["noinf"];
            $quota     = $json_res["quota"];
            // Point Complex Payment
            $pnt_issue = $json_res["pnt_issue"];
            if ( $pnt_issue == "SCSK" || $pnt_issue ==  "SCWB" )
            {
                $pnt_issue    = $json_res["pnt_issue"];
                $add_pnt      = $json_res["add_pnt"];
                $use_pnt      = $json_res["use_pnt"];
                $rsv_pnt      = $json_res["rsv_pnt"];
                $pnt_app_time = $json_res["pnt_app_time"];
                $pnt_app_no   = $json_res["pnt_app_no"];
                $pnt_amount   = $json_res["pnt_amount"];
                // When issuing a cash receipt
                if ( $cash_yn == "Y" )
                {
                    $cash_authno = $json_res["cash_authno"];
                    $cash_no     = $json_res["cash_no"];
                }
            }
        }
        // account transfer
        else if ( $use_pay_method == "010000000000" )
        {
            $bank_name = $json_res["bank_name"];
            $bank_code = $json_res["bank_code"];
            $app_time  = $json_res["app_time"];
            
            // When issuing a cash receipt
            if ( $cash_yn == "Y" )
            {
                $cash_authno = $json_res["cash_authno"];
                $cash_no     = $json_res["cash_no"];
            }
        }
        // Virtual Account
        else if ( $use_pay_method == "001000000000" )
        {
            $bankname  = $json_res["bankname"];
            $bankcode  = $json_res["bankcode"];
            $depositor = $json_res["depositor"];
            $account   = $json_res["account"];
            $va_date   = $json_res["va_date"];
            $app_time  = $json_res["app_time"];
            
            // When issuing a cash receipt
            if ( $cash_yn == "Y" )
            {
                // Processing after issuance of cash receipt
                //$cash_authno = $json_res["cash_authno"];
                //$cash_no     = $json_res["cash_no"];
            }
        }
        // point
        else if ( $use_pay_method == "000100000000" )
        {
            $pnt_issue    = $json_res["pnt_issue"];
            $add_pnt      = $json_res["add_pnt"];
            $use_pnt      = $json_res["use_pnt"];
            $rsv_pnt      = $json_res["rsv_pnt"];
            $pnt_app_time = $json_res["pnt_app_time"];
            $pnt_app_no   = $json_res["pnt_app_no"];
            $pnt_amount   = $json_res["pnt_amount"];
            // When issuing a cash receipt
            if ( $cash_yn == "Y" )
            {
                $cash_authno = $json_res["cash_authno"];
                $cash_no     = $json_res["cash_no"];
            }
        }
        // cell phone
        else if ( $use_pay_method == "000010000000" )
        {
            $app_time    = $json_res["app_time"];
            $commid      = $json_res["commid"];
            $mobile_no   = $json_res["mobile_no"];
        }
        // gift card
        else if ( $use_pay_method == "000000001000" )
        {
            $tk_van_code  = $json_res["tk_van_code"];
            $tk_app_no    = $json_res["tk_app_no"];
            $tk_app_time  = $json_res["tk_app_time"];
        }
    }
    
    curl_close($ch); 
    
    /* 
    ==========================================================================
         승인 결과 DB 처리 실패시 : 자동취소
    --------------------------------------------------------------------------
         승인 결과를 DB 작업 하는 과정에서 정상적으로 승인된 건에 대해
    DB 작업을 실패하여 DB update 가 완료되지 않은 경우, 자동으로
         승인 취소 요청을 하는 프로세스가 구성되어 있습니다.

    DB 작업이 실패 한 경우, bSucc 라는 변수(String)의 값을 "false"
         로 설정해 주시기 바랍니다. (DB 작업 성공의 경우에는 "false" 이외의
         값을 설정하시면 됩니다.)
    --------------------------------------------------------------------------
    */
    $bSucc = "";
    
    if ( $res_cd == "0000" )
    {
        if ( $bSucc == "false")
        {
            $res_data      = "";
            $req_data      = "";
            $kcp_sign_data = "";
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
            $pri_key = openssl_pkey_get_private($key_data,'changeit');
            
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
                "site_cd"        => $site_cd,
                "kcp_cert_info"  => $kcp_cert_info,
                "kcp_sign_data"  => $kcp_sign_data,
                "tno"            => $tno,
                "mod_type"       => "STSC",
                "mod_desc"       => "가맹점 DB 처리 실패(자동취소)"
            );
            
            $req_data = json_encode($data);
            
            $header_data = array( "Content-Type: application/json", "charset=utf-8" );
            
            // API REQ
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $target_URL);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $req_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            
            // API RES
            $res_data  = curl_exec($ch);
            
            // RES JSON DATA Parsing
            $json_res = json_decode($res_data, true);
            
            $res_cd = $json_res["res_cd"];
            $res_msg = $json_res["res_msg"];

            curl_close($ch); 
        }
    }
    dd($json_res);
    }
}
