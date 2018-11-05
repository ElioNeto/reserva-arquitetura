<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table){
            $table->increments('id');
            $table->string('nome');
            $table->string('endereco');
            $table->string('cpf');
            $table->string('data_cadastro');//manual
            $table->string('data_cancelamento');//manual
            $table->string('debito');//flag
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
        Schema::drop('usuario');
    }
}
