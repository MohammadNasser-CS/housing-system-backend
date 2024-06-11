<?php

namespace App\Http\Controllers\Student;

use App\Enum\RoomTypeEnum;
use App\Enum\UserGenderEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomPhoto;
use App\Models\PrimaryRoom;

class HouseDetailsController extends Controller
{
    public function houseDetails($RequestHouseId)
    {
        $houseId = $RequestHouseId;
        $house = House::find($houseId);
        // The Details from House :
        $houseData = [
            'description' => $house->description,
            'internet' => $house->internet,
            'water' => $house->water,
            'electricity' => $house->electricity,
            'gas' => $house->gas,
        ];
        // House's Photo
        $houseData['housePhoto'] = $house->gender === UserGenderEnum::MALE ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
        // HouseOwner Information :
        $user = User::find($house->userId);
        if ($user) {
            $houseData['name'] = $user->name;
            $houseData['phoneNumber'] = $user->phoneNumber;
        }
        $rooms = Room::where('houseId', $houseId)->get();
        $primaryRoomsData = [];
        $secondaryRoomsData = [];
        foreach ($rooms as $room) {
            if ($room->RoomType === '') {
                $primaryRoom = PrimaryRoom::where('roomId', $room->id)
                    ->whereRaw('bedNumber - bedNumberBooked > 0')
                    ->first();
                if ($primaryRoom) {
                    $primaryRoomsData[] = [
                        'roomId' => $room->id,
                        'photo' => url('storage/' . $room->roomPhotos->first()->photoUrl),
                    ];
                }
            } elseif ($room->roomType === RoomTypeEnum::secondaryRoom) {
                $secondaryRoomsData[] = [
                    'photo' => url('storage/' . $room->roomPhotos->first()->photoUrl),
                ];
            }
        }
        $houseData['primaryRooms'] = $primaryRoomsData;
        $houseData['secondaryRooms'] = $secondaryRoomsData;
        return response()->json(['result' => $houseData], 200);
    }
    public function RoomDetails($RoomIdRequest)
    {
        $RoomId = $RoomIdRequest;
        $Room = Room::find($RoomId);
        $primaryRoom = $Room->primaryRooms;
        $roomPhotos = $Room->roomPhotos->pluck('photoUrl');
        $data = [
            'avalabileBed' => $primaryRoom->bedNumber - $primaryRoom->bedNumberBooked,
            'roomSpace' => $primaryRoom->roomSpace,
            'balcony' => $primaryRoom->balcony,
            'desk' => $primaryRoom->desk,
            'ac' => $primaryRoom->ac,
            'price' => $primaryRoom->price,
            'roomPhotos' => $roomPhotos,
        ];
        return response()->json(['result' => $data], 200);
    }
}
