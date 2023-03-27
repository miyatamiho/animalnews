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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\UserController;
Route::resource('users','UserController')->middleware('auth')->group(function(){
    Route::post('animalnews/create', 'create')->name('animalnews.create');
    Route::get('animalnews/create', 'add')->name('animalnews.add');
    Route::get('animalnews', 'index')->name('animalnews.index');
    Route::get('animalnews/edit', 'edit')->name('animalnews.edit');
    Route::post('animalnews/edit', 'update')->name('animalnews.update');
    Route::get('animalnews.delete', 'delete')->name('animalnews.delete');

});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
