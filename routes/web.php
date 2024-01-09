<?php

use App\Http\Controllers\AgentTravelController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenumpangController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Penumpang;
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
// Route::post('/payment-callback', [TransaksiController::class, 'callback']);

// GUEST ROUTES
Route::get('/', [GuestController::class, 'index'])->middleware('guest');;
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::get('/search', [RuteController::class, 'search'])->middleware('guest');
Route::post('/booking', [TransaksiController::class, 'create'])->middleware('guest');

// ADMIN ROUTES
Route::get('/admin', [UserController::class, 'index'])->middleware('admin');
Route::get('/admin/users/{user}', [UserController::class, 'show'])->middleware('admin');
Route::get('/admin/users/edit/{user}', [UserController::class, 'edit'])->middleware('admin');
Route::delete('/admin/users/delete/{user}', [UserController::class, 'destroy'])->middleware('admin');
Route::put('/admin/users/update/{user}', [UserController::class, 'update'])->middleware('admin');
Route::get('/admin/customers', [PenumpangController::class, 'index'])->middleware('admin');
Route::get('/admin/customers/edit/{penumpang}', [PenumpangController::class, 'edit'])->middleware('admin');
Route::delete('/admin/customers/delete/{penumpang}', [PenumpangController::class, 'destroy'])->middleware('admin');
Route::put('/admin/customers/update/{penumpang}', [PenumpangController::class, 'update'])->middleware('admin');

// AGENT TRAVEL ROUTES
Route::get('/agent-travel', [RuteController::class, 'index'])->middleware('agent_travel');
Route::get('/agent-travel/inputForm', [RuteController::class, 'show'])->middleware('agent_travel');
Route::post('/agent-travel/routes/create', [RuteController::class, 'create'])->middleware('agent_travel');
Route::put('/agent-travel/routes/publish/{rute}', [RuteController::class, 'update'])->middleware('agent_travel');
Route::delete('/agent-travel/routes/delete/{rute}', [RuteController::class, 'destroy'])->middleware('agent_travel');
Route::get('/agent-travel/invoice', [InvoiceController::class, 'index'])->middleware('agent_travel');
