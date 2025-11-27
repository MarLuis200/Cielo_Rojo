<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reconocimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('administrador_id')->constrained('administradores')->onDelete('cascade');
            $table->string('titulo', 255);
            $table->json('contenido');
            $table->enum('estado', ['borrador', 'publicado'])->default('borrador');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reconocimientos');
    }
};
