<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Cliente que hace el pedido
            $table->decimal('total', 10, 2); // Precio total del pedido
            $table->enum('estado', ['pendiente', 'procesando', 'enviado', 'entregado', 'cancelado'])->default('pendiente');
            $table->timestamps();

            // Relación con Usuarios
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};
