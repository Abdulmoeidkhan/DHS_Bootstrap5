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
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\DelegateFlightController;
use App\Http\Controllers\DelegatesPageController;
use App\Http\Controllers\DoucmentController;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\InterpreterController;
use App\Http\Controllers\LiasonsController;
use App\Http\Controllers\MailOtpController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\PrintInvitationController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ReceivingController;
use App\Models\Delegate;
use App\Models\Delegation;
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
    Route::get('/getPdf/{id}', [DoucmentController::class, 'getPdf'])->name('request.getPdf');
    Route::post('/imageUpload', [ProfileImageController::class, 'uploadImage'])->name('request.imageUpload');
    Route::post('/uploadDocument', [DoucmentController::class, 'uploadDocument'])->name('request.uploadDocument');
    Route::post('/updateProfile', [UpdateProfileController::class, 'updateProflie'])->name('request.updateProfile');
    Route::post('/updateProfilePassowrd', [UpdateProfileController::class, 'updatePassword'])->name('request.updatePassword');
    Route::post('/activateProfile', [ActivateProfileController::class, 'activateProfile'])->name('request.activateProfile');


    Route::group(['middleware' => 'delegateTypeCheck'], function () {
        // Route::get('/members', [MemberController::class, 'render'])->name('pages.members');
        Route::get('/delegation', [DelegationsPageController::class, 'singleDelegation'])->name('pages.delegation');
        Route::get('/specificLiason', [LiasonsController::class, 'renderSpecificLiason'])->name('pages.renderSpecificLiason');
        Route::get('/specificLiasonData/{id}', [LiasonsController::class, 'specificLiasonData'])->name('request.specificLiasonData');
        Route::get('/specificReceivingData/{id?}', [ReceivingController::class, 'specificReceivingData'])->name('request.specificReceivingData');
        Route::get('/userProfile/delegateProfile', [UserFullProfileController::class, 'renderDelegateProfile'])->name('pages.delegateProfile');
    });

    Route::group(['middleware' => 'liasonTypeCheck'], function () {
        Route::get('/delegationAssigned', [DelegationsPageController::class, 'delegationAssigned'])->name('pages.delegationAssigned');
        Route::get('/liason/delegateProfile/{id}', [LiasonsController::class, 'specificLiasonsData'])->name('pages.liasonDelegateProfile');
    });

    Route::group(['middleware' => 'userTypeCheck'], function () {
        // Flights Pages And API Start
        Route::get('/airport', [DelegateFlightController::class, 'render'])->name('pages.airport');
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
        // Flights Pages And API End

        // Hotels Pages And API Start
        Route::get('/hotels', [HotelController::class, 'render'])->name('pages.hotels');
        Route::get('/getHotels', [HotelController::class, 'getHotels'])->name('request.getHotels');
        Route::get('/addHotelPage/{id?}', [HotelController::class, 'addHotelRender'])->name('pages.addHotel');
        Route::post('/addHotels', [HotelController::class, 'addHotel'])->name('request.addHotel');
        Route::post('/updateHotel/{id}', [HotelController::class, 'updateHotel'])->name('request.updateHotel');
        // Hotels Pages And API End

        // Room Type Pages And API Start
        Route::get('/getRoomTypes', [HotelController::class, 'getRoomTypes'])->name('request.getRoomTypes');
        Route::get('/addRoomTypePage/{id?}', [HotelController::class, 'addRoomTypeRender'])->name('pages.addRoomType');
        Route::post('/addRoomType', [HotelController::class, 'addRoomType'])->name('request.addRoomType');
        Route::post('/updateRoomType/{id}', [HotelController::class, 'updateRoomType'])->name('request.updateRoomType');
        // Room Type Pages And API End

        // Room Pages And API Start
        Route::get('/getRooms', [HotelController::class, 'getRooms'])->name('request.getRooms');
        Route::get('/addRoomPage/{id?}', [HotelController::class, 'addRoomRender'])->name('pages.addRoom');
        Route::post('/addRoom', [HotelController::class, 'addRoom'])->name('request.addRoom');
        Route::post('/assignedRoom', [HotelController::class, 'assignedRoom'])->name('request.assignedRoom');
        Route::post('/updateRoom/{id}', [HotelController::class, 'updateRoom'])->name('request.updateRoom');
        // Room Pages And API End

        // Driver Pages And API Start
        Route::get('/getDrivers', [CarsController::class, 'getDrivers'])->name('request.getDrivers');
        Route::get('/addDriverPage/{id?}', [CarsController::class, 'addDriverRender'])->name('pages.addDriver');
        Route::post('/addDriver', [CarsController::class, 'addDriver'])->name('request.addDriver');
        Route::post('/updateDriver/{id}', [CarsController::class, 'updateDriver'])->name('request.updateDriver');
        // Driver Pages And API End


        // CarCategory Pages And API Start
        Route::get('/getCarCategories', [CarsController::class, 'getCarCategory'])->name('request.getCarCategories');
        Route::get('/addCarCategoriesPage/{id?}', [CarsController::class, 'addCarCategoriesRender'])->name('pages.addCarCategories');
        Route::post('/addCarCategory', [CarsController::class, 'addCarCategory'])->name('request.addCarCategory');
        Route::post('/attachCar', [CarsController::class, 'attachCar'])->name('request.attachCar');
        Route::post('/deattachCar', [CarsController::class, 'deattachCar'])->name('request.deattachCar');
        // Route::post('/updateCar/{id}', [CarsController::class, 'updateCar'])->name('request.updateCar');
        // Car Pages And API End

        // Car Pages And API Start
        Route::get('/cars', [CarsController::class, 'render'])->name('pages.cars');
        Route::get('/getCars', [CarsController::class, 'getCars'])->name('request.getCars');
        Route::get('/addCarPage/{id?}', [CarsController::class, 'addCarRender'])->name('pages.addCar');
        Route::post('/addCar', [CarsController::class, 'addCar'])->name('request.addCar');
        Route::post('/updateCar/{id}', [CarsController::class, 'updateCar'])->name('request.updateCar');
        Route::get('/detachCarData/{id}', [CarsController::class, 'detachCarData'])->name('data.detachCarData');
        // Car Pages And API End

        // Journey Pages And API Start
        Route::get('/getJourney', [CarsController::class, 'getJourneys'])->name('request.getJourney');
        Route::get('/addJourneyPage/{id?}', [CarsController::class, 'addJourneyRender'])->name('pages.addJourney');
        // Plan Pages And API Start
        Route::post('/addJourney', [CarsController::class, 'addJourney'])->name('request.addJourney');
        Route::post('/updateJourney/{id}', [CarsController::class, 'updateJourney'])->name('request.updateJourney');
        // Journey Pages And API End

        Route::get('/getHotelPlan/{id}', [PlansController::class, 'getHotelPlan'])->name('request.getHotelPlan');
        Route::get('/getCarPlan/{id}', [PlansController::class, 'getCarPlan'])->name('request.getCarPlan');
        Route::get('/addPlan/{id}', [PlansController::class, 'addPlanRender'])->name('pages.addPlan');
        Route::get('/addPlan/deleteHotelPlan/{id}', [PlansController::class, 'deleteHotelPlan'])->name('request.deleteHotelPlan');
        Route::get('/addPlan/deleteCarPlan/{id}', [PlansController::class, 'deleteCarPlan'])->name('request.deleteCarPlan');
        // Route::post('/addJourney', [CarsController::class, 'addJourney'])->name('request.addJourney');
        // Route::post('/updateJourney/{id}', [CarsController::class, 'updateJourney'])->name('request.updateJourney');
        // Plan Pages And API End

        // Member Pages And API Start
        Route::get('/members/addMember/{id}', [MemberController::class, 'addMemberPage'])->name('pages.addMember');
        Route::post('/addMemberRequest/{id}', [MemberController::class, 'addMemberRequest'])->name('request.addMemberRequest');
        // Member Pages And API End

        // Officer Page And API Start
        Route::get('/officer', [OfficerController::class, 'renderOfficer'])->name('pages.officer');
        Route::get('/officerData/{id?}', [OfficerController::class, 'officerData'])->name('request.officerData');
        Route::get('/addOfficerPage/{id?}', [OfficerController::class, 'addOfficerPage'])->name('pages.addOfficer');
        Route::post('/addOfficer', [OfficerController::class, 'addOfficer'])->name('request.addOfficer');
        Route::post('/updateOfficer/{id}', [OfficerController::class, 'updateOfficer'])->name('request.updateOfficer');
        Route::post('/attachOfficer', [OfficerController::class, 'attachOfficer'])->name('request.attachOfficer');
        Route::post('/detachOfficer', [OfficerController::class, 'detachOfficer'])->name('request.detachOfficer');
        Route::get('/detachOfficerData/{id}', [OfficerController::class, 'detachOfficerData'])->name('data.detachOfficer');
        // Officer Page And API End


        // Liason Page And API Start
        Route::get('/liasons', [LiasonsController::class, 'renderLiasons'])->name('pages.liasons');
        Route::get('/liasonsData', [LiasonsController::class, 'liasonsData'])->name('request.liasonsData');
        Route::post('/addLiason', [LiasonsController::class, 'addLiason'])->name('request.addLiason');
        Route::get('/addLiasonPage', [LiasonsController::class, 'addLiasonPage'])->name('pages.addLiason');
        Route::post('/attachLiason', [LiasonsController::class, 'attachLiason'])->name('request.attachLiason');
        // Liason Page And API End

        // interpreters Page And API Start
        Route::get('/interpreters', [InterpreterController::class, 'renderInterpreters'])->name('pages.interpreters');
        Route::get('/interpretersData', [InterpreterController::class, 'interpretersData'])->name('request.interpretersData');
        Route::post('/addInterpreter', [InterpreterController::class, 'addInterpreter'])->name('request.addInterpreter');
        Route::get('/addInterpreterPage', [InterpreterController::class, 'addInterpreterPage'])->name('pages.addInterpreter');
        Route::post('/attachInterpreter', [InterpreterController::class, 'attachInterpreter'])->name('request.attachInterpreter');
        // interpreters Page And API End

        // receivings Page And API Start
        Route::get('/receivings', [ReceivingController::class, 'renderReceivings'])->name('pages.receivings');
        Route::get('/receivingsData', [ReceivingController::class, 'receivingsData'])->name('request.receivingsData');
        Route::post('/addReceiving', [ReceivingController::class, 'addReceiving'])->name('request.addReceiving');
        Route::get('/addReceivingPages', [ReceivingController::class, 'addReceivingPage'])->name('pages.addReceivings');
        Route::post('/attachReceiving', [ReceivingController::class, 'attachReceiving'])->name('request.attachReceiving');
        // receivings Page And API End

        // Program Page And API Start
        Route::get('/programs', [ProgramController::class, 'renderPrograms'])->name('pages.programs');
        Route::get('/programsData', [ProgramController::class, 'programsData'])->name('request.programsData');
        Route::get('/addProgramPages', [ProgramController::class, 'addProgramPages'])->name('pages.addProgram');
        Route::post('/addProgram', [ProgramController::class, 'addProgram'])->name('request.addProgram');
        // Route::post('/attachLiason', [LiasonsController::class, 'attachLiason'])->name('request.attachLiason');
        // Program Page And API End

        // VIPS Page And API Start
        Route::post('/addVips', [AddVipsController::class, 'addVips'])->name('request.addVips');
        // VIPS Page And API End

        // Badge Page And API Start
        Route::get('/badges', [BadgeController::class, 'renderBadges'])->name('pages.badges');
        // Route::get('/receivingsData', [BadgeController::class, 'receivingsData'])->name('request.receivingsData');
        // Route::post('/addReceiving', [BadgeController::class, 'addReceiving'])->name('request.addReceiving');
        // Route::get('/addReceivingPages', [BadgeController::class, 'addReceivingPage'])->name('pages.addReceivings');
        // Route::post('/attachReceiving', [BadgeController::class, 'attachReceiving'])->name('request.attachReceiving');
        // Badge Page And API End

        Route::get('/addEventPage', [AddEventController::class, 'render'])->name('pages.addEvent');
        Route::get('/userPanel', [UserPanelController::class, 'renderView'])->name("pages.userPanel");
        Route::get('/userProfile/{id}', [UserFullProfileController::class, 'render'])->name('pages.userProfile');
        Route::post('/addEventRequest', [AddEventController::class, 'addEvent'])->name('request.addEventRequest');
        Route::get('/delegationsPage', [DelegationsPageController::class, 'render'])->name('pages.delegationsPage');
        Route::get('/delegatesPage', [DelegatesPageController::class, 'render'])->name('pages.delegatesPage');
        Route::get('/getDelegation/{status?}', [DelegationsPageController::class, 'delegationData'])->name('request.getDelegation');
        Route::get('/getDelegates/{status?}', [DelegatesPageController::class, 'delegatesData'])->name('request.getDelegates');
        Route::get('/addDelegationPage/{id?}', [AddDelegationPageController::class, 'render'])->name('pages.addDelegationPage');
        Route::get('/getSpecificMembers', [MemberController::class, 'specificMembersData'])->name('pages.getSpecificMembers');
        Route::get('/statusChanger/{id}', [DelegationsPageController::class, 'updateStatus'])->name('request.updateStatus');
        Route::get('/members/delegateStatusChanger/{id}', [DelegationsPageController::class, 'delegateStatusChanger'])->name('request.updateDelegateStatus');
        Route::post('/updateAuthority', [UpdateProfileController::class, 'updateAuthority'])->name('request.updateAuthority');
        Route::post('/addDelegationRequest', [AddDelegationPageController::class, 'addDelegation'])->name('request.addDelegationRequest');
        Route::post('/updateDelegationRequest', [AddDelegationPageController::class, 'updateDelegationRequest'])->name('request.updateDelegationRequest');
    });
    Route::group(['middleware' => 'authorisedUserCheck'], function () {
        // Liason Start
        Route::get('/liasonSpecificProfile/{id}', [LiasonsController::class, 'specificLiasonsData'])->name('pages.liasonSpecificProfile');
        Route::post('/updateLiasonRequest/{id}', [LiasonsController::class, 'updateLiasonRequest'])->name('request.updateLiasonRequest');
        // Liason End

        // Receiving Start
        Route::get('/specificReceivingData/{id?}', [ReceivingController::class, 'specificReceivingData'])->name('request.specificReceivingData');
        Route::post('/updateReceivingRequest/{id}', [ReceivingController::class, 'updateReceivingRequest'])->name('request.updateReceivingRequest');
        // Receiving End

        // Interpreter Start
        Route::get('/interpreterSpecificProfile/{id?}', [InterpreterController::class, 'specificInterpretersData'])->name('request.specificInterpretersData');
        Route::post('/updateInterpreterRequest/{id}', [InterpreterController::class, 'updateInterpreterRequest'])->name('request.updateInterpreterRequest');
        Route::get('/renderSpecificInterpreter', [InterpreterController::class, 'renderSpecificInterpreter'])->name('pages.renderSpecificInterpreter');
        // Interpreter End

        // Program Page And API Start
        Route::get('/getInterests/{id?}', [InterestController::class, 'getInterests'])->name('request.getInterests');
        Route::post('/setInterests/{id?}', [InterestController::class, 'setInterests'])->name('request.setInterests');
        // Program Page And API End

        // Members Start
        Route::get('/members/{id}', [MemberController::class, 'render'])->name('pages.members');
        Route::get('/getMembers/{id}', [MemberController::class, 'membersData'])->name('request.getMembers');
        Route::post('/updateMemberRequest/{id}', [MemberController::class, 'updateMemberRequest'])->name('request.updateMemberRequest');
        Route::get('/members/memberFullProfile/{id}', [MemberController::class, 'memberFullProfile'])->name('pages.memberFullProfile');
        // Members End

        // Members Start
        Route::get('/getDelegationFlight/{status?}', [DelegateFlightController::class, 'getFlight'])->name('request.getDelegationFlight');
        Route::post('/addDelegationFlight/{id}', [DelegateFlightController::class, 'setFlight'])->name('request.addDelegationFlight');
        Route::get('/departureStatusChanger/{id}/{status}', [DelegateFlightController::class, 'departureStatusChanger'])->name('request.departureStatusChanger');
        Route::get('/arrivalStatusChanger/{id}/{status}', [DelegateFlightController::class, 'arrivalStatusChanger'])->name('request.arrivalStatusChanger');
        // Members End

        // Delegate Start
        // Route::get('/delegateProfile/{id}', [UserFullProfileController::class, 'renderSpeceficDelegateProfile'])->name('pages.renderSpeceficDelegateProfile');
        // Delegate End
    });
    Route::get('/invitation/{id}', [PrintInvitationController::class, 'printInvitation'])->name("pages.invitationPage");
});

Route::get('/sendhtmlemail/{id}', [MailOtpController::class, 'html_email'])->name("request.emailModule");
Route::post('signUpRequest', [SignUpController::class, 'signUp'])->name('request.signUp');
Route::post('signInRequest', [SignInController::class, 'signIn'])->name('request.signIn');
Route::post('activationRequest', [ActivationRequest::class, 'activation'])->name('request.activation');
