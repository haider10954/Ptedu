<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Category;
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
        //
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
            $course_categories = Category::with('getCourses')->get();
            view()->share('course_categories', $course_categories);
        }
    }
}
