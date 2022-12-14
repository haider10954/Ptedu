<?php

namespace App\Http\Controllers\user;

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
            return redirect()->back()->with('msg', 'Review has been deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later');
        }
    }
    public function review()
    {
        $review = Review::with(['getCourse.getCategoryName'])->get();
        if ($review->count() > 0) {
            for ($i = 0; $i <  $review->count(); $i++) {
                if (!empty($review[$i]->video_url) || !empty($review[$i]->video)) {
                    if (empty($review[$i]->video_url)) {
                        $embedded_video = '<video src="' . asset('storage/review/video') . '/' . $review[$i]->video . '" controls></video>';
                    }

                    if (empty($review[$i]->video)) {
                        $video_handler = new VideoHandler();
                        $video_url = $video_handler->getVideoInfo($review[$i]->video_url);
                        $embedded_video = $video_url->html;
                    }

                    if (!empty($review[$i]->video_url) && !empty($review[$i]->video)) {
                        $video_handler = new VideoHandler();
                        $video_url = $video_handler->getVideoInfo($review[$i]->video_url);
                        $embedded_video = $video_url->html;
                    }
                }
            }
        } else {
            $embedded_video = "";
        }

        if ($review->count() > 0) {
            $latest_review = $review[$review->count() - 1];
        } else {
            $latest_review = [];
        }
        $category  = Category::with('getReviews')->get();
        return view('user.review', compact('review', 'latest_review', 'embedded_video', 'category'));
    }

    function upload_files($file)
    {
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
            'contents' => 'required',
            'video' => 'mimes:mp4',
        ]);

        if ($request->hasFile('video')) {
            $video = $this->upload_files($request['video']);
        } else {
            $video = null;
        }


        $review = Review::create([
            'course_id' => $request->course_id,
            'categroy_id' => $request->categroy_id,
            'user_id' => auth()->id(),
            'title' => $request['title'],
            'content' => $request['contents'],
            'rating' => $request['rating'],
            'video' => $video,
            'video_url' => $request['video_url'],
        ]);


        if ($review) {
            return json_encode([
                'success' => true,
                'message' => 'Review has been added Successfully',
            ]);
        } else {
            return json_encode([
                'success' => false,
                'message' => 'Something went wrong. Please try again later',
            ]);
        }
    }
}
