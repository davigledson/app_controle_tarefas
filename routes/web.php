<?php

use App\Http\Controllers\TarefaController;
use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('bem-vindo');
});

Auth::routes(['verify'=>true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
// ->name('home')
// ->middleware('verified');

Route::get('/mensagem-teste',function(){
    return new MensagemTesteMail();
    //Mail::to('davi@gmail.com')->send(new MensagemTesteMail());
    //return 'E-mail enviado com sucesso';
});
Route::get('tarefa/exportacao',[TarefaController::class,'exportacao'])->name('tarefa.exportacao');
Route::resource('tarefa', TarefaController::class)
->middleware('verified');
