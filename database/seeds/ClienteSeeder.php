<?php

use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Cliente::create([
            'nome'              =>str_random(10),
            'endereco'          =>str_random(10),
            'cpf'               =>str_random(10),
            'data_cadastro'     =>str_random(10),
            'data_cancelamento' =>str_random(10),
            'debito'            =>str_random(10),
        ]);
    }
}
