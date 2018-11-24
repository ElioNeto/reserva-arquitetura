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
    public function json_manipulate(Request $request){
        //Read file
        $jsonString     = file_get_contents(base_path('app/Http/Controllers/json/clientes.json'));
        $data           = json_decode($jsonString);

        //echo $data->{'nome'};
        var_dump($data);
        //$st = new \StdClass();

        foreach ($data as $key => $value) {
            //echo $value->nome;
            $nome = $value->nome;
            echo $nome;
            $cpf = $value->cpf;
            echo $cpf;

            $request->nome                  =$value->nome;
            $request->endereco              =$value->endereco;
            $request->cpf                   =$value->cpf;
            $request->data_cadastro         =$value->data_cadastro;
            $request->data_cancelamento     =$value->data_cancelamento;
            $request->debito                =$value->debito;

            $cliente = new Cliente();
           $api = Cliente::all();
            foreach($api as $key => $dados){
                $teste = $dados->cpf;
                echo $teste;

                if ($cpf == $teste){
                    echo '<br>estou aqui<br>';
                    $create = $dados->created_at;
                    echo"<br>".$create."<br>";
                    $id = $dados->id;
                    echo $id;
                    $search = Cliente::find($id);
                    $search->delete();
                }
                echo '<br><hr>';
            }

            $cliente->nome                  =$request->nome;
            $cliente->endereco              =$request->endereco;
            $cliente->cpf                   =$request->cpf;
            $cliente->data_cadastro         =$request->data_cadastro;
            $cliente->data_cancelamento     =$request->data_cancelamento;
            $cliente->debito                =$request->debito;
            $cliente->save();
            $id = $cliente->id;
            echo '<br>'.$id.'<br>';
        }
       //$st->status = true;
        $st= 'Import realizado com sucesso!';
        return redirect()
          ->action('ClienteController@index')
          ->with('msg', $st);
    }
}
