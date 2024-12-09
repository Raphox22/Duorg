<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('profile_id')->nullable()->default(1)->change(); // Altere '1' para o ID do perfil padrão
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('profile_id')->nullable(false)->default(null)->change();
        });
    }
};
