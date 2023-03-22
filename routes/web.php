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

use App\Http\Controllers\Admin\AnimalController;
Route::controller(AnimalController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::post('animalnews/create', 'create')->name('animalnews.create');
    Route::get('animalnews/create', 'add')->name('animalnews.add');
    Route::get('animalnews', 'index')->name('animalnews.index');
    Route::get('animalnews/edit', 'edit')->name('animalnews.edit');
    Route::post('animalnews/edit', 'update')->name('animalnews.update');
    Route::get('animalnews.delete', 'delete')->name('animalnews.delete');

});

use App\Http\Controllers\Admin\AnimalprofileController;
Route::controller(AnimalprofileController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::post('profile/create', 'create')->name('profile.create');
    Route::post('profile/edit', 'update')->name('profile.update');
    Route::get('profile/create', 'add')->name('profile.add');
    Route::get('profile/edit', 'edit')->name('profile.edit');
    Route::get('profile', 'index')->name('profile.index');
    Route::post('profile/edit', 'update')->name('profile.update');
    Route::get('profile.delete', 'delete')->name('profile.delete');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
