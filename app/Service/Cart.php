<?php

namespace App\Service;

class Cart {
    public static function add_to_cart($course){
        $cart = session()->get('shopping_cart');
        if(empty($cart)){
            $cart = [];
            array_push($cart,[
                'course_id' => $course->id,
                'course_name' => $course->course_title,
                'price' => $course->price,
                'quantity' => 1,
                'type' => $course->type,
                'discount' => $course->discounted_prize,
                'course' => $course
            ]);
            session()->put('shopping_cart',$cart);
            session()->save();
            return true;
        }else{
            foreach($cart as $value){
                if(($value['course_id'] == $course->id) && ($value['type'] == $course->type)){
                    return false;
                }
            }
            array_push($cart,[
                'course_id' => $course->id,
                'course_name' => $course->course_title,
                'price' => $course->price,
                'quantity' => 1,
                'type' => $course->type,
                'discount' => $course->discounted_prize,
                'course' => $course
            ]);
            session()->put('shopping_cart',$cart);
            session()->save();
            return true;
        }
    }
    public static function del_cart_item($course_id,$type){
        try {
            $cart_items = collect(session()->get('shopping_cart'));
            foreach($cart_items as $k => $v){
                if(($v['course_id'] == $course_id) && ($v['type'] == $type)){
                    $removeKey = $k;
                }
            }
            $cart_items->forget($removeKey);
            session()->put('shopping_cart',$cart_items->toArray());
            session()->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}