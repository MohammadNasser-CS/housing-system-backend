<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
class NotifiactionController extends Controller
{
    public function showNotification()
    {
        $currentStudent = Auth::user();
        $Name = $currentStudent->name;
        $UserId = $currentStudent->id;
        $notifications = Notification::where('userId', $UserId)->orderBy('created_at', 'desc')->get();
        if ($notifications->isEmpty()) {
            return response()->json(['result' => 'لا يوجد اشعارات']);
        } else {
            $data = [];
            foreach ($notifications as $notification) {
                $data[] = [
                    'name' => $Name,
                    'message' => $notification->notificationBody,
                ];
            }
            return response()->json(['result' => $data]);
        }
    }
    public function sendNotification()
    {
    }
}
