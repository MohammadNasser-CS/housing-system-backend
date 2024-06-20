<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\RoomPhoto;
use App\Models\PrimaryRoom;
use App\Models\ReservationRequest;

class MyRoom extends Controller
{
    public function getMyReservationRoom()
    {
        $currentStudentId = Auth::id();
        $reservation = Reservation::where('userId', $currentStudentId)->first();
        if ($reservation) {
            $room = $reservation->rooms;
            $house = $room->houses;
            $user = $house->users;
            $roomPhoto = RoomPhoto::where('roomId', $room->id)->first();
            $price = $room->primaryRooms->price;
            $availableBeds = $room->primaryRooms->bedNumber - $room->primaryRooms->bedNumberBooked;
            $price = $reservation->reservationType == 'تخت' ? $price / 2 : $price;
            $price = strval($price);
            $myRoom = [
                'reservationType' => $reservation->reservationType,
                'reservationEnd' => $reservation->reservationEnd,
                'houseOwnerName' => $user->name,
                'houseOwnerPhone' => $user->phoneNumber,
                'roomPhoto' => url('storage/' . $roomPhoto->photoUrl),
                'price' => strval($price),
                'roomSpace' => $room->primaryRooms->roomSpace,
                'availableBeds' =>(String) $availableBeds,
                'hasBalcony' => $room->primaryRooms->balcony,
                'hasDesk' => $room->primaryRooms->desk,
                'hasAc' => $room->primaryRooms->ac,
            ];
            return response()->json([
                'myRoom' => $myRoom,
            ]);
        } else {
            return response()->json([
                'myRoom' => null,
                'message' => 'لا يوجد',
            ]);
        }
    }
    public function getReservationRoomRequest()
    {
        $currentStudentId = Auth::id();
        $reservationRequests = ReservationRequest::where('studentId', $currentStudentId)->get();
        if ($reservationRequests->isEmpty()) {
            return response()->json(['requests' => null, 'message' => 'لا يوجد']);
        }
        $responseData = [];
        foreach ($reservationRequests as $request) {
            $responseData[] = [
                'requestId' => (string) $request->id,
                'requestStatus' => $request->requestStatus,
                'selectedDateTimeSlot' => $request->meetingDetails,
                'roomId' => (string) $request->roomId,
                'houseId' => (string) $request->rooms->houseId,
                'houseOwnerName' => $request->HouseOwner->name,
                'houseOwnerPhoneNumber' => $request->HouseOwner->phoneNumber,
            ];
        }
        return response()->json(['requests' => $responseData]);
    }
    public function cancelRequest($requestId)
    {
        $request = ReservationRequest::where('id', $requestId)->first();
        if ($request) {
            $request->delete();
            return response()->json(['message' => 'تم الحذف بنجاح ']);
        }
        return response()->json(['message' => 'لا يوجد طلب في هذا الرقم']);
    }
}
