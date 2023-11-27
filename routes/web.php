<?php

use App\Http\Controllers\TaskController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::prefix('/')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('task.list');
        Route::post('/create', [TaskController::class, 'create'])->name('task.create');
        Route::put('/update', [TaskController::class, 'update'])->name('task.update');
        Route::get('/complete/{id}', [TaskController::class, 'complete'])->name('task.complete');
        Route::get('/delete/{id}', [TaskController::class, 'delete'])->name('task.delete');
    });
});


