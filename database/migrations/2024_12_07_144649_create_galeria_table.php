<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeria', function (Blueprint $table) {
            $table->id();
            $table->string('ruta')->nullable();
            $table->foreignId('blog_id')->nullable()->constrained('blogs')->onDelete('cascade');
            $table->foreignId('proyecto_id')->nullable()->constrained('proyectos')->onDelete('cascade');
            $table->foreignId('reconocimiento_id')->nullable()->constrained('reconocimientos')->onDelete('cascade');
            $table->timestamps();
        });


    }

    public function down(): void
    {
        Schema::dropIfExists('galeria');
    }
};
