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
use App\Http\Controllers\DelegationsPageController;
use App\Http\Controllers\AddDelegationPageController;
use App\Http\Controllers\AddVipsController;
use App\Http\Controllers\ActivateProfileController;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\LiasonsController;
use App\Http\Controllers\MemberController;
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
    Route::get('/events', [EventController::class, 'render'])->name('pages.events');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout.request');
    Route::get('/', [DashboardController::class, 'renderView'])->name("pages.dashboard");
    Route::get('/userProfile/myProfile', [UserFullProfileController::class, 'renderMyProfile'])->name('pages.myProfile');
    Route::get('/userProfile/profileActivation', [ActivateProfileController::class, 'renderProfileActivation'])->name('pages.profileActivation');
    Route::get('/interested/{id}', [EventInterestedController::class, 'updateInterest'])->name('request.interested');
    Route::post('/updateDelegation', [AddDelegationPageController::class, 'updateDelegation'])->name('request.updateDelegation');


    // Request Routes
    Route::post('/imageUpload', [ProfileImageController::class, 'uploadImage'])->name('request.imageUpload');
    Route::post('/updateProfile', [UpdateProfileController::class, 'updateProflie'])->name('request.updateProfile');
    Route::post('/updateProfilePassowrd', [UpdateProfileController::class, 'updatePassword'])->name('request.updatePassword');
    Route::post('/activateProfile', [ActivateProfileController::class, 'activateProfile'])->name('request.activateProfile');


    Route::group(['middleware' => 'delegateTypeCheck'], function () {
        Route::get('/members', [MemberController::class, 'render'])->name('pages.members');
        Route::get('/getMembers', [MemberController::class, 'membersData'])->name('request.getMembers');
        Route::get('/addMember/{id}', [MemberController::class, 'addMemberPage'])->name('pages.addMember');
        Route::get('/delegation', [DelegationsPageController::class, 'singleDelegation'])->name('pages.delegation');
        Route::get('/specificLiason', [LiasonsController::class, 'renderSpecificLiason'])->name('pages.renderSpecificLiason');
        Route::post('/addMemberRequest/{id}', [MemberController::class, 'addMemberRequest'])->name('request.addMemberRequest');
        Route::post('/updateMemberRequest/{id}', [MemberController::class, 'updateMemberRequest'])->name('pages.updateMemberRequest');
        Route::get('/specificLiasonsData/{id}', [LiasonsController::class, 'specificLiasonsData'])->name('request.specificLiasonsData');
        Route::get('/userProfile/delegateProfile', [UserFullProfileController::class, 'renderDelegateProfile'])->name('pages.delegateProfile');
    });

    Route::group(['middleware' => 'liasonTypeCheck'], function () {
        Route::get('/delegationAssigned', [DelegationsPageController::class, 'delegationAssigned'])->name('pages.delegationAssigned');
        Route::get('/liason/delegateProfile/{id}', [LiasonsController::class, 'specificLiasonsData'])->name('pages.liasonDelegateProfile');
    });

    Route::group(['middleware' => 'userTypeCheck'], function () {
        Route::get('/flights', [FlightsController::class, 'render'])->name('pages.flights');
        Route::get('/addflights', [FlightsController::class, 'addItineraryRender'])->name('pages.addflights');
        Route::get('/addticketspage', [FlightsController::class, 'addTicketRender'])->name('pages.addticketspage');
        Route::get('/viewItinerary/{id}', [FlightsController::class, 'viewItinerary'])->name('page.viewItinerary');
        Route::get('/viewPassenger/{id}', [FlightsController::class, 'viewPassenger'])->name('page.viewPassenger');
        Route::post('/addTicket', [FlightsController::class, 'addTicket'])->name('request.addTicket');
        Route::post('/addItinerary', [FlightsController::class, 'addItinerary'])->name('request.addItinerary');
        Route::post('/updateItinerary', [FlightsController::class, 'updateItinerary'])->name('request.updateItinerary');
        Route::get('/getItinerary', [FlightsController::class, 'getItinerary'])->name('request.getItinerary');
        Route::get('/getTickets', [FlightsController::class, 'getTickets'])->name('request.getTickets');
        Route::post('/addVips', [AddVipsController::class, 'addVips'])->name('request.addVips');
        Route::get('/addEventPage', [AddEventController::class, 'render'])->name('pages.addEvent');
        Route::get('/liasons', [LiasonsController::class, 'renderLiasons'])->name('pages.liasons');
        Route::get('/liasonsData', [LiasonsController::class, 'liasonsData'])->name('request.liasonsData');
        Route::post('/addLiason', [LiasonsController::class, 'addLiason'])->name('request.addLiason');
        Route::get('/addLiasonPages', [LiasonsController::class, 'addLiasonPage'])->name('pages.addLiason');
        Route::post('/attachLiason', [LiasonsController::class, 'attachLiason'])->name('request.attachLiason');
        Route::get('/userPanel', [UserPanelController::class, 'renderView'])->name("pages.userPanel");
        Route::get('/userProfile/{id}', [UserFullProfileController::class, 'render'])->name('pages.userProfile');
        Route::post('/addEventRequest', [AddEventController::class, 'addEvent'])->name('request.addEventRequest');
        Route::get('/delegationsPage', [DelegationsPageController::class, 'render'])->name('pages.delegationsPage');
        Route::get('/getDelegates', [DelegationsPageController::class, 'delegationData'])->name('request.getDelegates');
        Route::get('/addDelegationPage', [AddDelegationPageController::class, 'render'])->name('pages.addDelegationPage');
        Route::get('/getSpecificMembers', [MemberController::class, 'specificMembersData'])->name('pages.getSpecificMembers');
        Route::post('/updateAuthority', [UpdateProfileController::class, 'updateAuthority'])->name('request.updateAuthority');
        Route::get('/delegateProfile/{id}', [UserFullProfileController::class, 'renderSpeceficDelegateProfile'])->name('pages.renderSpeceficDelegateProfile');
        Route::post('/addDelegationRequest', [AddDelegationPageController::class, 'addDelegation'])->name('request.addDelegationRequest');
        Route::get('/liasonSpecifivProfile/{id}', [LiasonsController::class, 'specificLiasonsData'])->name('pages.liasonSpecifivProfile');
    });
    Route::group(['middleware' => 'authorisedUserCheck'], function () {
        Route::get('/memberFullProfile/{id}', [MemberController::class, 'memberFullProfile'])->name('pages.memberFullProfile');
    });
});


Route::post('signUpRequest', [SignUpController::class, 'signUp'])->name('request.signUp');
Route::post('signInRequest', [SignInController::class, 'signIn'])->name('request.signIn');
Route::post('activationRequest', [ActivationRequest::class, 'activation'])->name('request.activation');
