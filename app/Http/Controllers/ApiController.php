<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cliente;
class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $api = Cliente::all();
        return response()                   ->json($api);
       // return view('api', ['api' => $api]);
    }
    public function show($id){
        $api = Cliente::find($id);
        if(!$api){
            return response()               ->json([
                'message'                   =>'Nada encontrado', 
            ], 404);
        }
        return response()                   ->json($api);
    }
    public function store(Request $request){
        $api = new Cliente();
        $api        ->fill($request         ->all());
        $api        ->save();
        return response()                   ->json($api, 201);
    }
    public function update(Request $request, $id){
        $api = Cliente::find($id);
        if(!$api){
            return response()               ->json([
                'message'                   =>'Nada encontrado',
            ],404);
        }
        $api        ->fill($request         ->all());
        $api        -save();
        return response()                   ->json($api);
    }
    public function destroy($id){
        $api = Cliente::find($id);
        if(!$api){
            return response()->json([
                'message' => 'Nada encontrado',
            ],404);
        }
        $api->delete();
    }
    public function json_manipulate(Request $re){
        //Read file
        $jsonString     = file_get_contents(base_path('app/Http/Controllers/json/clientes.json'));
        $data           = json_decode($jsonString);
        ////////////////////////////////////////////////////////////////////////////////////////

        //Tamanho do banco e arquivo
        $i = 0;
        $j = 0;
        foreach ($data as $key => $value){
            $i++;
        }
        echo $i;
        echo '<br>';
        $b = Cliente::all();
        foreach ($b as $key => $value){
            $j++;
        }
        echo $j;
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
                        $create = $request->created_at;
                        echo $create;
                        $deb = $value->debito;
                        $array = [
                            'nome' => $nome, 
                            'endereco' => $ender, 
                            'cpf' => $ccpf, 
                            'data_cadastro' => $create, 
                            'data_cancelamento' => $del, 
                            'created_at' => $create, 
                            'debito' => $deb,
                        ];
                        var_dump($array);
                        $task->update($array);
                    }
                    ///////////////////////////////////////////////////////////////////////////
                    
                    //Cliente novo - Import
                    else{
                        echo '<br>';
                        echo $a;
                        echo '<br>';
                        echo $j;
                        echo '<br>';
                        var_dump($value);
                        if($a == $j){
                            $cliente = new Cliente();
                            $cliente->nome                  =$value->nome;
                            $cliente->endereco              =$value->endereco;
                            $cliente->cpf                   =$value->cpf;
                            $cliente->data_cadastro         =$value->data_cadastro;
                            $cliente->data_cancelamento     =$value->data_cancelamento;
                            $cliente->debito                =$value->debito;
                            $cliente->save();
                        }
                    ///////////////////////////////////////////////////////////////////////
                    }

                    $a++;
                }
                echo '<hr>';
            }
        }     
        $st= 'Import realizado com sucesso!';
        return redirect()
            ->action('ClienteController@index')
            ->with('msg', $st);
    }
}