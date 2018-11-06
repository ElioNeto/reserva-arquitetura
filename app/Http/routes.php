<?php
Route::auth();

Route::get('/home', 'HomeController@index');

/*** GROUPS ***/
Route::group(array('prefix'=>'Cliente'), function(){
    Route::get('lista', 'ClienteController@index');
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