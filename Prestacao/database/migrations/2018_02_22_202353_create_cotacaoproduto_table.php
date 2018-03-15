<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotacaoprodutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblcotacaoproduto', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('codCotacao');
			$table->integer('codProduto');
			$table->integer('codMedida');
			$table->integer('qtde');
			$table->double('valorUnit',7,2);
			$table->date('Data_Limite');
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
        Schema::dropIfExists('tblcotacaoproduto');
    }
}
