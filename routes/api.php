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
    Route::post('/StudentRegister', [AuthintcationController::class, 'StudentRegister'])->withoutMiddleware(['auth:sanctum']);
    Route::post('/HouseOwnerRegister', [AuthintcationController::class, 'HouseOwnerRegister'])->withoutMiddleware(['auth:sanctum']);
    Route::post('/login', [AuthintcationController::class, 'login'])->withoutMiddleware(['auth:sanctum']);
    Route::post('/logout', [AuthintcationController::class, 'logout']);

    // Settings :
    Route::post('/ChangePassword', [PasswordController::class, 'ChangePassword']);
    //Route::post('/ForgetPassword', [PasswordController::class, 'ForgetPassword'])->withoutMiddleware(['auth:sanctum']);
    Route::get('/ShowMyInformation', [MyInformationController::class, 'ShowMyInformation']);
    Route::post('/UpdateMyInformation', [MyInformationController::class, 'UpdateMyInformation']);

    // Notification :
    Route::get('/ShowNotification', [NotifiactionController::class, 'ShowNotification']);

});
Route::group(['middleware' => ['auth:sanctum', 'Student']], function () {
    // display all Apartments in main page Student
    Route::get('/ShowApartments', [HomePageStudentController::class, 'ShowApartments']);
    // display all Studios in main page Student
    Route::get('/ShowStudios', [HomePageStudentController::class, 'ShowStudios']);
    // display all House in main page Student
    Route::get('/PrintHouse', [HomePageStudentController::class, 'PrintHouse']);
    // Search Field in main page Student
    Route::post('/SearchFieldPost', [HomePageStudentController::class, 'SearchFieldPost']);
    Route::get('/SearchFieldGet/{id}', [HomePageStudentController::class, 'SearchFieldGet']);
    // Show all User's Favorite House:
    Route::get('/ShowUserFavorites', [FavoriteController::class, 'ShowUserFavorites']);
    //  User liked or deleted the Favorite House ( Favorite Icon )
    Route::post('/FavoriteIcon', [FavoriteController::class, 'FavoriteIcon']);
    // House Details :
    Route::get('/HouseDetails/{RequestHouseId}', [HouseDetailsController::class, 'HouseDetails']);
    // Room Details :
    Route::get('/RoomDetails/{RoomIdRequest}', [HouseDetailsController::class, 'RoomDetails']);
});

Route::group(['middleware' => 'Admin'], function () {});

Route::group(['middleware' => 'HouseOwner'], function () {});


Route::post('/store', [ImageController::class, 'store']);
