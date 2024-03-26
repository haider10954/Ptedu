<?php

namespace App\Http\Controllers\user;

use App\Models\Offline_review;
use App\Service\VideoHandler;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function admin_side_listing()
    {
        $review = Review::paginate(10);
        return view('admin.review_management.review_management', compact('review'));
    }

    public function delete_review(Request $request)
    {
        $review = Review::where('id', $request->id)->delete();

        if ($review) {
            return redirect()->back()->with('msg', __('translation.Review has been deleted successfully'));
        } else {
            return redirect()->back()->with('error', __('translation.Something went wrong Please try again'));
        }
    }

    public function review()
    {
        $review = Review::query()->with(['getCourse.getCategoryName','getUser'])->get();
        $embedded_video = '<video src="' . asset('storage/review/video') . '" controls></video>';

        if ($review->count() > 0) {
            $latest_review = $review[$review->count() - 1];
        } else {
            $latest_review = [];
        }
        $category = Category::with('getReviews')->where('type','offline')->get();
        return view('user.review', compact('review', 'latest_review', 'embedded_video', 'category'));
    }

    public function offline_review()
    {
        $review = Offline_review::with('getCousreName')->get();

        if ($review->count() > 0) {
            $latest_review = $review[$review->count() - 1];
        } else {
            $latest_review = [];
        }
        $category = Category::with('getReviews')->where('type','offline')->get();
        return view('user.offline_review',compact('review','latest_review','category'));
    }

    function upload_files($file)
    {
        if (!file_exists(storage_path('app/public/review/video'))) {
            mkdir(storage_path('app/public/review/video'), 0755, true);
        }
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/review/video', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    public function add_review(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'title' => 'required',
            'contents' => 'required'
        ]);

        // if ($request->hasFile('video')) {
        //     $video = $this->upload_files($request['video']);
        // } else {
        //     $video = null;
        // }

        if ($request->course_type == 'offline') {
            $review = Offline_review::query()->create([
                'course_id' => $request->course_id,
                'user_id' => auth()->id(),
                'title' => $request['title'],
                'content' => $request['contents'],
                'rating' => $request['rating'],
            ]);
        } else {
            $review = Review::query()->create([
                'course_id' => $request->course_id,
                'categroy_id' => $request->categroy_id,
                'user_id' => auth()->id(),
                'title' => $request['title'],
                'content' => $request['contents'],
                'rating' => $request['rating'],
            ]);
        }


        if ($review) {
            return json_encode([
                'success' => true,
                'message' => __('translation.Review upload completed'),
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => __('translation.Something went wrong Please try again'),
            ]);
        }
    }
}
