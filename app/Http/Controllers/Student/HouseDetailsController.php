<?php

namespace App\Http\Controllers\Student;

use App\Enum\RoomTypeEnum;
use App\Enum\HouseGenderEnum;
use App\Enum\RequestStatusEnum;
use App\Enum\FlagEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\User;
use App\Models\Room;
use App\Models\PrimaryRoom;
use App\Models\AvailableTimes;
use App\Models\Favorite;
use App\Models\HouseOwner;
use App\Models\ReservationRequest;
use Illuminate\Support\Facades\Auth;

class HouseDetailsController extends Controller
{


    public function gethouseDetails($houseId)
    {
        $house = House::find($houseId);

        if (!$house) {
            return response()->json(['message' => 'House not found'], 404);
        }

        // The Details from House:
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

        // House Owner Information:
        $user = User::find($house->userId);
        if ($user) {
            $houseData['ownerName'] = $user->name;
            $houseData['phoneNumber'] = $user->phoneNumber;
        }
        $currentStudent = Auth::user();
        $favorite = Favorite::where('userId', $currentStudent->id)
            ->where('houseId', $house->id)
            ->first();
        $houseData['isFavorite'] = $favorite ? true : false;
        $rooms = Room::where('houseId', $houseId)->get();
        $primaryRoomsData = [];
        $secondaryRoomsData = [];
        foreach ($rooms as $room) {
            if ($room->roomType === RoomTypeEnum::sleepRoom->value) {
                $primaryRoom = PrimaryRoom::where('roomId', $room->id)
                    ->whereRaw('bedNumber - bedNumberBooked > 0')
                    ->first();
                if ($primaryRoom && $room->roomPhotos()->exists()) {
                    $roomPhoto = $room->roomPhotos->first();
                    if ($roomPhoto) {
                        $primaryRoomsData[] = [
                            'roomId' => (string) $room->id,
                            // url('storage/Photos/boy_house.png')
                            'photo' => url('storage/' . $roomPhoto->photoUrl),
                        ];
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
        $houseData['primaryRooms'] = $primaryRoomsData;
        $houseData['secondaryRooms'] = $secondaryRoomsData;

        return response()->json(['data' => $houseData], 200);
    }

    public function getRoomDetails($roomId)
    {
        // Get the Details for room With picture .
        $Room = Room::find($roomId);
        $primaryRoom = $Room->primaryRooms;
        $roomPhotos = $Room->roomPhotos->pluck('photoUrl')->take(3);
        $roomPhotos = $roomPhotos->map(function ($photoUrl) {
            return url('storage/' . $photoUrl);
        });
        // Get the Avalabile time for HouseOwner :
        $House = House::find($Room->houseId);
        $houseOwner = HouseOwner::where('userId', $House->userId)->first();
        $availableTimes = AvailableTimes::where('houseOwnerId', $houseOwner->id)
            ->where('status', FlagEnum::no->value)->select('id as slotId', 'timeSlot')
            ->get();
        $data = [
            'avalabileBed' => $primaryRoom->bedNumber - $primaryRoom->bedNumberBooked,
            'roomSpace' => $primaryRoom->roomSpace,
            'balcony' => $primaryRoom->balcony,
            'desk' => $primaryRoom->desk,
            'ac' => $primaryRoom->ac,
            'price' => $primaryRoom->price,
            'roomPhotos' => $roomPhotos,
            'roomId' => $roomId,
            'availableTimes' => $availableTimes,
        ];
        return response()->json(['result' => $data], 200);
    }
    public function requestReservation(Request $request)
    {
        // Student Id :
        $currentStudentId = Auth::id();
        // Room Id :
        $roomId = $request->input('roomId');
        //  meetingDetails ( Day & time ) :
        $timeSlotId = (int)$request->input('timeSlotId');
        // houseOwner Id :
        $room = Room::find($roomId);
        $houseOwnerId = $room->houses->userId;

        $meetingDetails = AvailableTimes::where('id', $timeSlotId)
            ->first();

        if ($meetingDetails == null) {
            return response()->json(['error' => 'هذا غير متاح لصاحب السكن']);
        } else  if ($meetingDetails->status == FlagEnum::yes->value) {
            return response()->json(['error' => 'هذا الموعد محجوز لشخص آخر']);
        }

        $existingRequest = ReservationRequest::where('studentId', $currentStudentId)
            ->where('roomId', $roomId)
            ->where('requestStatus', RequestStatusEnum::waiting->value)
            ->first();
        if ($existingRequest) {
            return response()->json(['error' => 'تم بالفعل إرسال طلب الحجز لهذه الغرفة'], 400);
        }
        $existingTime = ReservationRequest::where('studentId', $currentStudentId)
            ->where('requestStatus', RequestStatusEnum::waiting->value)
            ->first();
        if ($existingTime) {
            return response()->json(['error' => 'يوجد لك حجز في هذا الوقت في غرفة اخرى'], 400);
        }
        $meetingDetails->status = FlagEnum::yes->value;
        $reservationRequest = new ReservationRequest();
        $reservationRequest->studentId = $currentStudentId;
        $reservationRequest->roomId = $roomId;
        $reservationRequest->timeSlotId = $timeSlotId;
        $reservationRequest->meetingDetails = $meetingDetails->timeSlot;
        $reservationRequest->houseOwnerId = $houseOwnerId;
        $reservationRequest->requestStatus = RequestStatusEnum::waiting->value;
        $reservationRequest->save();
        return response()->json(['result' => $reservationRequest, 'message' => 'تم حجز الطلب']);
    }
}
