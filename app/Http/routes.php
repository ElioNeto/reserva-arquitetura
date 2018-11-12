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
});
Route::group(array('prefix'=>'Quarto'), function(){
    Route::get('busca', 'QuartoController@index');
    Route::post('busca', 'QuartoController@index');
});

/*** REDIRECTS ***/
Route::get('/', function(){
    return redirect('/Cliente');
});
Route::get('Cliente', function(){
    return redirect('/Cliente/lista');
});
Route::get('/home', function(){
    return redirect('/Cliente');
});