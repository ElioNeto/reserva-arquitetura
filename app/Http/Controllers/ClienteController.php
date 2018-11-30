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
        return view('clientes_index', ['clientes' => $clientes]);
    }
    public function create(){
        return view('clientes.create');
    }
    public function store(ClienteRequest $request){
        $cliente = new Cliente;

        $cliente->nome                  =$request->nome;
        $cliente->endereco              =$request->endereco;
        $cliente->cpf                   =$request->cpf;
        $cliente->data_cadastro         =$request->data_cadastro;
        $cliente->data_cancelamento     =$request->data_cancelamento;
        $cliente->debito                =$request->debito;

        $cliente->save();
        return redirect()->route('clientes.index')->with('message', 'Cliente cadastrado com sucesso!');
    }
    public function show($id){
        //
    }
    public function edit($id){
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('clientes'));
    }
    public function update(){
        $cliente = Cliente::findOrFail($id);

        $cliente->nome                  =$request->nome;
        $cliente->endereco              =$request->endereco;
        $cliente->cpf                   =$request->cpf;
        $cliente->data_cadastro         =$request->data_cadastro;
        $cliente->data_cancelamento     =$request->data_cancelamento;
        $cliente->debito                =$request->debito;

        $cliente->save();
        return redirect()->route('clientes.index')->with('message', 'Cliente atualizado com sucesso!');
    }
    public function destroy($id){
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('alert-success', 'Cliente deletado com sucesso!');
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
            return view('cliente_select', [
                'clientes'  =>      $cliente,
                'nome'      =>      $request->nome,
                'Er201'     =>      $Er201,
            ]);
        }
    }
    public function form(){
        return view('cliente_busca');
    }
    public function teste(Request $request){
        var_dump($request->id);
    }
}
