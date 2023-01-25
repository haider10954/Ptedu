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
            return json_encode(['Success' => true, 'Msg' => 'Course successfully added' , 'cart_items_count' => count(session('shopping_cart'))]);
        }else{
            return json_encode(['Success' => false, 'Msg' => 'Course already added to cart' , 'cart_items_count' => count(session('shopping_cart'))]);
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
            return json_encode(['Success' => true, 'Msg' => 'Cart Updated added' , 'cart_items_count' => count(session('shopping_cart')) , 'html' => $html]);
        }else{
            return json_encode(['Success' => true, 'Msg' => 'Error : Try Again']);
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
                return json_encode(['Success' => true, 'Message' => 'Order was created successfully']);
            }
        } catch (\Throwable $th) {
            return json_encode(['Success' => false, 'Message' => $th->getMessage() ]);
        }
    }
}
