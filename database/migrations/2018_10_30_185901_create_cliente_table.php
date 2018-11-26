<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table){
            $table->increments('id');
            $table->string('nome');
            $table->string('endereco');
            $table->string('cpf');
            $table->string('data_cadastro');//manual
            $table->string('data_cancelamento');//manual
            $table->string('debito');//flag
            $table->string('update');
            $table->timestamps();//funcao de guardar datas de modificacoes no banco
            $table->softDeletes();//funcao de alterar status de ativo e inativo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cliente');
    }
}
