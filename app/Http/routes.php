<?php
Route::auth();

Route::get('/home', 'HomeController@index');

/*** GROUPS ***/

#--- Cliente ---#
Route::group(array('prefix'=>'Cliente'), function(){
    Route::get('lista', 'ClienteController@index');
    Route::get('form', 'ClienteController@form');
    Route::post('busca', 'ClienteController@busca');
    Route::post('test', 'ClienteController@teste');
});

#--- apiCliente ---#
Route::group(array('prefix' => 'apiCliente'), function(){
    Route::resource('api', 'ApiController');
    Route::get('test', 'ApiController@json_manipulate');
    Route::get('busca', 'ApiController@busca');
    Route::post('select','ApiController@select');
    Route::post('checkout','ApiController@checkout');

});

#--- Reserva ---#
Route::group(array('prefix'=>'Reserva'), function(){
    Route::get('index', 'ReservaController@index');
    Route::post('quarto', 'ReservaController@reservar');
    Route::post('test', 'ReservaController@teste');
    Route::post('pacote', 'ReservaController@pacote');
    Route::post('salvar', 'ReservaController@store');
});

#--- Quarto ---#
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