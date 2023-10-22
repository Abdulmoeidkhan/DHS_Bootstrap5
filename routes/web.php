<?php

use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\ActivationRequest;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileImageController;
use App\Http\Controllers\UpdateProfileController;
use App\Http\Controllers\UserFullProfileController;
use App\Http\Controllers\UserPanelController;
use App\Http\Controllers\AddEventController;
use App\Http\Controllers\EventInterestedController;
use App\Http\Controllers\DelegationPageController;
// use App\Http\Controllers\UserProfileController;
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

Route::get('/404', function () {
    return view('pages.404');
})->name("404");

// Route::get('/userList', function () {
//     return view('pages.userList');
// })->name("userList");
Route::group(['middleware' => 'auth'], function () {
    // Commented Routes not in use for now 
    // Route::get('/deleteUser/{id}', [UserProfileController::class, 'deleteId'])->name('request.deleteUser');
    // Route::get('/restoreUser/{id}', [UserProfileController::class, 'restoreId'])->name('restoreUser.request');

    // Pages Routes
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout.request');
    Route::get('/', [DashboardController::class, 'renderView'])->name("pages.dashboard");
    Route::get('/events', [EventController::class, 'render'])->name('pages.events');
    Route::get('/interested/{id}', [EventInterestedController::class, 'updateInterest'])->name('request.interested');
    Route::get('/userProfile/myProfile', [UserFullProfileController::class, 'renderMyProfile'])->name('pages.myProfile');


    // Request Routes
    Route::post('/imageUpload', [ProfileImageController::class, 'uploadImage'])->name('request.imageUpload');
    Route::post('/updateProfile', [UpdateProfileController::class, 'updateProflie'])->name('request.updateProfile');
    Route::post('/updateProfilePassowrd', [UpdateProfileController::class, 'updatePassword'])->name('request.updatePassword');

    Route::group(['middleware' => 'userTypeCheck'], function () {
        Route::get('/addEventPage', [AddEventController::class, 'render'])->name('pages.addEvent');
        Route::get('/delegationPage', [DelegationPageController::class, 'render'])->name('pages.delegationPage');
        Route::get('/userPanel', [UserPanelController::class, 'renderView'])->name("pages.userPanel");
        Route::get('/userProfile/{id}', [UserFullProfileController::class, 'render'])->name('pages.userProfile');
        Route::post('/addEventRequest', [AddEventController::class, 'addEvent'])->name('request.addEventRequest');
        Route::post('/updateAuthority', [UpdateProfileController::class, 'updateAuthority'])->name('request.updateAuthority');
    });
});
// Route::group(['middleware' => ['auth','userTypeCheck']], function () {
// });


Route::post('signUpRequest', [SignUpController::class, 'signUp'])->name('request.signUp');
Route::post('signInRequest', [SignInController::class, 'signIn'])->name('request.signIn');
Route::post('activationRequest', [ActivationRequest::class, 'activation'])->name('request.activation');
