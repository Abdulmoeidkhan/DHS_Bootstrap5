<?php

use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\ActivationRequest;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserPanelController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/signIn', function () {
    return view('pages.signIn');
})->name("signIn");

Route::get('/signUp', function () {
    return view('pages.signUp');
})->name("signUp");

Route::get('/accountActivation', function () {
    return view('pages.activation');
})->name("accountActivation");

// Route::get('/userList', function () {
//     return view('pages.userList');
// })->name("userList");
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'renderView'])->name("dashboard");
    Route::get('/userPanel', [UserPanelController::class,'renderView'])->name("userPanel");
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout.request');
    Route::get('/deleteUser/{id}', [UserProfileController::class, 'deleteId'])->name('deleteUser.request');
    Route::get('/restoreUser/{id}', [UserProfileController::class, 'restoreId'])->name('restoreUser.request');
});


Route::post('signUpRequest', [SignUpController::class, 'signUp'])->name('signUp.request');
Route::post('signInRequest', [SignInController::class, 'signIn'])->name('signIn.request');
Route::post('activationRequest', [ActivationRequest::class, 'activation'])->name('activation.request');
