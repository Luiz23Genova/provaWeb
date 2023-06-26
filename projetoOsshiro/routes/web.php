<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\ManutencaoController;
use App\Http\Controllers\PrincipalController;

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

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/categoria/listar', [CategoriaController::class, 'listar']);
    Route::get('/categoria/novo', [CategoriaController::class, 'novo']);
    Route::get('/categoria/editar/{id}', [CategoriaController::class, 'editar']);
    Route::get('/categoria/excluir/{id}', [CategoriaController::class, 'excluir']);
    Route::post('/categoria/salvar', [CategoriaController::class, 'salvar']);
    Route::get('/categoria/relatorio', [CategoriaController::class, 'relatorio']);

    Route::get('/colaborador/listar', [ColaboradorController::class, 'listar']);
    Route::get('/colaborador/novo', [ColaboradorController::class, 'novo']);
    Route::get('/colaborador/editar/{id}', [ColaboradorController::class, 'editar']);
    Route::get('/colaborador/excluir/{id}', [ColaboradorController::class, 'excluir']);
    Route::get('/colaborador/mensagem/{id}', [ColaboradorController::class, 'mensagem']);
    Route::post('/colaborador/salvar', [ColaboradorController::class, 'salvar']);
    Route::post('/colaborador/mensagem', [ColaboradorController::class, 'enviarMensagem']);

    Route::get('/manutencao/listar', [ManutencaoController::class, 'listar']);
    Route::get('/manutencao/novo', [ManutencaoController::class, 'novo']);
    Route::get('/manutencao/editar/{id}', [ManutencaoController::class, 'editar']);
    Route::get('/manutencao/excluir/{id}', [ManutencaoController::class, 'excluir']);
    Route::post('/manutencao/salvar', [ManutencaoController::class, 'salvar']);
    Route::get('/manutencao/relatorio', [ManutencaoController::class, 'relatorio']);    

    Route::get('/', function () {
        return view('index');
    });
});

Route::get('/principal', [PrincipalController::class, 'index']);
Route::get('/principal/manutencao/{id}', [PrincipalController::class, 'manutencao']);
Route::get('/principal/categoria/{id}', [PrincipalController::class, 'categoria']);

//require __DIR__.'/auth.php';

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
