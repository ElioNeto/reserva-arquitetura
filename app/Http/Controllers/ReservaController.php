<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Reserva;
use App\Quarto;
use App\Cliente;

class ReservaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $reserva = Reserva::orderBy('created_at', 'id_cliente')->paginate(10);
        return view('reserva_index', ['reserva' => $reserva]);
    }
    public function create(){
        return view('reserva.create');
    }
    public function store(Request $request){
        $reserva = new Reserva;

        //retorno do formulário estático
        $reserva->id_cliente        = $request->cliente;
        $reserva->id_quarto         = $request->quarto;

        //último formulário
        $reserva->data_entrada      = $request->checkin;
        $reserva->data_saida        = $request->checkout;
        $reserva->status_pgto       = 1;
        
        $reserva->save();
        
        return redirect()
            ->action('ClienteController@index')
            ->with('msg', 'Reserva efetuada com sucesso!');
    }
    public function show($id){
        //
    }
    public function edit($id){
        $reserva = Reserva::findOrFail($id);
        return view('reserva_edicao', compact('reserva'));
    }
    public function update(){
        $reserva = Reserva::findOrFail($id);

        $reserva->id_cliente        = $request->id_cliente;
        $reserva->id_quarto         = $request->id_quarto;
        $reserva->data_entrada      = $request->data_entrada;
        $reserva->data_saida        = $request->data_saida;
        $reserva->status_pgto       = $request->status_pgto;

        $reserva->save();
        return redirect()->route('reserva_index')->with('message', 'Reserva atualizado com sucesso!');
    }
    public function destroy($id){
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();
        return redirect()->route('reserva_index')->with('alert-success', 'Reserva deletado com sucesso!');
    }

    public function reservar(Request $request){
       // $clientes = Cliente::all();
        //echo $clientes;
        $quartos = Quarto::all();
        //echo $quartos;
        //return response()->json($clientes);
        $clientes = $request->id;
        if (!$clientes){
            return redirect()
            ->action('ClienteController@form')
            ->with('msg', 'Cliente não encontrado para reserva, tente novamente!');
        }else{
            return view('reservar', [
                'clientes' => $clientes,
                'quartos' => $quartos
            ]);
        }
        
    }

    public function finalizar(Request $request){
         $quartos       = $request->quarto;
         $clientes      = $request->cliente;

         return view('finalizar', [
             'clientes' => $clientes,
             'quartos' => $quartos
             ]);
     }
   // public function quarto
    public function teste(Request $request){
        var_dump($request->id);
        echo $request->id;
    }
}
