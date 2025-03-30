<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('project_requests', function (Blueprint $table) {
            $table->id();
            
            // Información básica del cliente
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address')->nullable();
            
            // Tipo de proyecto
            $table->string('project_type');
            $table->text('description');
            $table->string('budget')->nullable();
            $table->string('timeline')->nullable();
            
            // Campos específicos por tipo de proyecto (como JSON)
            $table->json('stairs_details')->nullable();
            $table->json('railings_details')->nullable();
            $table->json('doors_details')->nullable();
            $table->json('other_details')->nullable();
            
            // Archivos adjuntos (guardaremos la ruta de los archivos)
            $table->json('files')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_requests');
    }
}