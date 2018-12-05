<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cliente;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $clientes = Cliente::orderBy('id')->paginate(10);
        return view('cliente.index', ['clientes' => $clientes]);
    }
    public function busca(Request $request){
        $i=0;
        $cliente = Cliente::where('nome', 'LIKE', '%'.$request->nome.'%')->get();
        foreach($cliente as $key=>$value){
            $i++;
        }
        if($i==0){
            return redirect()
            ->action('ClienteController@form')
            ->with('Er404', 'Er404');//cliente não encontrado
        }else{
            $Er201 = 0;
            return view('cliente.select', [
                'clientes'  =>      $cliente,
                'nome'      =>      $request->nome,
                'Er201'     =>      $Er201,
            ]);
        }
    }
    public function form(){
        return view('cliente.busca');
    }
    public function teste(Request $request){
        var_dump($request->id);
    }
}
