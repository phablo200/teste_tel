<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'AutenticarController@entrar')->name('entrar');
Route::get('/entrar', 'AutenticarController@entrar')->name('entrar');
Route::post('/autenticar', 'AutenticarController@autenticar')->name('autenticar');
Route::get('/sair', 'AutenticarController@sair')->name('sair');

Route::get('admin/', 'AutenticarController@admin')->name('admin');

Route::get('/usuario', 'UsuarioController@index')->name('usuario.index');
Route::get('/usuario/criar', 'UsuarioController@criar')->name('usuario.criar');
Route::post('/usuario/salvar', 'UsuarioController@salvar')->name('usuario.salvar');
Route::get('/usuario/editar/{id}', 'UsuarioController@editar')->name('usuario.editar');
Route::post('/usuario/atualizar/{id}', 'UsuarioController@atualizar')->name('usuario.atualizar');
Route::get('/usuario/excluir/{id}', 'UsuarioController@excluir')->name('usuario.excluir');


Route::get('/cliente', 'ClienteController@index')->name('cliente.index');
Route::get('/cliente/criar', 'ClienteController@criar')->name('cliente.criar');
Route::post('/cliente/salvar', 'ClienteController@salvar')->name('cliente.salvar');
Route::get('/cliente/editar/{id}', 'ClienteController@editar')->name('cliente.editar');
Route::post('/cliente/atualizar/{id}', 'ClienteController@atualizar')->name('cliente.atualizar');
Route::get('/cliente.excluir/{id}', 'ClienteController@excluir')->name('cliente.excluir');

Route::get('/cliente/telefones/{idCliente}', 'ClienteController@telefones')->name('cliente.telefones');
Route::post('/cliente/telefones-salvar/{idCliente}', 'ClienteController@telefonesSalvar')->name('cliente.telefones-salvar');
Route::get('/cliente/telefones-deletar/{idCliente}/{idTelefone}', 'ClienteController@telefonesExcluir')->name('cliente.telefones-excluir');
