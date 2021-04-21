<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Unidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('area')->nullable();
            $table->string('numero')->unique();
            $table->string('descricao')->unique();
            $table->tinyInteger('em_uso')->nullable();
            $table->integer('fk_estacionamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
