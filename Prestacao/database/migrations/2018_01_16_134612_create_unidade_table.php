<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblunidade', function (Blueprint $table) {
            $table->increments('id');
			$table->string('eol',8);
			$table->string('nome',100);
			$table->char('inep',11);
			$table->char('cnpj',18);
			$table->char('telefone1',15);
			$table->char('telefone2',15);
			$table->char('fax',15);
			$table->boolean('situacao');
			$table->double('latitude',10,8);
			$table->double('longitude',11,8);
			$table->string('email',100);
			$table->integer('codMantenedor');
			$table->integer('codDre');
			$table->integer('codDiretor');
			$table->integer('codCoordenador');
			$table->integer('codEndereco');
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
        Schema::dropIfExists('tblunidade');
    }
}
