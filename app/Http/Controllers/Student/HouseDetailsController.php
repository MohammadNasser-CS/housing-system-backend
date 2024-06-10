<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomPhoto;
use App\Models\PrimaryRoom;

class HouseDetailsController extends Controller
{
    public function HouseDetails($RequestHouseId)
    {
        $HouseId = $RequestHouseId;
        $house = House::find($HouseId);
        // The Details from House :
        $houseData = [
            'Description' => $house->Description,
            'Internet' => $house->Internet,
            'Water' => $house->Water,
            'Electricity' => $house->Electricity,
            'Gaz' => $house->Gaz,
        ];
        // House's Photo
        $houseData['HousePhoto'] = $house->Gender === 'ذكر' ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
        // HouseOwner Information :
        $user = User::find($house->UserId);
        if ($user) {
            $houseData['Name'] = $user->Name;
            $houseData['Phone'] = $user->Phone;
        }
        $rooms = Room::where('HouseId', $HouseId)->get();

        $primaryRoomsData = [];
        $secondaryRoomsData = [];
        foreach ($rooms as $room) {
            if ($room->RoomType === 'Primary') {
                $primaryRoom = PrimaryRoom::where('RoomId', $room->id)
                    ->whereRaw('BedNumber - BedNumberBooked > 0')
                    ->first();
                if ($primaryRoom) {
                    $primaryRoomsData[] = [
                        'RoomId' => $room->id,
                        'photo' => url('storage/' . $room->roomPhotos->first()->PhotoUrl),
                    ];
                }
            } elseif ($room->RoomType === 'Secondary') {
                $secondaryRoomsData[] = [
                    'photo' => url('storage/' . $room->roomPhotos->first()->PhotoUrl),
                ];
            }
        }
        $houseData['PrimaryRooms'] = $primaryRoomsData;
        $houseData['SecondaryRooms'] = $secondaryRoomsData;

        return response()->json(['result' => $houseData], 200);
    }
    public function RoomDetails($RoomIdRequest)
    {
        $RoomId = $RoomIdRequest;
        $Room = Room::find($RoomId);
        $primaryRoom = $Room->primaryRooms;
        $roomPhotos = $Room->roomPhotos->pluck('PhotoUrl');

        $data = [
            'AvalabileBed' => $primaryRoom->BedNumber - $primaryRoom->BedNumberBooked,
            'RoomSpace' => $primaryRoom->RoomSpace,
            'Balcony' => $primaryRoom->Balcony,
            'Desk' => $primaryRoom->Desk,
            'AC' => $primaryRoom->AC,
            'Price' => $primaryRoom->Price,
            'roomPhotos' => $roomPhotos,
        ];
        return response()->json(['result' => $data], 200);
    }
}
