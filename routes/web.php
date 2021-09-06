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

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
|--------------------------------------------------------------------------
| Notes
|--------------------------------------------------------------------------
|
| Create - Read - Update - Delete
|
*/
Route::get('/', [App\Http\Controllers\NotesController::class, 'index'])->name('inicio');
Route::get('detail={id}', [App\Http\Controllers\NotesController::class, 'detail'])->name('detail');
Route::post('/', [App\Http\Controllers\NotesController::class, 'post_add'])->name('add');
Route::put('detail={id}', [App\Http\Controllers\NotesController::class, 'put_update'])->name('update');
Route::delete('delete={id}', [App\Http\Controllers\NotesController::class, 'delete'])->name('delete');