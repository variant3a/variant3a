<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Home;
use App\Http\Livewire\Post;
use App\Http\Livewire\User;
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

Route::get('/', function () {
    return redirect('login');
})->name('/');

Route::prefix('register')->group(function () {
    Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/', [RegisterController::class, 'register']);
});

Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::prefix('home')->name('home.')->group(function () {
        Route::get('index', Home\Index::class)->name('index');
    });

    Route::prefix('post')->name('post.')->group(function () {
        Route::get('index', Post\Index::class)->name('index');
        Route::get('create', Post\Create::class)->name('create');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('index', User\Index::class)->name('index');
    });
});
