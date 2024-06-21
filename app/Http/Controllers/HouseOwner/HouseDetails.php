<?php

namespace App\Http\Controllers\HouseOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use App\Enum\HouseGenderEnum;
use App\Models\Room;
use App\Models\User;
use App\Models\Reservation;
use App\Models\PrimaryRoom;
use App\Enum\RoomTypeEnum;
use Illuminate\Support\Facades\Auth;

class HouseDetails extends Controller
{
    public function getOwnerHouseDetails($houseId)
    {
        $house = House::find($houseId);
        if (!$house) {
            return response()->json(['message' => 'لا يوجد بيت بهذا الرقم'], 404);
        }
        // The Details from House :
        $houseData = [
            'houseId' => (string) $house->id,
            'description' => $house->description,
            'internet' => $house->internet,
            'water' => $house->water,
            'electricity' => $house->electricity,
            'gas' => $house->gas,
        ];
        // House's Photo
        $houseData['housePhoto'] = $house->gender === HouseGenderEnum::MALE->value ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
        // Information Rooms :
        $rooms = Room::where('houseId', $houseId)->get();
        $primaryRoomsData = [];
        $secondaryRoomsData = [];
        $reservationData = [];
        foreach ($rooms as $room) {
            if ($room->roomType === RoomTypeEnum::sleepRoom->value) {
                $primaryRoom = PrimaryRoom::where('roomId', $room->id)->first();
                if ($primaryRoom && $room->roomPhotos()->exists()) {
                    $roomPhoto = $room->roomPhotos->first();
                    if ($roomPhoto) {
                        $primaryRoomsData[] = [
                            'roomId' => (string) $room->id,
                            'photo' => url('storage/' . $roomPhoto->photoUrl),
                        ];
                    }
                }
                // Give information for student who Reservation this Room :
                $ReservationInformation = Reservation::where('roomId', $room->id)->get();
                if ($ReservationInformation) {
                    foreach ($ReservationInformation as $reservation) {
                        $user = User::where('id', $reservation->userId)->first();
                        if ($user) {
                            $reservationData[] = [
                                'roomId' => (string) $room->id,
                                'studentName' => $user->name,
                                'phoneNumber' => $user->phoneNumber,
                                'reservationEnd' => $reservation->reservationEnd,
                                'reservationType' => $reservation->reservationType,
                            ];
                        }
                    }
                }
            } elseif ($room->roomType === RoomTypeEnum::secondaryRoom->value && $room->roomPhotos()->exists()) {
                $roomPhoto = $room->roomPhotos->first();
                if ($roomPhoto) {
                    $secondaryRoomsData[] = [
                        'roomId' => (string) $room->id,
                        'photo' => url('storage/' . $roomPhoto->photoUrl),
                    ];
                }
            }
        }
        if ($reservationData === null || empty($reservationData)) {
            $houseData['reservationData'] = null;
        } else {
            $houseData['reservationData'] = $reservationData;
        }
        $houseData['primaryRooms'] = $primaryRoomsData;
        $houseData['secondaryRooms'] = $secondaryRoomsData;


        return response()->json(['data' => $houseData], 200);
    }
    public function getroomDetails($roomId)
    {
        // Get the Details for room With pictures :
        $Room = Room::find($roomId);
        if (!$Room) {
            return response()->json(['message' => 'لا يوجد غرفة بهذا الرقم'], 404);
        }
        $primaryRoom = $Room->primaryRooms;
        $roomPhotos = $Room->roomPhotos->pluck('photoUrl');
        $roomPhotos = $roomPhotos->map(function ($photoUrl) {
            return url('storage/' . $photoUrl);
        });
        $data = [
            'avalabileBed' => (string) ($primaryRoom->bedNumber - $primaryRoom->bedNumberBooked),
            'roomSpace' => (string) $primaryRoom->roomSpace,
            'balcony' => $primaryRoom->balcony,
            'desk' => $primaryRoom->desk,
            'ac' => $primaryRoom->ac,
            'price' => (string) $primaryRoom->price,
            'roomPhotos' => $roomPhotos,
        ];
        return response()->json(['result' => $data], 200);
    }
}
