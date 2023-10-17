<?php

use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\ActivationRequest;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileImageController;
use App\Http\Controllers\UserFullProfileController;
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
    Route::get('/', [DashboardController::class, 'renderView'])->name("pages.dashboard");
    Route::get('/userPanel', [UserPanelController::class, 'renderView'])->name("pages.userPanel");
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout.request');
    // Route::get('/deleteUser/{id}', [UserProfileController::class, 'deleteId'])->name('request.deleteUser');
    // Route::get('/restoreUser/{id}', [UserProfileController::class, 'restoreId'])->name('restoreUser.request');
    Route::get('/userProfile/{id}', [UserFullProfileController::class, 'render'])->name('pages.userProfile');
    Route::post('/imageUpload', [ProfileImageController::class, 'uploadImage'])->name('request.imageUpload');
});


Route::post('signUpRequest', [SignUpController::class, 'signUp'])->name('request.signUp');
Route::post('signInRequest', [SignInController::class, 'signIn'])->name('request.signIn');
Route::post('activationRequest', [ActivationRequest::class, 'activation'])->name('request.activation');
