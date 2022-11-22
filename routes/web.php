<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/admin-logout', [AuthController::class, 'logout'])->name('admin_auth_logout');

//Login
Route::middleware('guest:admin')->group(function () {
    Route::post('admin-login', [AuthController::class, 'login'])->name('admin_auth_login');

    Route::get('/admin/login', function () {
        return view('admin.login.login');
    })->name('admin_login');
});

Route::prefix('admin')->group(function () {

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

        Route::get('/lectures', function () {
            return view('admin.lectures.lecture');
        })->name('lectures');

        Route::get('/lectures/add', function () {
            return view('admin.lectures.add_lecture');
        })->name('add_lectures');

        Route::get('/offline-lectures', function () {
            return view('admin.offline_lectures.offline_lectures');
        })->name('offline_lectures');

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

        Route::get('/tutor', function () {
            return view('admin.tutor.tutor');
        })->name('tutor');

        Route::get('/tutor/add', function () {
            return view('admin.tutor.add_tutor');
        })->name('add_tutor');

        Route::get('/payment', function () {
            return view('admin.payment.payment');
        })->name('payment');

        Route::get('/payment/view_payment', function () {
            return view('admin.payment.view_payment');
        })->name('view_payment');

        Route::get('/inquiry', function () {
            return view('admin.inquiry.inquiry');
        })->name('inquiry');

        Route::get('/inquiry/answer', function () {
            return view('admin.inquiry.answer');
        })->name('inquiry_answer');

        Route::get('/certificate', function () {
            return view('admin.certificate.completed_student');
        })->name('certificate');

        Route::get('/certificate/add', function () {
            return view('admin.certificate.add_certificate');
        })->name('add_certificate');

        Route::get('/certificate/generate', function () {
            return view('admin.certificate.certificate');
        })->name('generate_certificate');

        Route::get('/notice', function () {
            return view('admin.notice.notice');
        })->name('notice');

        Route::get('/notice/add', function () {
            return view('admin.notice.add_notice');
        })->name('add_notice');


        Route::get('/faqs', function () {
            return view('admin.faqs.faqs');
        })->name('faqs');

        Route::get('/faqs/add', function () {
            return view('admin.faqs.add_faqs');
        })->name('add_faqs');

        Route::get('/settings', function () {
            return view('admin.settings.settings');
        })->name('settings');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
