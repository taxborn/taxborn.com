<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HonorsController;

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

Route::get('/', HomeController::class)->name('home');

Route::get('/posts', [BlogController::class, 'index'])->name('blog.index');
Route::get('/post/{post:slug}', [BlogController::class, 'show'])->name('blog.post');

Route::prefix('/honors')->group(function () {
    Route::get('/', [HonorsController::class, 'index'])->name('honors.index');

    Route::get('/leadership', [HonorsController::class, 'leadership'])->name('honors.leadership');
    Route::get('/research', [HonorsController::class, 'research'])->name('honors.research');
    Route::get('/global-citizenship', [HonorsController::class, 'globalCitizenship'])->name('honors.global-citizenship');
});
