<?php

namespace App\Http\Controllers\Student;

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
    public function ShowUserFavorites()
    {
        $currentStudent = Auth::user();
        $UserId = $currentStudent->id;
        $gender = $currentStudent->Gender;
        $Favorites = Favorite::where('UserId', $UserId)->get();
        if ($Favorites->isEmpty()) {
            return response()->json(['result' => 'لا يوجد ']);
        } else {
            $data = [];
            foreach ($Favorites as $Favorite) {
                $houses = House::find($Favorite->HouseId);
                $houseData = [];
                $rooms = Room::where('HouseId', $houses->id)
                    ->where('RoomType', 'Primary')
                    ->get();
                $NumberOfRooms = $rooms->count();
                $availableRooms = 0;
                foreach ($rooms as $room) {
                    $availableRooms += PrimaryRoom::where('RoomId', $room->id)
                        ->whereRaw('BedNumber - BedNumberBooked > 0')
                        ->count();
                }
                $houseData = [
                    'HouseId' => $houses->id,
                    'HouseType' => $houses->HouseType,
                    'NumberOfRooms' => $NumberOfRooms,
                    'Address' => $houses->Address,
                    'Location' => $houses->Location,
                    'AvailableRoom' => $availableRooms,
                ];
                if ($availableRooms === 0) {
                    $houseData['message'] = 'العقار محجوز كامل';
                }
                // Name of HouseOwner :
                $user = User::find($houses->UserId);
                if ($user) {
                    $houseData['Name'] = $user->Name;
                }
                // Add HousePhoto based on gender
                $houseData['HousePhoto'] = $gender === 'ذكر' ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
                $Data[] = $houseData;
            }
            return response()->json(['result' => $Data]);
        }
    }
    public function FavoriteIcon(Request $request){
        $currentStudent = Auth::user();
        $UserId = $currentStudent->id;
        $HouseId = $request->HouseId;
        $Favorite = Favorite::where('UserId', $UserId)->where('HouseId', $HouseId)->first();
        if($Favorite){
            $Favorite->delete();
            return response()->json(['result' => 'تم الغاء الاعجاب']);
        }else{
            $Favorite = new Favorite();
            $Favorite->UserId = $UserId;
            $Favorite->HouseId = $HouseId;
            $Favorite->save();
            return response()->json(['result' => 'تم الاعجاب']);
        }
    }
}
