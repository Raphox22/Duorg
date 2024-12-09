<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_organ', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relacionamento com Usuários
            $table->foreignId('organ_id')->constrained('organs')->onDelete('cascade'); // Relacionamento com Órgãos
            $table->enum('type', ['RECEPTOR', 'DOADOR']); // Tipo de relação
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_organ');
    }
};
