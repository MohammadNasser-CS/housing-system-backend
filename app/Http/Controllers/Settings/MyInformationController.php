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
        $newName = $request->input('name', $oldName);
        $newPhone = $request->input('phoneNumber', $oldPhone);
        $newEmail = $request->input('email', $oldEmail);

        $nameHasChanged = $newName !== $oldName;
        $phoneHasChanged = $newPhone !== $oldPhone;
        $emailHasChanged = $newEmail !== $oldEmail;

        // Check if any of the fields have changed
        if (!($nameHasChanged || $phoneHasChanged || $emailHasChanged)) {
            return response()->json(['message' => 'لم تقم بأي تعديل'], 422);
        }

        // Initialize an array to hold update messages
        $updateMessages = [];

        // Check if the new email or phone number already exists for another user
        if ($phoneHasChanged) {
            $existingPhone = User::where('phoneNumber', $newPhone)
                ->where('id', '!=', $user->id)
                ->first();
            if ($existingPhone) {
                return response()->json(['message' => 'رقم الهاتف مستخدم من قبل مستخدم آخر'], 422);
            } else {
                $user->phoneNumber = $newPhone;
                $updateMessages[] = 'تم تحديث رقم الهاتف بنجاح';
            }
        }

        if ($emailHasChanged) {
            $existingEmail = User::where('email', $newEmail)
                ->where('id', '!=', $user->id)
                ->first();
            if ($existingEmail) {
                return response()->json(['message' => 'البريد الإلكتروني مستخدم من قبل مستخدم آخر'], 422);
            } else {
                $user->email = $newEmail;
                $updateMessages[] = 'تم تحديث البريد الإلكتروني بنجاح';
            }
        }

        if ($nameHasChanged) {
            $user->name = $newName;
            $updateMessages[] = 'تم تحديث الإسم بنجاح';
        }

        // Save the updated user information
        $user->save();

        // Return the update messages
        return response()->json(['message' => implode(', ', $updateMessages)], 200);
    }
}
