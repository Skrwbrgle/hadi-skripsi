<?php

use App\Http\Controllers\AgentTravelController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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

Route::post('/logout', [LoginController::class, 'logout']);

// GUEST ROUTES
Route::get('/', [GuestController::class, 'index'])->middleware('guest');;
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'create'])->middleware('guest');

// ADMIN ROUTES
Route::get('/admin', [UserController::class, 'index'])->middleware('admin');
Route::get('/admin/users/{user}', [UserController::class, 'show'])->middleware('admin');
Route::get('/admin/users/edit/{user}', [UserController::class, 'edit'])->middleware('admin');
Route::delete('/admin/users/delete/{user}', [UserController::class, 'destroy'])->middleware('admin');
Route::put('/admin/users/update/{user}', [UserController::class, 'update'])->middleware('admin');

// AGENT TRAVEL ROUTES
Route::get('/agent-travel', [AgentTravelController::class, 'index'])->middleware('agent_travel');




// Route::get('/customers', function () {
//     return view('admin/customer');
// });
