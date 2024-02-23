<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('/',[LoginController::class, 'login'])->name('login');
Route::post('/signup/checkkjkj',[LoginController::class, 'check'])->name('check');
Route::get('/signup',[LoginController::class, 'signup'])->name('signup');
Route::post('/signup/registration',[LoginController::class, 'regsubmit'])->name('regsubmit');
Route::get('/dashboard/{email}/{name}/{id}/{balance}',[LoginController::class, 'dashboard'])->name('dash');



Route::post('/dashboard/deposit',[LoginController::class, 'deposit'])->name('deposit');
Route::post('/dashboard/withdraw',[LoginController::class, 'withdraw'])->name('withdraw');
Route::post('/dashboakjjrd/transfar',[LoginController::class, 'transfar'])->name('transfar');
Route::post('/dashboa/statement',[LoginController::class, 'statement'])->name('statement');