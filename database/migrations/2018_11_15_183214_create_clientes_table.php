<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('CODCLIENTE');
            $table->string('DES_NOME',50);
            $table->string('TIPO',1);
            $table->string('CPF_CNPJ',20);
            $table->date('DT_NASCIMENTO');
            $table->string('DES_RAZAO',50);
            $table->string('CTT_FONE',15);
            $table->string('CTT_CELULAR',15);
            $table->string('CTT_EMAIL',25);
            $table->string('CEP',8);
            $table->string('ESTADO',2);
            $table->string('CIDADE',50);
            $table->string('END_BAIRRO',30);
            $table->string('END_LOGRADOURO',50);
            $table->string('NUMERO',4);
            $table->string('REF',50);
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
        Schema::dropIfExists('clientes');
    }
}
