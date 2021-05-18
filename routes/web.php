<?php

use App\Http\Controllers\UserProfileController;
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
    return view('welcome');
});

Route::view('/home', 'home')->middleware('auth')->name('home');

Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');
Route::put('/user/profile-information', [UserProfileController::class, 'profileInformationUpdate'])->name('profile.update');
Route::put('/user/password', [UserProfileController::class, 'passwordUpdate'])->name('user-password.update');
Route::delete('/user/delete', [UserProfileController::class, 'destroy'])->name('profile.destroy');
