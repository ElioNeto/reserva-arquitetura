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
        'deleted_at',
        'update_at',
        'id'
    ];
    protected $table = 'cliente';
   /* public function cliente(){
        return $this->hasMany('App\Reserva');
    }*/
}
