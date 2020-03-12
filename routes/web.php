<?php

Route::view('/', 'auth.login');
Auth::routes(['register' => false]);

Route::view('index', 'index')->name('index');

/* CLIENTES */
Route::view('clientes', 'clientes')->name('clientes');
Route::get('getClientes', 'ClienteController@index')->name('getClientes');
Route::get('findCliente/{data}', 'ClienteController@show')->name('findCliente');
Route::post('setCliente', 'ClienteController@store')->name('setCliente');
Route::delete('delCliente/{id}', 'ClienteController@destroy')->name('delCliente');
Route::patch('updCliente/{id}', 'ClienteController@update')->name('updCliente');

/* TRABAJADORES */
Route::view('trabajadores', 'trabajadores')->name('trabajadores');
Route::get('getTrabajadores', 'TrabajadorController@index')->name('getTrabajadores');
Route::get('findTrabajador/{data}', 'TrabajadorController@show')->name('findTrabajador');
Route::get('getSucursales', 'TrabajadorController@getSucursales')->name('getSucursales');
Route::get('getUsuarios', 'TrabajadorController@getUsuarios')->name('getUsuarios');
Route::post('setTrabajador', 'TrabajadorController@store')->name('setTrabajador');
Route::delete('delTrabajador/{id}', 'TrabajadorController@destroy')->name('delTrabajador');
Route::patch('updTrabajador/{id}', 'TrabajadorController@update')->name('updTrabajador');

/* PROVEEDORES */
Route::view('proveedores', 'proveedores')->name('proveedores');
Route::get('getProveedores', 'ProveedorController@index')->name('getProveedores');
Route::post('setProveedor', 'ProveedorController@store')->name('setProveedor');
Route::delete('delProveedor/{id}', 'ProveedorController@destroy')->name('delProveedor');
Route::patch('updProveedor/{id}', 'ProveedorController@update')->name('updProveedor');
Route::get('findProveedor/{data}', 'ProveedorController@show')->name('findProveedor');

/* CONTROL SUCURSAL*/
Route::view('controlSucursal', 'controlSucursal')->name('controlSucursal');