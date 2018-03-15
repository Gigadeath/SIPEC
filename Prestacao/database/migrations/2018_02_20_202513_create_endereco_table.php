<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblendereco', function (Blueprint $table) {
            $table->increments('id');
			$table->char('cep',9);
			$table->string('rua',255);
			$table->string('bairro',255);
			$table->string('cidade',100);
			$table->char('estado',2);
			$table->char('ibge',7);
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
        Schema::dropIfExists('tblendereco');
    }
}
