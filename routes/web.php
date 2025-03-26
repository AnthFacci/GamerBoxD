<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JogosController;
use App\Http\Controllers\AllGames;
use App\Http\Controllers\JogoController;
use App\Http\Controllers\listGames;
use App\Http\Controllers\RecomendationController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jogos', [JogosController::class, 'index'])->name('jogos');
Route::prefix('filtros')->group(function (){
    Route::get('/', [AllGames::class, 'index'] )->name('catalogo');
    Route::post('/', [AllGames::class, 'carregarJogos']);
    Route::post('/nextOrPrevious', [AllGames::class, 'carregarJogosByLink']);
    Route::post('/searchByName', [AllGames::class, 'searchByName']);
});

Route::prefix('jogo')->group(function () {
    Route::get('{id}', [JogoController::class, 'index'])->name('jogo');
    Route::post('storeReview', [JogoController::class, 'storeReview'])->name('store.review');
    Route::post('like', [JogoController::class, 'like'])->name('store.like');
    Route::post('favoriteGame', [JogoController::class, 'favorite'])->name('store.game');
    Route::post('/storeGameOnList/{id_playlist}/{id_game}', [JogoController::class, 'store_list'])->name('store.game');
});

Route::prefix('search')->group(function(){
    Route::get('/', [SearchController::class, 'index'])->name('search.users');
    Route::get('/usuarios', [SearchController::class, 'searchScreen'])->name('search.screen');
});

Route::prefix('perfil')->group(function(){
    Route::get('/{id}', [UserController::class, 'index'])->name('perfil.user');
});

Route::prefix('premios')->group(function (){
    Route::get('/{id}', [GiftController::class, 'index'])->name('premios');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [listGames::class, 'sessao'])->name('dashboard');
    Route::get('/favorites', [listGames::class, 'index'])->name('favorites');
    Route::get('/lista/{id}', [listGames::class, 'lista'])->name('listas');
    Route::post('/storeList', [listGames::class, 'store_list'])->name('store.lista');
    Route::delete('/removeGameFromList/{id_playlist}/{id_game}', [listGames::class, 'remove_game'])->name('delete.game');
    Route::delete('/removeList/{id_playlist}/{user_id}', [listGames::class, 'remove_list'])->name('delete.list');
    Route::get('/recomendation', [RecomendationController::class, 'index'])->name('recomendation');
});
