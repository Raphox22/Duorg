<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('description')->unique(); // Exemplo: Administrador, Receptor, Doador
            $table->timestamps();
        });
        // Adicionando os registros iniciais
        DB::table('profiles')->insert([
            ['description' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Receptor', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Doador', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
