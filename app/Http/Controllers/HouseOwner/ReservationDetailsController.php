<?php

namespace App\Http\Controllers\HouseOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservationRequest;
use App\Models\Reservation;
use App\Models\PrimaryRoom;
use App\Enum\RequestStatusEnum;
use Illuminate\Support\Facades\Auth;

class ReservationDetailsController extends Controller
{
    // بعد اللقاء وبدو يحجزلو الغرفة
    public function acceptRoomReservationRequest(Request $request)
    {
        $request->validate([
            'requestId' => 'required|integer',
            'reservationDate' => 'required|string|max:255',
            'reservationEnd' => 'required|string|max:255',
            'reservationType' => 'required|string|max:255',
        ]);
        $reservationRequest = ReservationRequest::find($request['requestId']);
        if (!$reservationRequest) {
            return response()->json(['message' => 'طلب الحجز بهذا الرقم غير موجود'], 404);
        }
        $reservationRequest->requestStatus = RequestStatusEnum::done->value;
        $studentId = $reservationRequest->studentId;
        $roomId = $reservationRequest->roomId;

        $reservation = new Reservation();
        $reservation->roomId = $roomId;
        $reservation->userId = $studentId;
        $reservation->reservationDate = $request['reservationDate'];
        $reservation->reservationEnd = $request['reservationEnd'];
        $reservation->reservationType = $request['reservationType'];

        $primaryRoom = PrimaryRoom::where('roomId', $roomId)->first();
        if ($request['reservationType'] !== 'تخت' && (($primaryRoom->bedNumber - $primaryRoom->bedNumberBooked) === $primaryRoom->bedNumber)) {
            $primaryRoom->bedNumberBooked = $primaryRoom->bedNumber;
        } elseif ($request['reservationType'] === 'تخت' && ($primaryRoom->bedNumberBooked !== $primaryRoom->bedNumber)) {
            $primaryRoom->bedNumberBooked = $primaryRoom->bedNumberBooked + 1;
        } else {
            return response()->json(['message' => 'لقد تم مسبقا حجز هذه الغرفة'], 401);
        }
        $primaryRoom->save();
        $reservation->save();
        $reservationRequest->save();

        return response()->json(['message' => 'تم الحجز بنجاح'], 201);
    }
    // بدو يجدد الحجز
    public function updateRoomReservation(Request $request)
    {
        $request->validate([
            'studentId' => 'required|integer',
            'reservationEnd' => 'required|string|max:255',
        ]);

        $reservation = Reservation::where('userId', $request['studentId'])->first();
        if (!$reservation) {
            return response()->json(['message' => 'لا يوجد حجز لهذا المستخدم'], 401);
        }
        $reservation->reservationEnd = $request['reservationEnd'];
        $reservation->save();

        return response()->json(['message' => 'تم تمديد الحجز بنجاح'], 200);
    }
    // اذا حاجز وبدو يحذف ما بدو يجدد
    public function finishRoomReservation($studentId)
    {
        $reservation = Reservation::where('userId', $studentId)->first();
        if (!$reservation) {
            return response()->json(['message' => 'لا يوجد حجز لهذا المستخدم'], 401);
        }
        $roomId = $reservation->roomId;
        $reservationType = $reservation->reservationType;
        $primaryRoom = PrimaryRoom::where('roomId', $roomId)->first();

        $primaryRoom->bedNumberBooked = $reservationType === 'تخت' ? $primaryRoom->bedNumberBooked - 1 : 0;

        $primaryRoom->save();
        $reservation->delete();
        return response()->json(['message' => 'تم الغاء الحجز'], 200);
    }
    // بعد اللقاء اذا ما بدو يحجزلو
    // in requestpage controller : RejectRequestHouseOwenr
}
