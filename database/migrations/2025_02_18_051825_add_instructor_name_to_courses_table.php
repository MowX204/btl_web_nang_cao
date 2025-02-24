<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('instructor_name')->default('Chưa có giảng viên')->after('description');
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('instructor_name');
        });
    }
};
