<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('medical_info', function (Blueprint $table) {
            $table->string('blood_type')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('medical_info', function (Blueprint $table) {
            $table->string('blood_type')->nullable(false)->change();
        });
    }
};
