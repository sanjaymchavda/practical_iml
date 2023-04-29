<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[UserController::class,'index'])->name('home');
Route::get('user-data',[UserController::class,'loadUserData'])->name('user.data');
Route::post('add-user-data',[UserController::class,'addUserData'])->name('add.user.data');
Route::delete('delete-user/{id}',[UserController::class,'destroy'])->name('delete.user.data');
Route::get('edit-user/{id}',[UserController::class,'edit'])->name('edit.user.data');

