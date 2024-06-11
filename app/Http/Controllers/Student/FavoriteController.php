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
    public function showUserFavorites()
    {
        $currentStudent = Auth::user();
        $userId = $currentStudent->id;
        $gender = $currentStudent->gender;
        $Favorites = Favorite::where('userId', $userId)->get();
        if ($Favorites->isEmpty()) {
            return response()->json(['result' => 'لا يوجد']);
        } else {
            $data = [];
            foreach ($Favorites as $Favorite) {
                $houses = House::find($Favorite->houseId);
                $houseData = [];
                $rooms = Room::where('houseId', $houses->id)
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
                    'houseId' => $houses->id,
                    'houseType' => $houses->houseType,
                    'numberOfRooms' => $numberOfRooms,
                    'address' => $houses->address,
                    'location' => $houses->location,
                    'availableRoom' => $availableRooms,
                ];
                if ($availableRooms === 0) {
                    $houseData['message'] = 'العقار محجوز كامل';
                }
                // Name of HouseOwner :
                $user = User::find($houses->userId);
                if ($user) {
                    $houseData['name'] = $user->name;
                }
                // Add HousePhoto based on gender
                $houseData['housePhoto'] = $gender === UserGenderEnum::MALE ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
                $Data[] = $houseData;
            }
            return response()->json(['result' => $Data]);
        }
    }
    public function favoriteIcon(Request $request)
    {
        $currentStudent = Auth::user();
        $userId = $currentStudent->id;
        $houseId = $request->houseId;
        $Favorite = Favorite::where('userId', $userId)->where('houseId', $houseId)->first();
        if($Favorite){
            $Favorite->delete();
            return response()->json(['result' => 'تم الغاء الاعجاب']);
        }else{
            $Favorite = new Favorite();
            $Favorite->UserId = $userId;
            $Favorite->HouseId = $houseId;
            $Favorite->save();
            return response()->json(['result' => 'تم الاعجاب']);
        }
    }
}
