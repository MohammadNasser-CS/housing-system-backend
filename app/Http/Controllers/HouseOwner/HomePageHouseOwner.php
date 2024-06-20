<?php

namespace App\Http\Controllers\HouseOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enum\FlagEnum;
use App\Models\HouseOwner;
use App\Models\House;
use App\Models\Room;
use App\Models\PrimaryRoom;
use App\Enum\HouseGenderEnum;
use App\Enum\RoomTypeEnum;
use App\Models\AvailableTimes;
use Illuminate\Support\Facades\Auth;

class HomePageHouseOwner extends Controller
{
    public function AddtimeSlotsAvailable(Request $request)
    {
        $houseOwnerId = Auth::id();
        $houseOwnerId = HouseOwner::where('userId', $houseOwnerId)->value('id');
        $data = $request->input('Data');

        if ($data) {
            AvailableTimes::where('houseOwnerId', $houseOwnerId)->delete();
            foreach ($data as $item) {
                $dayName = $item['dayName'];
                $startTime = $item['startTime'];
                $endTime = $item['endTime'];
                $startHour = (int) date('H', strtotime($startTime));
                $endHour = (int) date('H', strtotime($endTime));
                for ($hour = $startHour; $hour < $endHour; $hour++) {
                    $Start = sprintf('%2d', $hour);
                    $End = sprintf('%2d', $hour + 1);
                    $Start = $Start > 12 ? $Start - 12 . ' م' : $Start . ' ص';
                    $End = $End > 12 ? $End - 12 . ' م' : $End . ' ص';

                    $availableTime = "$dayName: $Start - $End";
                    $availableTimeRecord = new AvailableTimes();
                    $availableTimeRecord->houseOwnerId = "$houseOwnerId";
                    $availableTimeRecord->status = FlagEnum::no->value;
                    $availableTimeRecord->timeSlot = $availableTime;
                    $availableTimeRecord->save();
                }
            }
            return response()->json(['message' => 'تم إضافة أوقات فراغك']);
        }
        return response()->json(['message' => 'لا توجد بيانات']);
    }
    public function getAllHousesHouseOwner()
    {
        $houseOwnerId = Auth::id();
        $houseOwnerName = Auth::user()->name;
        $houses = House::where('userId', $houseOwnerId)->get();
        if ($houses->isEmpty()) {
            return response()->json(['message' => 'لا يوجد'], 404);
        }
        $Data = [];
        foreach ($houses as $house) {
            $houseData = [];
            $rooms = Room::where('houseId', $house->id)
                ->where('roomType', RoomTypeEnum::sleepRoom->value)
                ->get();
            $numberOfRooms = $rooms->count();
            $availableRooms = 0;
            foreach ($rooms as $room) {
                $availableRooms += PrimaryRoom::where('roomId', $room->id)
                    ->whereRaw('bedNumber - bedNumberBooked > 0')
                    ->count();
            }
            $houseData = [
                'houseId' => "$house->id",
                'houseType' => $house->houseType,
                'numberOfRooms' => "$numberOfRooms",
                'address' => $house->address,
                'location' => $house->location,
                'availableRoom' => "$availableRooms",
                'ownername' => $houseOwnerName,
            ];
            $houseData['housePhoto'] = $house->gender === HouseGenderEnum::MALE->value ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
            $Data[] = $houseData;
        }
        return response()->json(['result' => $Data], 200);
    }
    public function getSearchHouse($HouseId)
    {
        $houseOwnerId = Auth::id();
        $houseOwnerName = Auth::user()->name;
        $house = House::find($HouseId);
        if (!$house || $house->userId !== $houseOwnerId) {
            return response()->json(['error' => 'لا يوجد لك بيت في هذا الرقم'], 404);
        }
        $houseData = [];
        $rooms = Room::where('houseId', $house->id)
            ->where('roomType', RoomTypeEnum::sleepRoom->value)
            ->get();
        $numberOfRooms = $rooms->count();
        $availableRooms = 0;
        $houseData = [
            'houseId' => "$house->id",
            'houseType' => $house->houseType,
            'numberOfRooms' => "$numberOfRooms",
            'address' => $house->address,
            'location' => $house->location,
            'availableRoom' => "$availableRooms",
            'ownername' => $houseOwnerName,
        ];
        $houseData['housePhoto'] = $house->gender === HouseGenderEnum::MALE->value ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
        return response()->json(['result' => $houseData], 200);
    }
}
