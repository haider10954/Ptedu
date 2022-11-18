<?php

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


Route::prefix('admin')->group(function () {

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

    Route::get('/student--info' , function() {
        return view('admin.student.student_info');
    })->name('student_info');

    Route::get('/tutor', function(){
        return view ('admin.tutor.tutor');
    })->name('tutor');

    Route::get('/tutor/add', function(){
        return view ('admin.tutor.add_tutor');
    })->name('add_tutor');
});
