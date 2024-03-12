<?php

use App\Http\Controllers\ActivationRequest;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\AddVipsController;
use App\Http\Controllers\ProgramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['auth' => 'sanctum'], function () {
    // Program API Start
    Route::post('/addProgram', [ProgramController::class, 'addProgram'])->name('request.addProgram');
    Route::post('/deleteProgram', [ProgramController::class, 'deleteProgram'])->name('request.deleteProgram');
    // Program API End

    // VIPS API Start
    Route::post('/addVips', [AddVipsController::class, 'addVips'])->name('request.addVips');
    // VIPS API End

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signUpRequest', [SignUpController::class, 'signUp'])->name('request.signUp');
Route::post('signInRequest', [SignInController::class, 'signIn'])->name('request.signIn');
Route::post('activationRequest', [ActivationRequest::class, 'activation'])->name('request.activation');
