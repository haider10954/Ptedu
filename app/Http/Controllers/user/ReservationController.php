<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Offline_course;
use App\Models\Offline_enrollment;
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

    public function offline_course_enrollment(Request $request)
    {
        $offline_course_enrollment = Offline_enrollment::create([
            'user_id' => auth()->id(),
            'course_id' => $request->id,
        ]);

        if ($offline_course_enrollment) {
            return json_encode([
                'success' => true,
                'message' => 'You have Enrolled Course Successfully',
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'An Unknown Error Exist , Please try again',
            ]);
        }
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
        $deleteReservation = Reservation::where('user_id', auth()->id())->where('course_id', $request->course_id)->delete();

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
}
