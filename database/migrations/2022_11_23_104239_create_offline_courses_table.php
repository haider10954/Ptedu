<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offline_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_id')->constrained('tutors');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('course_title');
            $table->longText('short_description');
            $table->longText('description');
            $table->bigInteger('no_of_lectures');
            $table->string('duration_of_course');
            $table->bigInteger('price');
            $table->bigInteger('discounted_prize');
            $table->longText('video_url');
            $table->text('video');
            $table->text('course_thumbnail');
            $table->text('course_banner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offline_courses');
    }
};
