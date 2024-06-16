<?php

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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    // Authentication :
    Route::post('/studentRegister', [AuthintcationController::class, 'studentRegister'])->withoutMiddleware(['auth:sanctum']);
    Route::post('/houseOwnerRegister', [AuthintcationController::class, 'houseOwnerRegister'])->withoutMiddleware(['auth:sanctum']);
    Route::post('/login', [AuthintcationController::class, 'login'])->withoutMiddleware(['auth:sanctum']);
    Route::post('/logout', [AuthintcationController::class, 'logout']);
    Route::get('/getUser', [AuthintcationController::class, 'getUser']);

    // Settings :
    Route::post('/changePassword', [PasswordController::class, 'changePassword']);
    //Route::post('/ForgetPassword', [PasswordController::class, 'ForgetPassword'])->withoutMiddleware(['auth:sanctum']);
    Route::get('/showMyInformation', [MyInformationController::class, 'showMyInformation']);
    Route::post('/updateMyInformation', [MyInformationController::class, 'updateMyInformation']);

    // Notification :
    Route::get('/showNotification', [NotifiactionController::class, 'showNotification']);
});
Route::group(['middleware' => ['auth:sanctum', 'Student']], function () {
    // display all Apartments in main page Student
    Route::get('/showApartments', [HomePageStudentController::class, 'showApartments']);
    // display all Studios in main page Student
    Route::get('/showStudios', [HomePageStudentController::class, 'showStudios']);
    // display all House in main page Student
    Route::get('/printHouse', [HomePageStudentController::class, 'printHouse']);
    // Search Field in main page Student
    Route::post('/searchFieldPost', [HomePageStudentController::class, 'searchFieldPost']);
    Route::get('/searchFieldGet/{id}', [HomePageStudentController::class, 'searchFieldGet']);
    // Show all User's Favorite House:
    Route::get('/showUserFavorites', [FavoriteController::class, 'showUserFavorites']);
    //  User liked or deleted the Favorite House ( Favorite Icon )
    Route::post('/favoriteIcon', [FavoriteController::class, 'favoriteIcon']);
    // House Details :
    Route::get('/houseDetails/{requestHouseId}', [HouseDetailsController::class, 'houseDetails']);
    // Room Details :
    Route::get('/roomDetails/{roomIdRequest}', [HouseDetailsController::class, 'roomDetails']);
});

Route::group(['middleware' => 'Admin'], function () {
});

Route::group(['middleware' => 'HouseOwner'], function () {
});


Route::post('/store', [ImageController::class, 'store']);
