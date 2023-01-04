<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Cart;

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
}
