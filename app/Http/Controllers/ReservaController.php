<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ReservaController extends Controller
{
    public function index() {
        $reservas = Reserva::orderBy('created_at', 'id_cliente')->paginate(10);
        return view('reservas.index', ['reservas' => $reservas]);
    }
    public function create(){
        return view('reservas.create');
    }
    public function reserva(ReservaRequest $request){
        $reserva = new Reserva;

        $reserva->id_cliente        = $request->id_cliente;
        $reserva->id_quarto         = $request->id_quarto;
        $reserva->data_entrada      = $request->data_entrada;
        $reserva->data_saida        = $request->data_saida;
        $reserva->status_pgto       = $request->status_pgto;
        
        $reserva->save();
        return redirect()->route('reservas.index')->with('message', 'Reserva cadastrado com sucesso!');
    }
    public function show($id){
        //
    }
    public function edit($id){
        $reserva = Reserva::findOrFail($id);
        return view('reservas.edit', compact('reserva'));
    }
    public function update(){
        $reserva = Reserva::findOrFail($id);

        $reserva->id_cliente        = $request->id_cliente;
        $reserva->id_quarto         = $request->id_quarto;
        $reserva->data_entrada      = $request->data_entrada;
        $reserva->data_saida        = $request->data_saida;
        $reserva->status_pgto       = $request->status_pgto;

        $reserva->save();
        return redirect()->route('reservas.index')->with('message', 'Reserva atualizado com sucesso!');
    }
    public function destroy($id){
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();
        return redirect()->route('reservas.index')->with('alert-success', 'Reserva deletado com sucesso!');
    }
}
