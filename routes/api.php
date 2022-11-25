<?php

use App\Http\Controllers\WeightController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('weight')->name('weight.')->group(function () {
    Route::get('', [WeightController::class, 'index'])->name('list');
    Route::post('create', [WeightController::class, 'create'])->name('create');
    Route::post('update', [WeightController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [WeightController::class, 'delete'])->name('delete');
});
