<?php

namespace App\Providers;

use App\Models\Course;
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
        $expert_courses = Course::with('getTutorName')->where('course_type', 'expert')->take(5)->get();
        $public_courses = Course::with('getTutorName')->where('course_type', 'public')->take(5)->get();
        view()->share('online_expert_courses', $expert_courses);
        view()->share('online_public_courses', $public_courses);
    }
}
