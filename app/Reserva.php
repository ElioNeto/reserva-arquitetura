<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'id_cliente', 
        'id_quarto', 
        'data_entrada', 
        'data_saida', 
        'status_pgto'
    ];
    protected $guarded = [
        'id', 
        'created_at', 
        'update_at'
    ];
    //protected $table = 'reserva';
    public function reserva(){
        return $this->belongsTo('App\Cliente');
        return $this->hasMany('App\Quarto');
    }
}
