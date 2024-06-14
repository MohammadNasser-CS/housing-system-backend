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
        $newName = $request->input('name', $oldName); // Default to current name if not provided
        $newPhone = $request->input('phoneNumber', $oldPhone); // Default to current phoneNumber if not provided
        $newEmail = $request->input('email', $oldEmail); // Default to current email if not provided

        $nameHasChanged = $newName !== $oldName;
        $phoneHasChanged = $newPhone !== $oldPhone;
        $emailHasChanged = $newEmail !== $oldEmail;
        // Check if any of the fields have changed


        if (!($nameHasChanged && $phoneHasChanged && $emailHasChanged)) {
            return response()->json(['message' => 'No updates provided'], 422);
        }

        // Check if the new email or phone number already exists for another user
        if ($phoneHasChanged) {
            $existingPhone = User::where('phoneNumber', $newPhone)
                ->where('id', '!=', $user->id)
                ->first();
            if ($existingPhone) {
                return response()->json(['message' => 'Phone number is already in use'], 422);
            } else {
                $user->phoneNumber = $newPhone;
                $user->save();
                return response()->json(['message' => 'User information updated successfully'], 200);
            }
        }
        if ($emailHasChanged) {
            $existingEmail = User::where('email', $newEmail)
                ->where('id', '!=', $user->id)
                ->first();
            if ($existingEmail) {
                return response()->json(['message' => 'Email is already in use'], 422);
            } else {
                $user->email = $newEmail;
                $user->save();
                return response()->json(['message' => 'User information updated successfully'], 200);
            }
        }
        if ($nameHasChanged) {
            $user->name = $newName;
            $user->save();
            return response()->json(['message' => 'User information updated successfully'], 200);
        }
    }
}
