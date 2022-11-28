<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController as AdminPlayerController;
use App\Http\Controllers\PlayerController as UserPlayerController;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home',[App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::resource('/admin/players', AdminPlayerController::class)->middleware(['auth'])->names('admin.players');
Route::resource('/user/players', UserPlayerController::class)->middleware(['auth'])->names('user.players')->only(['index', 'show']);



require __DIR__.'/auth.php';
