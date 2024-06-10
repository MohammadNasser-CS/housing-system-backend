<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserInformationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MyInformationController extends Controller
{
    public function ShowMyInformation()
    {
        $user = Auth::user();
        if ($user) {
            $Name = $user->Name;
            $Phone = $user->Phone;
            $Email = $user->Email;
            return response()->json(
                [
                    'Name' => $Name,
                    'Phone' => $Phone,
                    'Email' => $Email,
                ],
                200,
            );
        }
    }
    public function UpdateMyInformation(UpdateUserInformationRequest $request)
    {
        $user = Auth::user();
        // The Old Information for User :
        $oldName = $user->Name;
        $oldPhone = $user->Phone;
        $oldEmail = $user->Email;
        // The New Information for User (get from Request if Changed) :
        $newName = $request->input('Name');
        $newPhone = $request->input('Phone');
        $newEmail = $request->input('Email');

        if($newEmail === $oldEmail && $newName === $oldName && $newPhone == $oldPhone){
            return response()->json(['message' => 'لم تقم أي تحديث جديد'], 422);
        }

        // Check The Email or Phone is Exist or not from Another User
        $ExistingPhone = User::where('Phone', $newPhone)->where('id', '!=', $user->id)->first();
        $ExistingEmail = User::where('Email', $newEmail)->where('id', '!=', $user->id)->first();
        if ($ExistingPhone) {
            return response()->json(['message' => 'رقم الهاتف مستخدم '], 422);
        }
        if ($ExistingEmail) {
            return response()->json(['message' => 'البريد الإلكتروني مستخدم'], 422);
        }

        // Check if Has Change :
        $user->Name = $newName ?? $oldName;
        $user->Phone = $newPhone ?? $oldPhone;
        $user->Email = $newEmail ?? $oldEmail;
        $user->save();
        return response()->json(['message' => 'تم تحديث المعلومات بنجاح'], 200);
    }
}
