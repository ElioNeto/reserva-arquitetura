<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Quarto;

class QuartoController extends Controller
{
    public function index() {
        $quartos = Quarto::orderBy('status')->paginate(10);
        return view('quarto_index', ['quartos' => $quartos]);;
    }
    public function create(){
        $quartos = Quarto::orderBy('status')->paginate(10);
        return view('quarto_cadastro');
    }
    public function store(Request $request){
        $quarto = new quarto;

        $quarto->descricao             =$request->descricao;
        $quarto->valor                 =$request->valor;
        
        $quarto->save();
        return redirect()
            ->action('QuartoController@index')
            ->with('message', 'Quarto cadastrado com sucesso!');
    }
    public function show($id){
        //
    }
    public function edit($id){
        $quarto = Quarto::findOrFail($id);
        return view('quartos.edit', compact('quarto'));
    }
    public function update(){
        $quarto = quarto::findOrFail($id);

        $quarto->descricao             =$request->descricao;
        $quarto->valor                 =$request->valor;

        $quarto->save();
        return redirect()->route('quartos.index')->with('message', 'Quarto atualizado com sucesso!');
    }
    public function destroy($id){
        $quarto = quarto::findOrFail($id);
        $quarto->delete();
        return redirect()->route('quartos.index')->with('alert-success', 'quarto deletado com sucesso!');
    }
    public function define_status($id){
        $quarto = quarto::findOrFail($id);

        $quarto->status             =$request->status;

        $quarto->save();
        return redirect()
            ->action('QuartoController@index')
            ->with('message', 'Quarto atualizado com sucesso!');
    }
}
