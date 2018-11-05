<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class QuartoController extends Controller
{
    public function index() {
        $quartos = Quarto::orderBy('created_at', 'descricao')->paginate(10);
        return view('quartos.index', ['quartos' => $quartos]);
    }
    public function create(){
        return view('quartos.create');
    }
    public function store(QuartoRequest $request){
        $quarto = new quarto;

        $quarto->descricao             =$request->descricao;
        $quarto->valor                 =$request->valor;
        
        $quarto->save();
        return redirect()->route('quartos.index')->with('message', 'Quarto cadastrado com sucesso!');
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
}
