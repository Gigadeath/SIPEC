<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblmantenedor', function (Blueprint $table) {
            $table->increments('id');
			$table->char('cnpj',18)->unique()->nullable();
			$table->string('nome',100)->unique()->nullable();
			$table->char('telefone',15)->unique()->nullable();
			$table->string('email',100)->unique()->nullable();
			$table->integer('codEndereco')->unique()->nullable();
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
        Schema::dropIfExists('tblmantenedor');
    }
}
