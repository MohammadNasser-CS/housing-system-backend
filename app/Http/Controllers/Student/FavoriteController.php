<?php

namespace App\Http\Controllers\Student;

use App\Enum\RoomTypeEnum;
use App\Enum\UserGenderEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\Favorite;
use App\Models\User;
use App\Models\PrimaryRoom;
use App\Models\Room;

use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function getFavoriteHouses()
    {
        $currentStudent = Auth::user();

        $userId = $currentStudent->id;
        $gender = $currentStudent->gender;
        $Favorites = Favorite::where('userId', $userId)->get();
        $Data = [];
        if ($Favorites->isEmpty()) {
            return response()->json(['message' => 'لا يوجد تسجيلات إعجاب']);
        } else {
            foreach ($Favorites as $Favorite) {
                $house = House::find($Favorite->houseId);
                $houseData = [];
                $rooms = Room::where('houseId', $house->id)
                    ->where('roomType', RoomTypeEnum::sleepRoom)
                    ->get();
                $numberOfRooms = $rooms->count();
                $availableRooms = 0;
                foreach ($rooms as $room) {
                    $availableRooms += PrimaryRoom::where('roomId', $room->id)
                        ->whereRaw('bedNumber - bedNumberBooked > 0')
                        ->count();
                }

                $houseData = [
                    'houseId' => $house->id,
                    'houseType' => $house->houseType,
                    'numberOfRooms' => $numberOfRooms,
                    'address' => $house->address,
                    'location' => $house->location,
                    'availableRoom' => $availableRooms,
                ];
                if ($availableRooms === 0) {
                    $houseData['message'] = 'العقار محجوز كامل';
                }
                // Name of HouseOwner :
                $user = User::find($house->userId);
                if ($user) {
                    $houseData['ownerName'] = $user->name;
                }
                // Add HousePhoto based on gender
                $houseData['housePhoto'] = $gender === UserGenderEnum::MALE->value ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');

                $currentStudent = Auth::user();
                $favorite = Favorite::where('userId', $currentStudent->id)
                    ->where('houseId', $house->id)
                    ->first();
                $houseData['isFavorite'] = $favorite ? true : false;
                $Data[] = $houseData;
            }
            return response()->json(['houses' => $Data]);
        }
    }
    public function changeFavorite($houseId)
    {
        $currentStudent = Auth::user();
        $userId = $currentStudent->id;

        $Favorite = Favorite::where('userId', $userId)->where('houseId', $houseId)->first();
        if ($Favorite) {
            $Favorite->delete();
            return response()->json(['message' => 'تم الغاء الاعجاب']);
        } else {
            $Favorite = new Favorite();
            $Favorite->UserId = $userId;
            $Favorite->HouseId = $houseId;
            $Favorite->save();
            return response()->json(['message' => 'تم الاعجاب']);
        }
    }
}
