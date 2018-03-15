<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLancamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbllancamento', function (Blueprint $table) {
            $table->increments('id');
			$table->date('Inicio');
			$table->date('Fim');
			$table->double('Total',7,2);
			$table->double('Repasse',7,2);
			$table->double('Saldo',7,2);
			$table->integer('codUnid');
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
        Schema::dropIfExists('tbllancamento');
    }
}
