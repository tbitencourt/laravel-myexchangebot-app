<?php

use App\Http\Controllers\BotManController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/welcome', function() {
    return view('welcome');
});

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
Route::get( '/chatbot', [ChatbotController::class, 'index']);
