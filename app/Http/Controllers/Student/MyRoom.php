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
    public function myReservationRoom()
    {
        $currentStudentId = Auth::id();
        $reservation = Reservation::where('userId', $currentStudentId)->first();
        if ($reservation) {
            $room = $reservation->rooms;
            $house = $room->houses;
            $user = $house->users;
            $roomPhoto = RoomPhoto::where('roomId', $room->id)->first();
            $price = $room->primaryRooms->price;
            $price = $reservation->reservationType == 'تخت' ? $price / 2 : $price;
            $price = strval($price);

            return response()->json([
                'reservationType' => $reservation->reservationType,
                'reservationEnd' => $reservation->reservationEnd,
                'houseOwnerName' => $user->name,
                'houseOwnerPhone' => $user->phoneNumber,
                'roomPhoto' => url('storage/' . $roomPhoto->photoUrl),
                'price' => strval($price),
            ]);
        } else {
            return response()->json([
                'message' => 'لا يوجد',
            ]);
        }
    }
    public function RequestPageStudent()
    {
        $currentStudentId = Auth::id();
        $reservationRequests = ReservationRequest::where('studentId', $currentStudentId)->get();
        if ($reservationRequests->isEmpty()) {
            return response()->json(['message' => 'لا يوجد']);
        }
        $responseData = [];
        foreach ($reservationRequests as $request) {
            $responseData[] = [
                'RequestId' => $request->id,
                'requestStatus' => $request->requestStatus,
                'meetingDetails' => $request->meetingDetails,
                'roomId' => $request->roomId,
                'houseId' => $request->rooms->houseId,
                'houseOwnerName' => $request->HouseOwner->name,
                'houseOwnerPhoneNumber' => $request->HouseOwner->phoneNumber,
            ];
        }
        return response()->json($responseData);
    }
    public function deleteRequest($RequestId)
    {
        $currentStudentId = Auth::id();
        $request = ReservationRequest::where('id', $RequestId)->where('studentId', $currentStudentId)->first();
        $request->delete();
        return response()->json(['message' => 'تم الحذف بنجاح ']);
    }
}
