<?php
Route::auth();

Route::get('/home', 'HomeController@index');

/*** GROUPS ***/
Route::group(array('prefix'=>'Cliente'), function(){
    Route::get('lista', 'ClienteController@index');
    Route::post('busca', 'ClienteController@busca');
    Route::get('form', 'ClienteController@form');
    Route::post('test', 'ClienteController@teste');
});
Route::group(array('prefix' => 'apiCliente'), function(){
    Route::get('/', function(){
        return response()->json([
            'message'   =>  'Cliente API',
            'status'    =>  'Conectado'
        ]);;
    });
    Route::get('test', 'ApiController@json_manipulate');
    Route::resource('api', 'ApiController');
});
Route::group(array('prefix'=>'Reserva'), function(){
    Route::get('index', 'ReservaController@index');
    //Route::get('reservar', 'ReservaController@reservar');
    Route::post('quarto', 'ReservaController@reservar');
    Route::post('test', 'ReservaController@teste');
    Route::post('pacote', 'ReservaController@pacote');
    Route::post('salvar', 'ReservaController@store');
});
Route::group(array('prefix'=>'Quarto'), function(){
    Route::get('cadastro', 'QuartoController@create');
    Route::get('index', 'QuartoController@index');
    Route::post('salvar', 'QuartoController@store');
});

/*** REDIRECTS ***/
Route::get('/', function(){
    return redirect('/Cliente');
});
Route::get('Cliente', function(){
    return redirect('/Cliente/lista');
});
Route::get('Quarto', function(){
    return redirect('/Quarto/index');
});
Route::get('/home', function(){
    return redirect('/Cliente');
});