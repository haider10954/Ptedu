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
        Schema::table('admins', function (Blueprint $table) {
            $table->string('english_name')->nullable()->after('email');
            $table->varchar('phone_number')->nullable()->after('english_name');
            $table->string('job')->nullable()->after('phone_number');
            $table->text('profile_img')->nullable()->after('job');
            $table->longText('address')->nullable()->after('profile_img');
            $table->longText('introduction')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
        });
    }
};
