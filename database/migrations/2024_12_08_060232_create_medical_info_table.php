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
        Schema::create('medical_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['RECEPTOR', 'DOADOR']);
            $table->string('blood_type');
            $table->string('rh_factor');
            $table->json('organs')->nullable(); // Exemplo: ['coração', 'rim']
            $table->text('health_problems')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('transplant_history')->nullable();
            $table->boolean('alcohol_consumer')->nullable();
            $table->boolean('smoker')->nullable();
            $table->text('family_history')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_info');
    }
};
