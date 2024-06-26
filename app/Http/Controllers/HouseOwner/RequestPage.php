<?php

namespace App\Http\Controllers\HouseOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservationRequest;
use App\Enum\RequestStatusEnum;
use Illuminate\Support\Facades\Auth;

class RequestPage extends Controller
{
    public function getHouseOwnerRequests()
    {
        $houseOwnerId = Auth::id();
        $reservationRequests = ReservationRequest::where('houseOwnerId', $houseOwnerId)
            ->where('requestStatus', '!=', RequestStatusEnum::done->value)
            ->get();
        if ($reservationRequests->isEmpty()) {
            return response()->json(['message' => 'لا يوجد']);
        }
        $data = [];
        foreach ($reservationRequests as $request) {
            $data[] = [
                'requestId' => (string) $request->id,
                'requestStatus' => $request->requestStatus,
                'selectedDateTimeSlot' => $request->meetingDetails,
                'roomId' => "$request->roomId",
                'houseId' => (string)$request->rooms->houseId,
                'studentName' => $request->Student->name,
                'studentPhoneNumber' => $request->Student->phoneNumber,
            ];
        }
        return response()->json(['requests' => $data]);
    }
    public function rejectRequestHouseOwenr($RequestId)
    {
        $reservationRequest = ReservationRequest::where('id', $RequestId)->first();
        if ($reservationRequest) {
            $reservationRequest->delete();
            return response()->json(['message' => 'تم الحذف بنجاح ']);
        }
        return response()->json(['message' => 'لا يوجد طلب في هذا الرقم']);
    }
    public function confirmAppointment($RequestId)
    {
        $reservationRequest = ReservationRequest::find($RequestId);
        if (!$reservationRequest) {
            return response()->json(['error' => 'طلب الحجز غير موجود'], 404);
        }
        $reservationRequest->requestStatus = RequestStatusEnum::confirmed->value;
        $reservationRequest->save();
        return response()->json(['message' => 'تم تأكيد الموعد '], 200);
    }
}
