<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotafiscalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblnotafiscal', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('numero');
			$table->integer('emissao');
			$table->integer('Descontos');
			$table->integer('Total');
			$table->integer('Gasto');
			$table->integer('codStatus');
			$table->integer('codFornecedor');
			$table->integer('codLanca');
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
        Schema::dropIfExists('tblnotafiscal');
    }
}
