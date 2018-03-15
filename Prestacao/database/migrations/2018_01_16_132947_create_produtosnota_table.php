<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosnotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblprodutosnota', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('codNota');
			$table->integer('codProduto');
			$table->integer('codMedida');
			$table->integer('qtde');
			$table->double('valorUnit',7,2);
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
        Schema::dropIfExists('tblprodutosnota');
    }
}
