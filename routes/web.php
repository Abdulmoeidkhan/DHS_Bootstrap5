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
use App\Http\Controllers\ActivateProfileController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\DelegateFlightController;
use App\Http\Controllers\DelegatesPageController;
use App\Http\Controllers\DoucmentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\GoogleLoginController;
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
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WishController;
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
    if (auth()?->user()?->uid) {
        return redirect()->route('pages.dashboard');
    } else {
        return view('pages.signIn');
    }
})->name("signIn");

Route::get('/signUp', function () {
    if (auth()?->user()?->uid) {
        return redirect()->route('pages.dashboard');
    } else {
        return view('pages.signUp');
    }
})->name("signUp");

Route::get('/accountActivation', function () {
    if (auth()?->user()?->uid) {
        return redirect()->route('pages.dashboard');
    } else {
        return view('pages.activation');
    }
})->name("accountActivation");

Route::get('/404', function () {
    return view('pages.404');
})->name("404");

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
    Route::post('/imageUpload', [ProfileImageController::class, 'imageBlobUpload'])->name('request.imageUpload');
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
        Route::get('/hotelPlans', [HotelController::class, 'hotelPlans'])->name('pages.hotelPlans');
        Route::get('/liason/delegateProfile/{id}', [LiasonsController::class, 'specificLiasonsData'])->name('pages.liasonDelegateProfile');
    });


    Route::group(['middleware' => 'hotelUserTypeCheck'], function () {

        // Hotels Pages And API Start
        Route::get('/category', [HotelController::class, 'categoryRender'])->name('pages.category');
        Route::get('/hotels', [HotelController::class, 'render'])->name('pages.hotels');
        Route::get('/getHotels', [HotelController::class, 'getHotels'])->name('request.getHotels');
        Route::get('/addHotelPage/{id?}', [HotelController::class, 'addHotelRender'])->name('pages.addHotel');
        Route::post('/addHotels', [HotelController::class, 'addHotel'])->name('request.addHotel');
        Route::post('/updateHotel/{id}', [HotelController::class, 'updateHotel'])->name('request.updateHotel');
        // Hotels Pages And API End

        // Room Pages And API Start
        // Route::get('/getRooms', [HotelController::class, 'getRooms'])->name('request.getRooms');
        Route::get('/getRoomsForDelegate/{id?}', [HotelController::class, 'getRoomsForDelegate'])->name('request.getRoomsForDelegate');
        Route::get('/addRoomPage/{id?}', [HotelController::class, 'addRoomRender'])->name('pages.addRoom');
        Route::post('/addRoom', [HotelController::class, 'addRoom'])->name('request.addRoom');
        Route::post('/assignedRoom', [HotelController::class, 'assignedRoom'])->name('request.assignedRoom');
        Route::post('/updateRoom/{id}', [HotelController::class, 'updateRoom'])->name('request.updateRoom');
        Route::post('/roomUpdate', [HotelController::class, 'roomUpdate'])->name('request.roomUpdate');
        Route::post('/deleteroom', [HotelController::class, 'deleteroom'])->name('request.deleteroom');
        // Room Pages And API End

    });


    Route::group(['middleware' => 'airportUserTypeCheck'], function () {

        // Members Start
        Route::get('/getDelegationFlight/{status?}', [DelegateFlightController::class, 'getFlight'])->name('request.getDelegationFlight');
        Route::get('/departureStatusChanger/{id}/{status}', [DelegateFlightController::class, 'departureStatusChanger'])->name('request.departureStatusChanger');
        Route::get('/arrivalStatusChanger/{id}/{status}', [DelegateFlightController::class, 'arrivalStatusChanger'])->name('request.arrivalStatusChanger');
        Route::get('/getFlightsSummary', [DelegateFlightController::class, 'getFlightsSummary'])->name('data.getFlightsSummary');
        Route::post('/addDelegationFlight/{id}', [DelegateFlightController::class, 'setFlight'])->name('request.addDelegationFlight');
        // Members End


        // Flights Pages And API Start
        Route::get('/airport', [DelegateFlightController::class, 'render'])->name('pages.airport');
        Route::get('/flights', [FlightsController::class, 'render'])->name('pages.flights');
        Route::get('/addflights', [FlightsController::class, 'addItineraryRender'])->name('pages.addflights');
        Route::get('/addticketspage', [FlightsController::class, 'addTicketRender'])->name('pages.addticketspage');
        Route::get('/viewItinerary/{id}', [FlightsController::class, 'viewItinerary'])->name('page.viewItinerary');
        Route::get('/viewPassenger/{id}', [FlightsController::class, 'viewPassenger'])->name('page.viewPassenger');
        Route::get('/getItinerary', [FlightsController::class, 'getItinerary'])->name('request.getItinerary');
        Route::get('/getTickets', [FlightsController::class, 'getTickets'])->name('request.getTickets');
        Route::post('/addTicket', [FlightsController::class, 'addTicket'])->name('request.addTicket');
        Route::post('/addItinerary', [FlightsController::class, 'addItinerary'])->name('request.addItinerary');
        Route::post('/updateItinerary', [FlightsController::class, 'updateItinerary'])->name('request.updateItinerary');
        // Flights Pages And API End
    });

    Route::group(['middleware' => 'userTypeCheck'], function () {
        // Flights Pages And API Start
        // Route::get('/airport', [DelegateFlightController::class, 'render'])->name('pages.airport');
        // Route::get('/flights', [FlightsController::class, 'render'])->name('pages.flights');
        // Route::get('/addflights', [FlightsController::class, 'addItineraryRender'])->name('pages.addflights');
        // Route::get('/addticketspage', [FlightsController::class, 'addTicketRender'])->name('pages.addticketspage');
        // Route::get('/viewItinerary/{id}', [FlightsController::class, 'viewItinerary'])->name('page.viewItinerary');
        // Route::get('/viewPassenger/{id}', [FlightsController::class, 'viewPassenger'])->name('page.viewPassenger');
        // Route::post('/addTicket', [FlightsController::class, 'addTicket'])->name('request.addTicket');
        // Route::post('/addItinerary', [FlightsController::class, 'addItinerary'])->name('request.addItinerary');
        // Route::post('/updateItinerary', [FlightsController::class, 'updateItinerary'])->name('request.updateItinerary');
        // Route::get('/getItinerary', [FlightsController::class, 'getItinerary'])->name('request.getItinerary');
        // Route::get('/getTickets', [FlightsController::class, 'getTickets'])->name('request.getTickets');
        // Flights Pages And API End



        // Room Type Pages And API Start
        Route::get('/getRoomTypes', [HotelController::class, 'getRoomTypes'])->name('request.getRoomTypes');
        Route::get('/addRoomTypePage/{id?}', [HotelController::class, 'addRoomTypeRender'])->name('pages.addRoomType');
        Route::post('/addRoomType', [HotelController::class, 'addRoomType'])->name('request.addRoomType');
        Route::post('/updateRoomType/{id}', [HotelController::class, 'updateRoomType'])->name('request.updateRoomType');
        // Room Type Pages And API End

        // // Room Pages And API Start
        // // Route::get('/getRooms', [HotelController::class, 'getRooms'])->name('request.getRooms');
        // Route::get('/getRoomsForDelegate', [HotelController::class, 'getRoomsForDelegate'])->name('request.getRoomsForDelegate');
        // Route::get('/addRoomPage/{id?}', [HotelController::class, 'addRoomRender'])->name('pages.addRoom');
        // Route::post('/addRoom', [HotelController::class, 'addRoom'])->name('request.addRoom');
        // Route::post('/assignedRoom', [HotelController::class, 'assignedRoom'])->name('request.assignedRoom');
        // Route::post('/updateRoom/{id}', [HotelController::class, 'updateRoom'])->name('request.updateRoom');
        // Route::post('/roomUpdate', [HotelController::class, 'roomUpdate'])->name('request.roomUpdate');
        // Route::post('/deleteroom', [HotelController::class, 'deleteroom'])->name('request.deleteroom');
        // // Room Pages And API End

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
        Route::get('/detachCarData/{id}', [CarsController::class, 'detachCarData'])->name('data.detachCarData');
        Route::post('/addCar', [CarsController::class, 'addCar'])->name('request.addCar');
        Route::post('/updateCar/{id}', [CarsController::class, 'updateCar'])->name('request.updateCar');
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

        // Officer Page And API Start
        Route::get('/officer', [OfficerController::class, 'renderOfficer'])->name('pages.officer');
        Route::get('/officerData/{params?}/{type?}/{force?}/{id?}', [OfficerController::class, 'officerData'])->name('request.officerData');
        Route::get('/addOfficerPage/{id?}', [OfficerController::class, 'addOfficerPage'])->name('pages.addOfficer');
        Route::get('/detachOfficerData/{id}', [OfficerController::class, 'detachOfficerData'])->name('data.detachOfficer');
        Route::get('/getOfficerSummary', [OfficerController::class, 'getOfficerSummary'])->name('data.getOfficerSummary');
        Route::post('/addOfficer', [OfficerController::class, 'addOfficer'])->name('request.addOfficer');
        Route::post('/updateOfficer/{id}', [OfficerController::class, 'updateOfficer'])->name('request.updateOfficer');
        Route::post('/attachOfficer', [OfficerController::class, 'attachOfficer'])->name('request.attachOfficer');
        Route::post('/detachOfficer', [OfficerController::class, 'detachOfficer'])->name('request.detachOfficer');
        // Officer Page And API End


        // Liason Page And API Start
        Route::get('/liasons', [LiasonsController::class, 'renderLiasons'])->name('pages.liasons');
        Route::get('/liasonsData', [LiasonsController::class, 'liasonsData'])->name('request.liasonsData');
        Route::get('/addLiasonPage', [LiasonsController::class, 'addLiasonPage'])->name('pages.addLiason');
        Route::post('/addLiason', [LiasonsController::class, 'addLiason'])->name('request.addLiason');
        Route::post('/attachLiason', [LiasonsController::class, 'attachLiason'])->name('request.attachLiason');
        // Liason Page And API End

        // interpreters Page And API Start
        Route::get('/interpreters', [InterpreterController::class, 'renderInterpreters'])->name('pages.interpreters');
        Route::get('/interpretersData', [InterpreterController::class, 'interpretersData'])->name('request.interpretersData');
        Route::get('/addInterpreterPage', [InterpreterController::class, 'addInterpreterPage'])->name('pages.addInterpreter');
        Route::post('/addInterpreter', [InterpreterController::class, 'addInterpreter'])->name('request.addInterpreter');
        Route::post('/attachInterpreter', [InterpreterController::class, 'attachInterpreter'])->name('request.attachInterpreter');
        // interpreters Page And API End

        // receivings Page And API Start
        Route::get('/receivings', [ReceivingController::class, 'renderReceivings'])->name('pages.receivings');
        Route::get('/receivingsData', [ReceivingController::class, 'receivingsData'])->name('request.receivingsData');
        Route::get('/addReceivingPages', [ReceivingController::class, 'addReceivingPage'])->name('pages.addReceivings');
        Route::post('/addReceiving', [ReceivingController::class, 'addReceiving'])->name('request.addReceiving');
        Route::post('/attachReceiving', [ReceivingController::class, 'attachReceiving'])->name('request.attachReceiving');
        // receivings Page And API End

        // Program Page And API Start
        Route::get('/programs', [ProgramController::class, 'renderPrograms'])->name('pages.programs');
        Route::get('/programsData', [ProgramController::class, 'programsData'])->name('request.programsData');
        Route::get('/addProgramPages', [ProgramController::class, 'addProgramPages'])->name('pages.addProgramPages');
        // Route::post('/attachLiason', [LiasonsController::class, 'attachLiason'])->name('request.attachLiason');
        // Program Page And API End

        // Badge Page And API Start
        Route::get('/badges', [BadgeController::class, 'renderBadges'])->name('pages.badges');
        // Route::get('/receivingsData', [BadgeController::class, 'receivingsData'])->name('request.receivingsData');
        // Route::post('/addReceiving', [BadgeController::class, 'addReceiving'])->name('request.addReceiving');
        // Route::get('/addReceivingPages', [BadgeController::class, 'addReceivingPage'])->name('pages.addReceivings');
        // Route::post('/attachReceiving', [BadgeController::class, 'attachReceiving'])->name('request.attachReceiving');
        // Badge Page And API End

        Route::get('/userPanel', [UserPanelController::class, 'render'])->name("pages.userPanel");
        Route::get('/addEventPage', [AddEventController::class, 'render'])->name('pages.addEvent');
        Route::get('/profileUser/{id}', [UserFullProfileController::class, 'render'])->name('pages.profileUser');
        Route::post('/addEventRequest', [AddEventController::class, 'addEvent'])->name('request.addEventRequest');
        Route::get('/delegatesPage', [DelegatesPageController::class, 'render'])->name('pages.delegatesPage');
        Route::get('/delegationsPage', [DelegationsPageController::class, 'render'])->name('pages.delegationsPage');
        Route::get('/getDelegation/{status?}', [DelegationsPageController::class, 'delegationData'])->name('request.getDelegation');
        Route::get('/getDelegates/{status?}', [DelegatesPageController::class, 'delegatesData'])->name('request.getDelegates');
        Route::get('/getDelegatesStats', [DelegatesPageController::class, 'getDelegatesStats'])->name('data.getDelegatesStats');
        Route::get('/getDelegationStats', [DelegatesPageController::class, 'getDelegationStats'])->name('data.getDelegationStats');
        Route::get('/getDelegateSummary', [DelegatesPageController::class, 'getDelegateSummary'])->name('data.getDelegateSummary');
        Route::get('/getDelegateGolfSummary', [DelegatesPageController::class, 'getDelegateGolfSummary'])->name('data.getDelegateGolfSummary');
        Route::get('/addDelegationPage/{id?}', [AddDelegationPageController::class, 'render'])->name('pages.addDelegationPage');
        Route::get('/getSpecificMembers', [MemberController::class, 'specificMembersData'])->name('pages.getSpecificMembers');
        Route::get('/statusChanger/{id}', [DelegationsPageController::class, 'updateStatus'])->name('request.updateStatus');
        Route::get('/members/delegateStatusChanger/{id}', [DelegationsPageController::class, 'delegateStatusChanger'])->name('request.updateDelegateStatus');
        Route::post('/invitationUpdate', [DelegatesPageController::class, 'invitationUpdate'])->name('request.invitaionNumberUpdate');
        Route::post('/updateAuthority', [UpdateProfileController::class, 'updateAuthority'])->name('request.updateAuthority');
        Route::post('/addDelegationRequest', [AddDelegationPageController::class, 'addDelegation'])->name('request.addDelegationRequest');
        Route::post('/updateDelegationRequest', [AddDelegationPageController::class, 'updateDelegationRequest'])->name('request.updateDelegationRequest');


        // Reports Start
        Route::get('reports/countryData', [ReportController::class, 'countryData'])->name('request.countryData');
        Route::get('reports/countryReport', [ReportController::class, 'countryReport'])->name('pages.countryReport');
        Route::get('reports/countryAndVipReport', [ReportController::class, 'countryAndVipReport'])->name('pages.countryAndVipReport');
        Route::get('reports/selfRepReport', [ReportController::class, 'selfRepReport'])->name('pages.selfRepReport');
        Route::get('reports/selfRepData', [ReportController::class, 'selfRepData'])->name('request.selfRepData');
        Route::get('reports/selfRepDetailReport', [ReportController::class, 'selfRepDetailReport'])->name('pages.selfRepDetailReport');
        Route::get('reports/selfRepDetailData', [ReportController::class, 'selfRepDetailData'])->name('request.selfRepDetailData');
        Route::get('reports/countryAndVipData', [ReportController::class, 'countryAndVipData'])->name('request.countryAndVipData');
        Route::get('reports/vipDelegationData', [ReportController::class, 'vipDelegationData'])->name('request.vipDelegationData');
        Route::get('reports/listOfAllDelegates', [ReportController::class, 'listOfAllDelegates'])->name('pages.listOfAllDelegates');
        Route::get('reports/vipDelegationReport', [ReportController::class, 'vipDelegationReport'])->name('pages.vipDelegationReport');
        Route::get('reports/listOfAllDelegation', [ReportController::class, 'listOfAllDelegation'])->name('pages.listOfAllDelegation');
        Route::get('reports/delegationAttendance', [ReportController::class, 'delegationAttendance'])->name('pages.delegationAttendance');
        Route::get('reports/delegationAttendanceData', [ReportController::class, 'delegationAttendanceData'])->name('request.delegationAttendanceData');
        Route::get('reports/delegationArrivalStatusReport', [ReportController::class, 'delegationArrivalStatusReport'])->name('pages.delegationArrivalStatusReport');
        Route::get('reports/delegationArrivalStatusData', [ReportController::class, 'delegationArrivalStatusData'])->name('request.delegationArrivalStatusData');
        Route::get('reports/delegationArrivalStatusVIPReport', [ReportController::class, 'delegationArrivalStatusVIPReport'])->name('pages.delegationArrivalStatusVIPReport');
        Route::get('reports/delegationArrivalStatusVIPData', [ReportController::class, 'delegationArrivalStatusVIPData'])->name('request.delegationArrivalStatusVIPData');
        Route::get('reports/delegationArrivalDetailReport', [ReportController::class, 'delegationArrivalDetailReport'])->name('pages.delegationArrivalDetailReport');
        Route::get('reports/delegationDepartureDetailReport', [ReportController::class, 'delegationDepartureDetailReport'])->name('pages.delegationDepartureDetailReport');
        Route::get('reports/delegationDepartureStatusReport', [ReportController::class, 'delegationDepartureStatusReport'])->name('pages.delegationDepartureStatusReport');
        Route::get('reports/delegationDepartureStatusData', [ReportController::class, 'delegationDepartureStatusData'])->name('request.delegationDepartureStatusData');
        Route::get('reports/delegationDepartureStatusVIPReport', [ReportController::class, 'delegationDepartureStatusVIPReport'])->name('pages.delegationDepartureStatusVIPReport');
        Route::get('reports/delegationDepartureStatusVIPData', [ReportController::class, 'delegationDepartureStatusVIPData'])->name('request.delegationDepartureStatusVIPData');
        Route::get('reports/delegationCheckInStatus', [ReportController::class, 'delegationCheckInStatus'])->name('pages.delegationCheckInStatus');
        Route::get('reports/delegationCheckInStatusData', [ReportController::class, 'delegationCheckInStatusData'])->name('request.delegationCheckInStatusData');
        Route::get('reports/checkInDelegationStatusVIPData', [ReportController::class, 'checkInDelegationStatusVIPData'])->name('request.checkInDelegationStatusVIPData');
        Route::get('reports/delegationCheckInStatusVIPReport', [ReportController::class, 'delegationCheckInStatusVIPReport'])->name('pages.delegationCheckInStatusVIPReport');
        Route::get('reports/delegationCheckOutStatus', [ReportController::class, 'delegationCheckOutStatus'])->name('pages.delegationCheckOutStatus');
        Route::get('reports/delegationCheckOutStatusData', [ReportController::class, 'delegationCheckOutStatusData'])->name('request.delegationCheckOutStatusData');
        Route::get('reports/checkOutDelegationStatusVIPData', [ReportController::class, 'checkOutDelegationStatusVIPData'])->name('request.checkOutDelegationStatusVIPData');
        Route::get('reports/delegationCheckOutStatusVIPReport', [ReportController::class, 'delegationCheckOutStatusVIPReport'])->name('pages.delegationCheckOutStatusVIPReport');
        Route::get('reports/hotelCheckInDetails', [ReportController::class, 'hotelCheckInDetails'])->name('pages.hotelCheckInDetails');
        Route::get('reports/hotelCheckOutDetails', [ReportController::class, 'hotelCheckOutDetails'])->name('pages.hotelCheckOutDetails');
        Route::get('reports/officerROReport', [ReportController::class, 'officerROReport'])->name('pages.officerROReport');
        Route::get('reports/officerLOReport', [ReportController::class, 'officerLOReport'])->name('pages.officerLOReport');
        Route::get('reports/officerIOReport', [ReportController::class, 'officerIOReport'])->name('pages.officerIOReport');
        // Reports End
    });
    Route::group(['middleware' => 'authorisedUserCheck'], function () {
        // Liason Start
        Route::get('/liasonSpecificProfile/{id}', [LiasonsController::class, 'specificLiasonsData'])->name('pages.liasonSpecificProfile');
        Route::post('/updateOfficerRequest/{id}', [LiasonsController::class, 'updateOfficerRequest'])->name('request.updateOfficerRequest');
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

        // Wish API Start
        Route::get('/wishPage', [WishController::class, 'wishPageRender'])->name('pages.wishPage');
        Route::get('/wishesWithDelegation', [WishController::class, 'getWishWithDelegation'])->name('request.wishesWithDelegation');
        Route::get('/getWish/{id?}', [WishController::class, 'getWish'])->name('request.getWish');
        Route::post('/setWish', [WishController::class, 'setWish'])->name('request.setWish');
        Route::post('/deleteWish', [WishController::class, 'deleteWish'])->name('request.deleteWish');
        // Wish API End

        // Feedback API Start
        Route::get('/feedbackPage', [FeedbackController::class, 'feedbackPageRender'])->name('pages.feedbackPage');
        Route::get('/feedbackWithDelegation', [FeedbackController::class, 'getFeedbackWithDelegation'])->name('request.feedbackWithDelegation');
        Route::get('/getFeedback/{id?}', [FeedbackController::class, 'getFeedback'])->name('request.getFeedback');
        Route::post('/setFeedback', [FeedbackController::class, 'setFeedback'])->name('request.setFeedback');
        Route::post('/deleteFeedback', [FeedbackController::class, 'deleteFeedback'])->name('request.deleteFeedback');
        // Feedback API End

        // Members Start
        Route::get('/members/{id}', [MemberController::class, 'render'])->name('pages.members');
        Route::get('/getMembers/{id}', [MemberController::class, 'membersData'])->name('request.getMembers');
        Route::post('/updateMemberRequest/{id}', [MemberController::class, 'updateMemberRequest'])->name('request.updateMemberRequest');
        Route::get('/members/memberFullProfile/{id}', [MemberController::class, 'memberFullProfile'])->name('pages.memberFullProfile');
        // Members End

        // Member Pages And API Start
        Route::get('/members/addMember/{id}', [MemberController::class, 'addMemberPage'])->name('pages.addMember');
        Route::post('/addMemberRequest/{id}', [MemberController::class, 'addMemberRequest'])->name('request.addMemberRequest');
        // Member Pages And API End

        // Flight Pages And API Start
        Route::get('/members/addFlight/{id}', [FlightsController::class, 'addFlightPage'])->name('pages.addFlight');
        // Flight Pages And API End

        Route::get('/members/delegateStatusChanger/{id}', [DelegationsPageController::class, 'delegateStatusChanger'])->name('request.updateDelegateStatus');

        // Delegate Start
        Route::get('/delegateProfile/{id}', [UserFullProfileController::class, 'renderSpeceficDelegateProfile'])->name('pages.renderSpeceficDelegateProfile');
        // Delegate End

        // E-Badge Printing Start
        Route::get('/eBadge/{id}', [BadgeController::class, 'renderEBadge'])->name('pages.e-badge');
        Route::get('/listEBadge', [BadgeController::class, 'renderListEBadge'])->name('pages.e-listEBadge');
        // E-Badge Printing End
    });

    Route::get('/invitation/{id}', [PrintInvitationController::class, 'printInvitation'])->name("pages.invitationPage");
    Route::get('/printDelegationBadge/{id}', [PrintInvitationController::class, 'printDelegationBadge'])->name("pages.printDelegationBadge");
    Route::get('/printDelegationEnvelope/{id}', [PrintInvitationController::class, 'printDelegationEnvelope'])->name("pages.printDelegationEnvelope");
});

Route::post('/signUpRequest', [SignUpController::class, 'signUp'])->name('request.signUp');
Route::post('/signInRequest', [SignInController::class, 'signIn'])->name('request.signIn');
Route::post('/activationRequest', [ActivationRequest::class, 'activation'])->name('request.activation');
Route::get('/sendhtmlemail/{id}', [MailOtpController::class, 'html_email'])->name("request.emailModule");

Route::get('auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('request.google');

Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('request.googleCallBack');
