<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('archivos_proyectos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peticion_id')->constrained('peticiones_proyectos');
            $table->string('tipo');
            $table->string('archivo_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('archivos_proyectos');
    }
};


