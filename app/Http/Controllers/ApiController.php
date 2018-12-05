<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Sandbox;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;
use Carbon\Carbon;
use App\Cliente;
use App\Reserva;
use App\Quarto;

class ApiController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function json_manipulate(Request $re){
        //Read file
        $jsonString     = file_get_contents(base_path('app/Http/Controllers/api/clientes.json'));
        $data           = json_decode($jsonString);
        ////////////////////////////////////////////////////////////////////////////////////////
        echo 'Importando dados ...';
        echo'<br>Voce será redirecionado para a pagina inicial ao terminar o processo.';
        //Tamanho do banco e arquivo
        $i = 0; // tamanho do arquivo json
        $j = 0; // número de usuários no banco reserva - tabela clientes
        foreach ($data as $key => $value){
            $i++;
        }
        $b = Cliente::all();
        foreach ($b as $key => $value){
            $j++;
        }
        //////////////////////////////////////////////////////////////////////////////////////

        foreach ($data as $key => $value){
            $cpf = $value->cpf;
            $a = 1;

            //se o banco estiver vazio
            if( $j == 0){
                $cliente = new Cliente();
                $cliente->nome                  =$value->nome;
                $cliente->endereco              =$value->endereco;
                $cliente->cpf                   =$value->cpf;
                $cliente->data_cadastro         =$value->data_cadastro;
                $cliente->data_cancelamento     =$value->data_cancelamento;
                $cliente->debito                =$value->debito;
                $cliente->update                =$update = date("Y-m-d");
                $cliente->save();
            }
            ////////////////////////////////////////////////////////////////////

            //update de cliente
            else{
                foreach ($b as $key => $request){
                    $ccpf = $request->cpf;
                    $id = $request->id;
                
                    if($ccpf == $cpf){
                        $a = 0;
                        $task = Cliente::find($id);
                        $nome = $value->nome;
                        $ender = $value->endereco;
                        $del = $request->deleted_at;
                        if(!$del){
                            $del = $value->data_cancelamento;
                        }
                        $create = $request->created_at;
                        $deb = $value->debito;
                        $update = date("Y-m-d");
                        $array = [
                            'nome' => $nome, 
                            'endereco' => $ender, 
                            'cpf' => $ccpf, 
                            'data_cadastro' => $create, 
                            'data_cancelamento' => $del, 
                            'created_at' => $create, 
                            'debito' => $deb,
                            'update' => $update,
                        ];
                        $task->update($array);
                    }
                    ///////////////////////////////////////////////////////////////////////////
                    
                    else{

                        //Cliente novo - Import
                        if($a == $j){
                            $cliente = new Cliente();
                            $cliente->nome                  =$value->nome;
                            $cliente->endereco              =$value->endereco;
                            $cliente->cpf                   =$value->cpf;
                            $cliente->data_cadastro         =$value->data_cadastro;
                            $cliente->data_cancelamento     =$value->data_cancelamento;
                            $cliente->debito                =$value->debito;
                            $cliente->update                =$update = date("Y-m-d");
                            $cliente->save();
                        }
                    ///////////////////////////////////////////////////////////////////////
                    }
                    $a++;
                }
            }
        }     
        //$st= 'COD: AD102  Dados dos clientes atualizados com sucesso!';
        return redirect()
            ->action('ClienteController@index')
            ->with('msg', ' ');
    }

    public function busca(){
        return view('api.busca');
    }

    public function select(Request $request){
        $i=0;
        $cliente = Cliente::where([
            ['nome', 'LIKE', '%'.$request->nome.'%'],
            ['debito', '<>', 0] 
        ])->get();
        foreach($cliente as $key=>$value){
            $i++;
        }
        if($i==0){
            return redirect()
            ->action('ApiController@busca')
            ->with('Er404', 'Er404');//cliente não encontrado
        }else{
            $Er201 = 0;
            return view('api.select', [
                'clientes'  =>      $cliente,
                'nome'      =>      $request->nome,
                'Er201'     =>      $Er201,
            ]);
        }
    }

    public function checkout (Request $request){
        $id = $request->id;
        //echo $id;
        $res = Reserva::where([
            ['id_cliente', $id],
            ['status_pgto', '<>', 0]
        ])->get();

        $reserva = new Reserva();
        foreach ($res as $key => $value) {
            $reserva->id = $value->id;
            $reserva->id_quarto = $value->id_quarto;
            $reserva->id_cliente = $value->id_cliente;
            $date1 = Carbon::createFromFormat('Y-m-d H:i:s', $value->data_entrada);
            $date2 = Carbon::createFromFormat('Y-m-d H:i:s', $value->data_saida);
            $dias = $date2->diffInDays($date1);
        }  
        $id_q = $reserva->id_quarto;
        $cliente = Cliente::find($id);
        $quarto = Quarto::find($id_q);

        return view('api.confirmacao', [
            'cliente'       =>      $cliente,
            'reserva'       =>      $reserva,
            'quarto'        =>      $quarto,
            'dias'          =>      $dias,
        ]);

    }
}