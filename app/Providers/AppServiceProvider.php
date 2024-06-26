<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Category;
use App\Models\Offline_course;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadHelpers();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('courses')) {
            $expert_courses = Course::with('getTutorName')->where('course_type', 'online')->take(10)->get();
            $public_courses = Course::with('getTutorName')->where('course_type', 'offline')->take(5)->get();
            view()->share('online_expert_courses', $expert_courses->chunk(5));
            view()->share('online_public_courses', $public_courses);
        }
        if (\Schema::hasTable('categories')){
            $course_categories = Category::with(['getCourses','getOffineCourses'])->where('type','online')->get();
            $course_offline_categories = Category::with(['getCourses','getOffineCourses'])->where('type','offline')->get();
            view()->share('course_categories', $course_categories);
            view()->share('course_offline_categories', $course_offline_categories);
        }
        if (\Schema::hasTable('offline_courses')) {
            $offline_courses = Offline_course::with('getTutorName')->take(10)->get();
            view()->share('offline_courses', $offline_courses);
        }
    }


    private function loadHelpers()
    {
        foreach(glob(__DIR__."/../Helpers/*.php") as $file)
        {
            require_once $file;
        }
    }
}
