<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\CourseLectureController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\NoticeController;
use App\Http\Controllers\admin\OfflineCourseController;
use App\Http\Controllers\admin\TutorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\IndexController;
use App\Http\Controllers\admin\CourseSectionController;
use App\Http\Controllers\user\ReviewController;
use App\Http\Controllers\user\CourseController as UserCourseController;
use App\Http\Controllers\user\InquiryController;
use App\Http\Controllers\user\LectureController;
use App\Http\Controllers\user\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main site routes start
Route::post('/student-register', [StudentController::class, 'student_register'])->name('student_register');
Route::post('/student-login', [StudentController::class, 'student_login'])->name('student_login');
Route::get('/student/logout', [StudentController::class, 'logout'])->name('student_logout');
Route::post('/check-user-id', [StudentController::class, 'checkUserId'])->name('check_user_id');

Route::get('/', [IndexController::class, 'index'])->name('web-home');

Route::middleware('auth')->group(function () {

    Route::get('/offline-lectures', [LectureController::class, 'offline_lectures'])->name('offline_lectures');
    Route::get('/lecture-detail', [LectureController::class, 'lecture_detail'])->name('lecture_detail');
    Route::get('/offline-course-detail/{id}', [LectureController::class, 'offline_lecture_detail'])->name('offline_lecture_detail');
    Route::get('/review', [ReviewController::class, 'review'])->name('review');
    Route::get('/notice', [IndexController::class, 'notice'])->name('web-notice');
    Route::get('/faq', [IndexController::class, 'faq'])->name('web-faq');
    Route::get('/online-course', [UserCourseController::class, 'online_course'])->name('online_course');
    Route::get('/my-classroom', [LectureController::class, 'my_classroom'])->name('my_classroom');
    Route::get('/shopping-bag', function () {
        return view('user.shopping_bag');
    })->name('shopping_bag');

    Route::get('/order', function () {
        return view('user.order');
    })->name('order');

    Route::get('/user-information', function () {
        return view('user.user_info');
    })->name('user_info');
    Route::post('/update/info', [StudentController::class, 'update_student_profile'])->name('update_user_info');
    Route::post('/delete-image', [StudentController::class, 'delete_profile_image'])->name('delete-image');
    Route::get('/inquiry', [InquiryController::class, 'inquiry_listing'])->name('user_inquiry');

    Route::get('/inquiry/add', function () {
        return view('user.add_inquiry');
    })->name('add_inquiry');
    Route::post('/add-inquiry', [InquiryController::class, 'add_inquiry'])->name('add-inquiry');

    Route::get('/inquiry-not-answered/{id}', [InquiryController::class, 'not_answer_inquiry'])->name('inquiry_not_answered');
    Route::get('/inquiry-answered/{id}', [InquiryController::class, 'answered_inquiry'])->name('inquiry_answered');

    Route::get('/change-user-password', function () {
        return view('user.change_password');
    })->name('change-user-password');
    Route::post('/update-user-password', [StudentController::class, 'change_password'])->name('user-password');
});

Route::get('/user/login', function () {
    return view('user.login_user');
})->name('user_login');

Route::get('/find-ID', function () {
    return view('user.find_id');
})->name('find_id');
Route::post('/find-id', [StudentController::class, 'find_id'])->name('find-id');

Route::get('/find-PW', function () {
    return view('user.find_password');
})->name('find_password');
Route::post('/find-password', [StudentController::class, 'Password_reset'])->name('find-password');
Route::post('/update-password', [StudentController::class, 'reset_password'])->name('reset-password');
Route::get('/reset-password', function () {
    return view('user.reset_password');
})->name('reset_password');


Route::get('/user/register', function () {
    return view('user.register');
})->name('user_register');
// Main site routes end

Route::get('/admin-logout', [AuthController::class, 'logout'])->name('admin_auth_logout');

//Login
Route::middleware('guest:admin')->group(function () {
    Route::post('admin-login', [AuthController::class, 'login'])->name('admin_auth_login');

    Route::get('/admin/login', function () {
        return view('admin.login.login');
    })->name('admin_login');
});

Route::prefix('admin')->group(function () {


    Route::post('/update-admin-password', [AuthController::class, 'update_password'])->name('update-password');
    Route::middleware('auth:admin')->group(function () {

        //Categories
        Route::get('/category', [CategoryController::class, 'category_listing'])->name('category');
        Route::get('/category/add', function () {
            return view('admin.category.add_category');
        })->name('add_category');
        Route::post('/add-category', [CategoryController::class, 'add_category'])->name('add-category');
        Route::post('/delete-category', [CategoryController::class, 'delete_category'])->name('delete-category');
        Route::get('/edit-category/{id}', [CategoryController::class, 'edit_category_view'])->name('edit_category');
        Route::post('/edit_category', [CategoryController::class, 'edit_category'])->name('edit-category');
        //End Category

        //Online Courses
        Route::get('/courses', [CourseController::class, 'course_listing'])->name('course');
        Route::get('/course/add', [CourseController::class, 'add_course_view'])->name('add_lectures');
        Route::post('/delete-course', [CourseController::class, 'delete_course'])->name('delete-course');
        Route::get('/edit-course/{id}', [CourseController::class, 'edit_course_view'])->name('edit_course_view');
        Route::post('/edit-course', [CourseController::class, 'edit_course'])->name('edit-course');
        //End Online Course

        // Course - Sections - Lectures Upload start
        Route::get('/courses/add', [CourseController::class, 'add_courses_view'])->name('add_course');
        Route::post('/add-course', [CourseController::class, 'add_course'])->name('add-course');

        Route::post('/add-sections', [CourseController::class, 'add_sections'])->name('add-sections');

        Route::post('/add-lectures-action', [CourseController::class, 'add_lectures'])->name('add-lectures-submit');
        // Course - Sections - Lectures Upload end

        //Offline Course
        Route::get('/offline-lectures', [OfflineCourseController::class, 'offline_course_listing'])->name('offline_lectures_admin');
        Route::get('/offline-course/add', [OfflineCourseController::class, 'add_offline_course_view'])->name('add_offline_course_view');
        Route::post('/add-offline-course', [OfflineCourseController::class, 'add_offline_course'])->name('add-offline-course');
        Route::post('/delete-offline-course', [OfflineCourseController::class, 'delete_offline_course'])->name('delete-offline-course');
        Route::get('/edit-offline-course/{id}', [OfflineCourseController::class, 'edit_offline_course_view'])->name('edit_offline_course_view');
        Route::post('/edit-offline-course', [OfflineCourseController::class, 'edit_offline_course'])->name('edit-offline-course');
        //End Offline Course

        Route::get('/offline-lectures/waiting-list', function () {
            return view('admin.offline_lectures.waiting_listing');
        })->name('waiting_list');

        Route::get('/review-management', function () {
            return view('admin.review_management.review_management');
        })->name('reviews');

        Route::get('/student-list', function () {
            return view('admin.student.student_list');
        })->name('student');

        Route::get('/student--info', function () {
            return view('admin.student.student_info');
        })->name('student_info');

        //Tutor
        Route::get('/tutor', [TutorController::class, 'tutor_listing'])->name('tutor');
        Route::post('add-tutor', [TutorController::class, 'add_tutor'])->name('add-tutor');
        Route::post('/delete-tutor', [TutorController::class, 'delete_tutor'])->name('delete-tutor');
        Route::get('/edit-tutor/{id}', [TutorController::class, 'edit_tutor_view'])->name('edit_tutor');
        Route::post('/edit-tutor', [TutorController::class, 'edit_tutor'])->name('edit-tutor');

        Route::get('/tutor/add', function () {
            return view('admin.tutor.add_tutor');
        })->name('add_tutor');
        //End Tutor

        //Section
        Route::get('/courses/sections/{id}', [CourseSectionController::class, 'section_listing'])->name('sections');
        Route::post('add-course-section', [CourseSectionController::class, 'add_section'])->name('add-section');
        Route::get('/course/sections/add/{id}', [CourseSectionController::class, 'add_section_view'])->name('add_sections');
        Route::post('/delete-course-section', [CourseSectionController::class, 'delete_course_section'])->name('delete-course-section');
        Route::get('/course/edit_sections/{id}', [CourseSectionController::class, 'edit_section_view'])->name('edit-section-view');
        Route::post('/edit-course-section', [CourseSectionController::class, 'edit_course_section'])->name('edit-course-section');
        //End Section

        //Course Lectures
        Route::get('/course/section/lectures/{id}', [CourseLectureController::class, 'course_lecture_listing'])->name('lectures');
        Route::get('/course/section/lecture/add/{id}', [CourseLectureController::class, 'add_course_lecture_view'])->name('add_lecture');
        Route::post('/add-lectures', [CourseLectureController::class, 'add_course_lecture'])->name('add-course-lecture');
        Route::post('/delete-course-lecture', [CourseLectureController::class, 'delete_course_lecture'])->name('delete-course-lecture');
        //End Course Lecture
        Route::get('/payment', function () {
            return view('admin.payment.payment');
        })->name('payment');

        Route::get('/payment/view_payment', function () {
            return view('admin.payment.view_payment');
        })->name('view_payment');

        //Inquiry
        Route::get('/inquiry', [InquiryController::class, 'inquiry_listing_admin'])->name('inquiry');
        Route::get('/inquiry/answer/{id}', [InquiryController::class, 'answer_inquiry_admin'])->name('inquiry_answer');
        Route::post('/add-answer', [InquiryController::class, 'add_answer'])->name('add-answer');
        Route::get('/certificate', function () {
            return view('admin.certificate.completed_student');
        })->name('certificate');

        Route::get('/certificate/add', function () {
            return view('admin.certificate.add_certificate');
        })->name('add_certificate');

        Route::get('/certificate/generate', function () {
            return view('admin.certificate.certificate');
        })->name('generate_certificate');

        //Notice
        Route::get('/notice', [NoticeController::class, 'notice_listing'])->name('notice');
        Route::get('/notice/add', [NoticeController::class, 'add_notice_view'])->name('add_notice');
        Route::post('/add-notice', [NoticeController::class, 'add_notice'])->name('add-notice');
        Route::post('/delete-notice', [NoticeController::class, 'delete_notice'])->name('delete-notice');
        Route::get('/edit_notice/{id}', [NoticeController::class, 'edit_notice_view'])->name('edit_notice_view');
        Route::post('/edit-notice', [NoticeController::class, 'edit_notice'])->name('edit-notice');

        //End Notice

        //Faqs
        Route::get('/faqs', [FaqController::class, 'faq_listing'])->name('faqs');
        Route::get('/faqs/add', [FaqController::class, 'add_faqs_view'])->name('add_faqs');
        Route::post('/add-faq', [FaqController::class, 'add_faq'])->name('add-faq');
        Route::post('/delete-faq', [FaqController::class, 'delete_faq'])->name('delete-faq');
        Route::get('/edit_faq/{id}', [FaqController::class, 'edit_faqs_view'])->name('edit_faq_view');
        Route::post('/edit-faq', [FaqController::class, 'edit_faq'])->name('edit-faq');
        //End Faq

        //Settings
        Route::get('/settings', [AuthController::class, 'admin_profile'])->name('settings');
        Route::post('/update-admin-profile', [AuthController::class, 'update_admin_profile'])->name('update-admin-profile');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
