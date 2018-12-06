<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

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
        $jsonString     = file_get_contents(base_path('app/Http/Controllers/api/integração/clientes.json'));
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
                if ($value->debito == 'N/A'){
                    $value->debito = 0;
                }
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
                        $nome = $value->name;
                        $ender = $value->endereco;
                        $del = $request->deleted_at;
                        if(!$del){
                            $del = $value->data_cancelamento;
                        }
                        $create = $request->created_at;
                        if ($value->debito == 'N/A'){
                            $value->debito = 0;
                        }
                        $deb = $value->debito;
                        $update = date("Y-m-d");
                        $array = [
                            'name' => $nome, 
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
                            $cliente->nome                  =$value->name;
                            $cliente->endereco              =$value->endereco;
                            $cliente->cpf                   =$value->cpf;
                            $cliente->data_cadastro         =$value->data_cadastro;
                            $cliente->data_cancelamento     =$value->data_cancelamento;
                            if ($value->debito == 'N/A'){
                                $value->debit0 = 0;
                            }
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
        $dias = 0;
        //echo $id;
        $res = Reserva::where([
            ['id_cliente', $id],
            ['status_pgto', '<>', 'pago']
        ])->get();
            //echo ($res);
            //exit;
            if(!$res){
                return view('api.busca', [
                    'Er202'     =>      'Reserva não encontrada!',
                ]);
            }

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

        if($dias == 0){
            return redirect()
            ->action('ApiController@busca')
            ->with('Er202', 'Er202');
        }

        return view('api.confirmacao', [
            'cliente'       =>      $cliente,
            'reserva'       =>      $reserva,
            'quarto'        =>      $quarto,
            'dias'          =>      $dias,
        ]);

    }

    public function pagseguro(Request $request){
        $token = $request->token;
        $email = $request->email;
        $currency = $request->currency;
        $itemId = $request->itemid;
        $itemQuantity = $request->qtd;
        $itemDescription = $request->descricao;
        $itemAmount = $request->valor . '.00';
        $id = $request->id;
        
        $data['token'] =   'FA5AD922C90243D3B03FAC6602798DC3';
        $data['email'] = $email;
        $data['currency'] = $currency;
        $data['itemId1'] = $itemId;
        $data['itemQuantity1'] = $itemQuantity;
        $data['itemDescription1'] = $itemDescription;
        $data['itemAmount1'] = $itemAmount;

        $charset = 'ISO-8859-1';

        $url = 'https://ws.pagseguro.uol.com.br/v2/checkout';

        $data = http_build_query($data);
       // echo $data;
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $xml= curl_exec($curl);

        curl_close($curl);
        //echo $xml;
       // exit;
        $xml= simplexml_load_string($xml);
        echo $xml -> code;
        $code = $xml->code;
       // exit;
        $url2 = 'https://pagseguro.uol.com.br/checkout/v2/payment.html?code=' . $code;
        
        $task = Cliente::find($id);
        foreach ($task as $key => $value) {
            $array = [ 
                'debito' => 0,
            ];
        }
        $task->update($array);

        $task = Reserva::find($itemId);
        foreach ($task as $key => $value) {
            $array = [ 
                'status_pgto' => 'pago',
            ];
        }
        $task->update($array);



        return redirect()->away($url2);

    }
}