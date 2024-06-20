<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HouseOwner;
use App\Enum\AccountStatusEnum;
use App\Enum\UserRoleEnum;

class AcceptHouseOwner extends Controller
{
    public function getHouseOwnerRequest()
    {
        $houseOwners = User::where('role', UserRoleEnum::OWNER->value)
            ->where('accountStatus', AccountStatusEnum::notActive->value)
            ->get();

        $Data = [];
        if (!$houseOwners->isEmpty()) {
            foreach ($houseOwners as $houseOwner) {
                $RoyaltyPhotoPath = HouseOwner::where('userId', $houseOwner->id)
                    ->pluck('royaltyPhoto')
                    ->first();
                $ownerData = [
                    'ownerId' => $houseOwner->id,
                    'name' => $houseOwner->name,
                    'phoneNumber' => $houseOwner->phoneNumber,
                ];
                if ($RoyaltyPhotoPath) {
                    $ownerData['royaltyPhoto'] = url('storage/' . $RoyaltyPhotoPath);
                } else {
                    $ownerData['royaltyPhoto'] = 'لا يوجد';
                }
                $Data[] = $ownerData;
            }
            return response()->json(['houseOwners' => $Data], 200);
        } else {
            return response()->json(['message' => 'لا يوجد طلبات'], 401);
        }
    }
    public function acceptHouseOwner($ownerId)
    {
        $owner = User::find($ownerId);
        if ($owner) {
            $owner->accountStatus = AccountStatusEnum::active->value;
            $owner->save();
            return response()->json(['message' => 'تم قبول صاحب السكن '], 200);
        } else {
            return response()->json(['message' => 'لا يوجد حساب في هذا الرقم'], 404);
        }
    }
    public function rejectHouseOwner($ownerId)
    {
        $owner = User::find($ownerId);
        if ($owner) {
            $owner->delete();
            return response()->json(['message' => 'تم الرفض'], 200);
        } else {
            return response()->json(['message' => 'لا يوجد حساب في هذا الرقم '], 404);
        }
    }
}
