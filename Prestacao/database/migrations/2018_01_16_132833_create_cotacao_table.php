<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblcotacao', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('codFornecedor');
			$table->date('data');
			$table->double('Total_Repasse');
			$table->double('Gasto');
			$table->double('Desconto');
			
			
			
			
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
        Schema::dropIfExists('tblcotacao');
    }
}
