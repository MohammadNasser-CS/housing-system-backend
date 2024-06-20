<?php

use App\Http\Controllers\Admin\AcceptHouseOwner;
use App\Http\Controllers\HouseOwner\AddHouse;
use App\Http\Controllers\HouseOwner\HomePageHouseOwner;
use App\Http\Controllers\HouseOwner\HouseDetails;
use App\Http\Controllers\HouseOwner\RequestPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shared\AuthintcationController;
use App\Http\Controllers\Shared\NotifiactionController;
use App\Http\Controllers\Student\HomePageStudentController;
use App\Http\Controllers\Student\FavoriteController;
use App\Http\Controllers\Student\HouseDetailsController;
use App\Http\Controllers\Student\Recommender;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\MyInformationController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Student\MyRoom;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    // Authentication :
    Route::post('/studentRegister', [AuthintcationController::class, 'studentRegister'])->withoutMiddleware(['auth:sanctum']); // ✅
    Route::post('/houseOwnerRegister', [AuthintcationController::class, 'houseOwnerRegister'])->withoutMiddleware(['auth:sanctum']); // ✅
    Route::post('/login', [AuthintcationController::class, 'login'])->withoutMiddleware(['auth:sanctum']); // ✅
    Route::post('/logout', [AuthintcationController::class, 'logout']); // ✅
    Route::get('/getUser', [AuthintcationController::class, 'getUser']); // ✅

    // Settings :
    Route::post('/changePassword', [PasswordController::class, 'changePassword']); // ✅
    //Route::post('/ForgetPassword', [PasswordController::class, 'ForgetPassword'])->withoutMiddleware(['auth:sanctum']);
    Route::get('/showMyInformation', [MyInformationController::class, 'showMyInformation']); // ✅
    Route::post('/updateMyInformation', [MyInformationController::class, 'updateMyInformation']); // ✅

    // Notification :
    Route::get('/showNotification', [NotifiactionController::class, 'showNotification']); // ✅
});
Route::group(['middleware' => ['auth:sanctum', 'Student']], function () {
    // display Categorized Houses in main page Student
    Route::post('/getCategorizedHouses', [HomePageStudentController::class, 'getCategorizedHouses']); // ✅
    // display all House in main page Student
    Route::get('/getAllHouses', [HomePageStudentController::class, 'getAllHouses']); // ✅
    // Search Field in main page Student
    Route::get('/search/{name}', [HomePageStudentController::class, 'search']); // ✅
    //  User liked or deleted the Favorite House ( Favorite Icon )
    Route::put('/changeFavorite/{houseId}', [FavoriteController::class, 'changeFavorite']); // ✅
    // Show all User's Favorite House:
    Route::get('/getFavoriteHouses', [FavoriteController::class, 'getFavoriteHouses']); // ✅
    // House Details :
    Route::get('/getHouseDetails/{houseId}', [HouseDetailsController::class, 'gethouseDetails']); // ✅
    // Room Details :
    Route::get('/getRoomDetails/{roomId}', [HouseDetailsController::class, 'getRoomDetails']); // ✅
    // Request a room reservation :
    Route::post('/requestReservation', [HouseDetailsController::class, 'requestReservation']); // ✅
    // My requests details view :
    Route::get('/getReservationRoomRequest', [MyRoom::class, 'getReservationRoomRequest']); // ✅
    // My reservation room :
    Route::get('/getMyReservationRoom', [MyRoom::class, 'getMyReservationRoom']);// ✅
    // delete requests :
    Route::delete('/cancelRequest/{requestId}', [MyRoom::class, 'cancelRequest']); // ✅
});

Route::group(['middleware' => 'HouseOwner'], function () {
    // Time slots for HouseOwner
    Route::post('/addtimeSlotsAvailable', [HomePageHouseOwner::class, 'addtimeSlotsAvailable']); // ✅
    // Add House :
    Route::post('/addHouse', [AddHouse::class, 'addHouse']); // ✅
    // All houses for HouseOwner  :
    Route::get('/getAllHousesHouseOwner', [HomePageHouseOwner::class, 'getAllHousesHouseOwner']); // ✅
    // Search Field in Main page of HouseOwner :
    Route::get('/searchHouse/{houseId}', [HomePageHouseOwner::class, 'searchHouse']); // ✅

    // view HouseOwner Request
    Route::get('/HouseOwnerRequests', [RequestPage::class, 'HouseOwnerRequests']);
    // delete request :
    Route::delete('/RejectRequestHouseOwenr/{requestId}', [RequestPage::class, 'RejectRequestHouseOwenr']);
    //confirmAppointment
    Route::put('/confirmAppointment/{requestId}', [RequestPage::class, 'confirmAppointment']);
    // Add Room :
    Route::post('/AddRoom', [AddHouse::class, 'AddRoom']);

    // House Details in HouseOwner :
    Route::get('/gethouseDetails/{houseId}', [HouseDetails::class, 'gethouseDetails']);
    // House Details in HouseOwner :
    Route::get('/getroomDetails/{roomId}', [HouseDetails::class, 'getroomDetails']);
});

Route::group(['middleware' => 'Admin'], function () {
    // get all request register from houseOwner :
    Route::get('/getHouseOwnerRequest', [AcceptHouseOwner::class, 'getHouseOwnerRequest']);
    // Accpet the house owner
    Route::put('/acceptHouseOwner/{ownerId}', [AcceptHouseOwner::class, 'acceptHouseOwner']);
    // reject the house owner
    Route::delete('/rejectHouseOwner/{ownerId}', [AcceptHouseOwner::class, 'rejectHouseOwner']);

});

Route::post('/store', [ImageController::class, 'store']);
