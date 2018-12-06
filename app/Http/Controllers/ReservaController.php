<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Reserva;
use App\Quarto;
use App\Cliente;

class ReservaController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index() {
        $reserva = Reserva::orderBy('created_at', 'id_cliente')->paginate(10);
        return view('reserva.index', ['reserva' => $reserva]);
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
    public function edit($id){
        $reserva = Reserva::findOrFail($id);
        return view('reserva.edicao', compact('reserva'));
    }
    public function update(){
        $reserva = Reserva::findOrFail($id);

        $reserva->id_cliente        = $request->id_cliente;
        $reserva->id_quarto         = $request->id_quarto;
        $reserva->data_entrada      = $request->data_entrada;
        $reserva->data_saida        = $request->data_saida;
        $reserva->status_pgto       = $request->status_pgto;

        $reserva->save();
        return redirect()->route('reserva.index')->with('message', 'Reserva atualizado com sucesso!');
    }
    public function destroy($id){
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();
        return redirect()->route('reserva.index')->with('alert-success', 'Reserva deletado com sucesso!');
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
                    return view('reserva.reservar', [
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
            $date1 = Carbon::createFromFormat('Y-m-d', $request->checkin);
            $date2 = Carbon::createFromFormat('Y-m-d', $request->checkout);
            $dias = $date2->diffInDays($date1);
            //echo $value;
            //exit();
    #-----------------------------------------------------------------------------------#
    if(!$quartos){ // Quarto não informado
        return redirect()
        ->action('ClienteController@form')
        ->with('Er201', 'Er201');
        
    }
    
    if ($a == 0){ // nenhum quarto na data
        $cliente->update($array);
        
            return view('reserva.finalizar', [
                'clientes' => $clientes,
                'quartos' => $quartos,
                'checkin' => $date1,
                'checkout' => $date2,
                'dias' => $dias,
                ]); 
        }else{
            $dia_in = $quarto->data_entrada;
            $dia_out = $quarto->data_saida;
            $res = $dia_out - $dia_in;
            

           if($dia_in<=$date1){
               
                if($dia_out>=$date1){ 
                    //data reservada para o quarto
                        return redirect()
                    ->action('ClienteController@form')
                    ->with('Er201', 'Er201');
                }   
                if($dia_out<$date1){
                    $cliente->update($array);
                    return view('reserva.finalizar', [
                        'clientes' => $clientes,
                        'quartos' => $quartos,
                        'checkin' => $date1,
                        'checkout' => $date2,
                        'dias' => $dias,
                    ]); 
                }
            }else{
                if($dia_in>=$date1){
                    if($dia_out<$date2){
                        return redirect()
                            ->action('ClienteController@form')
                            ->with('Er201', 'Er201');
                    }else{
                        return view('reserva.finalizar', [
                            'clientes' => $clientes,
                            'quartos' => $quartos,
                            'checkin' => $date1,
                            'checkout' => $date2,
                            'dias' => $dias,
                        ]); 
                    }
                }
                
                if($dia_in<=$date12){
                    
                    if($dia_out>=$date12){//data reservada para o quarto
                        return redirect()
                        ->action('ClienteController@form')
                        ->with('Er201', 'Er201');
                    }if($dia_out<$date2){
                        $cliente->update($array);
                        return view('reserva.finalizar', [
                            'clientes' => $clientes,
                            'quartos' => $quartos,
                            'checkin' => $date1,
                            'checkout' => $date2,
                            'dias' => $dias,
                            ]); 
                    }
                }
                $cliente->update($array);
                        return view('reserva.finalizar', [
                            'clientes' => $clientes,
                            'quartos' => $quartos,
                            'checkin' => $date1,
                            'checkout' => $date2,
                            'dias' => $dias,
                            ]); 
            }
        }

    }
}
