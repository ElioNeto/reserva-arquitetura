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
            ->with('D301', 'D301');
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
       
        $id = $request->id;
        if (!$id){
            return redirect()
            ->action('ClienteController@form')
            ->with('Er404', 'Er404');//cliente não encontrado
        }else{
            $update = date("Y-m-d");
            $quartos = Quarto::all();
            $cliente = Cliente::find($id);
            $data = $cliente->update;
            $ender = $cliente->endereco;
            //***************** erros ***************************
            if($update>$data){
                return redirect()
                ->action('ClienteController@form')
                ->with('Er400', 'Er400');//cliente desatualizado
            }else{
                if(!$ender){
                    return redirect()
                    ->action('ClienteController@form')
                    ->with('Er101', 'Er101');//endereço vazio
                }else{
                    return view('reservar', [
                        'clientes' => $id,
                        'quartos' => $quartos
                    ]);
                }
            }
        }
        
    }

    public function pacote(Request $request){
        $quartos       = $request->quarto;
        $clientes      = $request->cliente;

        $a = 0;

        $cliente = Cliente::find($clientes);
        $quarto = Reserva::where('id_quarto', $quartos)->get();
        $q = Quarto::all();

        foreach ($quarto as $key => $quarto){
            $a++;
        }
        
            $array = [
                'debito' => '1',
            ];
            #- Contagem de dias -#
            $Texto =  $request->checkin;
            $Texto2 = $request->checkout;
            $I = 0;
            $Array = 0;
            for ($X = 0; $X < strlen($Texto); $X++) {
                if($Texto[$I] == '-'){
                    $Texto[$X] = 0;
                    $I++;
                }else{
                    $Texto[$X] = $Texto[$I];
                    $I++;
                }
            }
            $I = 0;
            
            for ($X = 0; $X < strlen($Texto2); $X++) {
                if($Texto2[$I] == '-'){
                    $Texto2[$X] = 0;
                    $I++;
                }else{
                    $Texto2[$X] = $Texto2[$I];
                    $I++;
                }
            }
            $n3 = $Texto2 - $Texto;
    #-----------------------------------------------------------------------------------#
    if(!$quartos){ // Quarto não informado
        return redirect()
        ->action('ClienteController@form')
        ->with('Er201', 'Er201');
        
    }
    
    if ($a == 0){ // nenhum quarto na data
        $cliente->update($array);
        
            return view('finalizar', [
                'clientes' => $clientes,
                'quartos' => $quartos,
                'checkin' => $Texto,
                'checkout' => $Texto2,
                'dias' => $n3,
                ]); 
        }else{
            $dia_in = $quarto->data_entrada;
            $dia_out = $quarto->data_saida;
            $res = $dia_out - $dia_in;
            

           if($dia_in<=$Texto){
               
                if($dia_out>=$Texto){ 
                    //data reservada para o quarto
                        return redirect()
                    ->action('ClienteController@form')
                    ->with('Er201', 'Er201');
                }   
                if($dia_out<$Texto){
                    $cliente->update($array);
                    return view('finalizar', [
                        'clientes' => $clientes,
                        'quartos' => $quartos,
                        'checkin' => $Texto,
                        'checkout' => $Texto2,
                        'dias' => $n3,
                    ]); 
                }
            }else{
                if($dia_in>=$Texto){
                    if($dia_out<$Texto2){
                        return redirect()
                            ->action('ClienteController@form')
                            ->with('Er201', 'Er201');
                    }else{
                        return view('finalizar', [
                            'clientes' => $clientes,
                            'quartos' => $quartos,
                            'checkin' => $Texto,
                            'checkout' => $Texto2,
                            'dias' => $n3,
                        ]); 
                    }
                }
                
                if($dia_in<=$Texto2){
                    
                    if($dia_out>=$Texto2){//data reservada para o quarto
                        return redirect()
                        ->action('ClienteController@form')
                        ->with('Er201', 'Er201');
                    }if($dia_out<$Texto2){
                        $cliente->update($array);
                        return view('finalizar', [
                            'clientes' => $clientes,
                            'quartos' => $quartos,
                            'checkin' => $Texto,
                            'checkout' => $Texto2,
                            'dias' => $n3,
                            ]); 
                    }
                }
                $cliente->update($array);
                        return view('finalizar', [
                            'clientes' => $clientes,
                            'quartos' => $quartos,
                            'checkin' => $Texto,
                            'checkout' => $Texto2,
                            'dias' => $n3,
                            ]); 
            }
        }

    }
         
   // public function quarto
    public function teste(Request $request){
        var_dump($request->id);
        echo $request->id;
    }
}
