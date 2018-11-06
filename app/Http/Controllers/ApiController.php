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
    public function json_manipulate(){
        //Read file
        $jsonString     = file_get_contents(base_path('app/Http/Controllers/json/clientes.json'));
        $data           = json_decode($jsonString);

        //echo $data->{'nome'};
        var_dump($data);

        foreach ($data as $key => $value) {
            //echo $value->nome;
            $nome = $value->nome;
            echo $nome;
        }
    }
}
