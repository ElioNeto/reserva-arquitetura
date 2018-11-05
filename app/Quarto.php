<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    protected $fillable = ['status', 'descricao', 'valor'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    //protected $table = 'Quarto';
    public function quarto(){
        $this->belongsTo('App\Reserva');
    }
}
