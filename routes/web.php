<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Livewire\Home;
use App\Http\Livewire\Internal;
use App\Http\Livewire\Post;
use App\Http\Livewire\User;
use App\Http\Livewire\Documents;
use App\Http\Livewire\Setting;
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

Route::get('/', Home\Index::class)->name('/');

if (app()->isLocal()) {
    Route::prefix('register')->group(function () {
        Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/', [RegisterController::class, 'register']);
    });
}

// google oauth
// Route::prefix('oauth')->name('oauth.')->group(function () {
//     Route::get('redirect', [LoginController::class, 'redirectToOAuth'])->name('redirect');
//     Route::get('callback', [LoginController::class, 'callbackFromOAuth'])->name('callback');
// });
Route::get('privacy-policy', Documents\PrivacyPolicy::class)->name('privacy-policy');

Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

Route::prefix('post')->name('post.')->group(function () {
    Route::get('index', Post\Index::class)->name('index');
    Route::get('detail/{post}', Post\Show::class)->name('detail');
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('index', User\Index::class)->name('index');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('index', Setting\Index::class)->name('index');
    });

    Route::prefix('post')->name('post.')->group(function () {
        Route::get('edit/{post?}', Post\Edit::class)->name('edit');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('edit', User\Edit::class)->name('edit');
    });
});
