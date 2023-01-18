<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('recipe')->group(function () {
    Route::get('/', [App\Http\Controllers\RecipeController::class, 'index']);
    Route::get('/food/{food}', [App\Http\Controllers\RecipeController::class, 'indexFood']);
    Route::get('/add', [App\Http\Controllers\RecipeController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\RecipeController::class, 'add']);
    Route::get('/edit/{id}', [App\Http\Controllers\RecipeController::class, 'edit']);
    Route::post('/edit/{id}', [App\Http\Controllers\RecipeController::class, 'edit']);
    Route::delete('/destroy/{id}', [App\Http\Controllers\RecipeController::class, 'destroy']);
    Route::post('/taskOn/{id}', [App\Http\Controllers\RecipeController::class, 'taskOn']);
    Route::post('/taskOff/{id}', [App\Http\Controllers\RecipeController::class, 'taskOff']);
    Route::get('/foodAdd', [App\Http\Controllers\RecipeController::class, 'foodAdd']);
    Route::post('/foodAdd', [App\Http\Controllers\RecipeController::class, 'foodAdd']);
    Route::get('/foodEdit', [App\Http\Controllers\RecipeController::class, 'foodEdit']);
    Route::delete('/foodDestroy', [App\Http\Controllers\RecipeController::class, 'foodDestroy']);

});
    Route::get('/task', [App\Http\Controllers\RecipeController::class, 'task']);
    Route::post('/task/taskEnd/{id}', [App\Http\Controllers\RecipeController::class, 'taskEnd']);
    Route::post('/task/taskAllOff', [App\Http\Controllers\RecipeController::class, 'taskAllOff']);

    Route::get('/diary', [App\Http\Controllers\DiaryController::class, 'index']);
    Route::get('/diary/add', [App\Http\Controllers\DiaryController::class, 'add']);
    Route::post('/diary/add', [App\Http\Controllers\DiaryController::class, 'add']);
    Route::delete('/diary/destroy/{id}', [App\Http\Controllers\DiaryController::class, 'destroy']);

    //マイアカウント編集
    Route::get('/myAccount', [App\Http\Controllers\UserController::class, 'myaccount']);
    //アカウント編集画面表示
    Route::get('/myAccount/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('myAccount.edit');
    //アカウント編集実行
    Route::post('/myAccount/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('myAccount.update');
    //アカウント削除実行
    Route::delete('/myAccount/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('myAccount.destroy');
    