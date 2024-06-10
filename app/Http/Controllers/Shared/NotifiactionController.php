<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
class NotifiactionController extends Controller
{
    public function ShowNotification()
    {
        $currentStudent = Auth::user();
        $Name = $currentStudent->Name;
        $UserId = $currentStudent->id;
        $notifications = Notification::where('UserId', $UserId)->orderBy('created_at', 'desc')->get();
        if ($notifications->isEmpty()) {
            return response()->json(['result' => 'لا يوجد اشعارات']);
        } else {
            $data = [];
            foreach ($notifications as $notification) {
                $data[] = [
                    'Name' => $Name,
                    'message' => $notification->NotificationBody,
                ];
            }
            return response()->json(['result' => $data]);
        }
    }
    public function SendNotification()
    {
    }
}
