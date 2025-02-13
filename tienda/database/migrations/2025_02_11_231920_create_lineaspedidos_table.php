<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineaspedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineaspedidos', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('pedido_id'); 
            $table->unsignedBigInteger('producto_id'); 
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2); 
            $table->decimal('total', 10, 2); 
            $table->timestamps(); 

            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lineaspedidos');
    }
}
