<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Offline_course;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function reservation_listing($id)
    {

        $reservations = Offline_course::where('id', $id)->first();
        $reservation = Reservation::where('course_id', $id)->paginate(10);
        return view('admin.offline_lectures.waiting_listing', compact('reservations', 'reservation'));
    }
    public function Reverse_course(Request $request)
    {
        $addReservation = Reservation::create([
            'user_id' => auth()->id(),
            'course_id' => $request->id,
            'status' => 'applied'
        ]);

        if ($addReservation) {
            return json_encode([
                'success' => true,
                'message' => 'Course Reserved Successfully',
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'An Unknown Error Exist , Please try again',
            ]);
        }
    }

    public function delete_Reverse_course(Request $request)
    {
        $deleteReservation = Reservation::create([]);

        if ($deleteReservation) {
            return json_encode([
                'success' => true,
                'message' => 'Course Reserved deleted Successfully',
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'An Unknown Error Exist , Please try again',
            ]);
        }
    }

    public function update_status(Request $request)
    {
        $status = $request->post('status');
        $id = $request->post('id');
        $course_status = Reservation::where('id', $id)->update([
            'status' => $status,
        ]);

        if ($course_status) {
            return response()->json([
                'success' => true,
                'message' => 'Course Reservation Status Updated Successfully',
            ]);
        } else {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong Please try again.',
            ]);
        }
    }
    public function delete_reservation(Request $request)
    {

        $user = Reservation::where('id', $request->id)->delete();
        if ($user) {
            return redirect()->back()->with('success', 'Reservation deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again later');
        }
    }
}
