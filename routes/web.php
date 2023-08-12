<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;

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

Route::redirect('/', 'login');

Route::get('users', [UserController::class, 'index']);
Route::get('users/profile/{id}', [UserController::class, 'show']);
Route::get('users/profile/edit/{id}', [UserController::class, 'edit']);
Route::post('users/profile/edit/{id}', [UserController::class, 'update']);

Route::get('/sales', [ItemController::class, 'index'])->name('item.index');
Route::post('/sales', [ItemController::class, 'store']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::fallback(function () {
        return view('pages/utility/404');
    });
});
