<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\EstacionamentoController;
use App\Http\Controllers\UnidadesController;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Route::post('/usuario/alterar-senha', [UserController::class, 'alterarSenha']);
Route::get('/usuario/altera-senha', [UserController::class, 'alteraSenha']);
Route::get('/estacionamentos/unidades/{idCondominio}', [UnidadesController::class, 'unidadesEstacionamento']);
Route::post('/excluir-unidades', [UnidadesController::class, 'deletaMultiplos']);

Route::resource('usuarios', UserController::class);
Route::resource('estacionamentos', EstacionamentoController::class);
Route::resource('unidades', UnidadesController::class );


Auth::routes();

Route::get('/home', [EstacionamentoController::class, 'index'])->name('home');
