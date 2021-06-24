<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\WebPagesController;
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

Route::get('/', [WebPagesController::class, 'index'])->name('web-page.index');
Route::resource('action', ActionsController::class)->only(['store', 'update', 'destroy']);
