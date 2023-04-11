<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            
            $table->engine="InnoDB";
            
            $table->bigIncrements('id');
            $table->bigInteger('idproducto')->unsigned();
            $table->integer('cantidad');
            $table->decimal('precio_unitario');
            $table->decimal('precio_total');
            $table->string('estatus');
            
            $table->timestamps();

            $table->foreign('idproducto')->references('id')->on('productos')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};
