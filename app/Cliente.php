<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome', 
        'endereco', 
        'cpf', 
        'data_cadastro', 
        'data_cancelamento', 
        'debito'
    ];
    protected $guarded = [
        'id', 
        'created_at', 
        'update_at'
    ];
    protected $table = 'usuario';
}
