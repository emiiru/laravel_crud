<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return redirect()->route('users.index');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index'); //Lists
Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); //Create Form
Route::post('/users/create', [UserController::class, 'store'])->name('users.store'); //Save
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit'); //Get Edit
Route::get('/users/show/{id}', [UserController::class, 'show'])->name('users.show'); //Show User
Route::post('/users/edit/{id}', [UserController::class, 'update'])->name('users.update'); //Update
Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete'); //Delete