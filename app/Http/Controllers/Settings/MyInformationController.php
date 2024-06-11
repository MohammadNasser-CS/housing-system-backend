<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserInformationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MyInformationController extends Controller
{
    public function showMyInformation()
    {
        $user = Auth::user();
        if ($user) {
            $name = $user->name;
            $phoneNumber = $user->phoneNumber;
            $email = $user->email;
            return response()->json(
                [
                    'name' => $name,
                    'phoneNumber' => $phoneNumber,
                    'email' => $email,
                ],
                200,
            );
        }
    }
    public function updateMyInformation(UpdateUserInformationRequest $request)
    {
        $user = Auth::user();
        // The Old Information for User :
        $oldName = $user->name;
        $oldPhone = $user->phoneNumber;
        $oldEmail = $user->email;
        // The New Information for User (get from Request if Changed) :
        $newName = $request->input('name');
        $newPhone = $request->input('phoneNumber');
        $newEmail = $request->input('email');

        if($newEmail === $oldEmail && $newName === $oldName && $newPhone == $oldPhone){
            return response()->json(['message' => 'لم تقم أي تحديث جديد'], 422);
        }

        // Check The Email or Phone is Exist or not from Another User
        $ExistingPhone = User::where('phoneNumber', $newPhone)->where('id', '!=', $user->id)->first();
        $ExistingEmail = User::where('email', $newEmail)->where('id', '!=', $user->id)->first();
        if ($ExistingPhone) {
            return response()->json(['message' => 'رقم الهاتف مستخدم '], 422);
        }
        if ($ExistingEmail) {
            return response()->json(['message' => 'البريد الإلكتروني مستخدم'], 422);
        }

        // Check if Has Change :
        $user->name = $newName ?? $oldName;
        $user->phoneNumber = $newPhone ?? $oldPhone;
        $user->email = $newEmail ?? $oldEmail;
        $user->save();
        return response()->json(['message' => 'تم تحديث المعلومات بنجاح'], 200);
    }
}
