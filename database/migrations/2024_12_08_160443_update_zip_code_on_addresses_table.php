<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateZipCodeOnAddressesTable extends Migration
{
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('zip_code')->nullable()->change(); // Permite valores NULL
        });
    }

    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('zip_code')->nullable(false)->change(); // Reverte para NOT NULL
        });
    }
}
