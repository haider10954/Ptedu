<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order_listing()
    {
        $order = Order::with(['getUser','getTransaction'])->paginate(10);
        return view('admin.payment.payment', compact('order'));
    }

    public function delete_order(Request $request)
    {
        $order = Order::where('id', $request->id)->delete();
        if ($order) {
            return redirect()->back()->with('msg', __('translation.Order has been deleted Successfully'));
        } else {
            return redirect()->back()->with('error', __('translation.Something went wrong Please try again.'));
        }
    }

    public function update_order_status(Request $request)
    {
        $update_order_status = Order::where('id', $request->id)->update([
            'status' => $request->status,
            'payment_status' => $request->status
        ]);
        if ($update_order_status) {
            return json_encode([
                'success' => true,
                'message' =>  __('translation.Order Status has been updated successfully')
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' =>  __('translation.Something went wrong Please try again')
            ]);
        }
    }

    public function view_payment($id){
        $order = Order::with(['getTransaction','getUser'])->where('id',$id)->first();
        return view('admin.payment.view_payment',compact('order'));
    }

    public function apply_filter(Request $request)
    {
        $search = $request->search;
        $order = Order::query()
            ->with(['getTransaction','getUser'])
            ->where(function ($query) use ($search) {
                $query->whereHas('getUser', function ($query) use ($search) {
                    $query->where('english_name', 'like', '%' . $search . '%');
                })
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereJsonContains('order_items',[['course_name'=>$search]])
                    ->orWhereHas('getTransaction', function ($query) use ($search) {
                        $query->where('ammount', 'like', '%' . $search . '%');
                    });
            })
            ->paginate(10);
        return view('admin.payment.payment', compact('order'));
    }
}
