<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Quarto;

class QuartoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index() {
        $quartos = Quarto::orderBy('status')->paginate(10);
        return view('quarto.index', ['quartos' => $quartos]);;
    }
    public function create(){
        $quartos = Quarto::orderBy('status')->paginate(10);
        return view('quarto.cadastro');
    }
    public function store(Request $request){
        $quarto = new quarto;

        $quarto->descricao             =$request->descricao;
        $quarto->valor                 =$request->valor;
        $quarto->status                =0;
        
        $quarto->save();
        return redirect()
            ->action('QuartoController@index')
            ->with('message', 'Quarto cadastrado com sucesso!');
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
