<?php

namespace App\Http\Controllers\Student;

use App\Enum\HouseTypeEnum;
use App\Enum\RoomTypeEnum;
use App\Enum\UserGenderEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\PrimaryRoom;

class HomePageStudentController extends Controller
{
    private function getdata($houses, $gender, $message)
    {
        $Data = [];
        foreach ($houses as $house) {
            $houseData = [];
            // Number Of Room in House
            $rooms = Room::where('houseId', $house->id)
                ->where('roomType', RoomTypeEnum::sleepRoom)
                ->get();
            $numberOfRooms = $rooms->count();
            $availableRooms = 0;
            foreach ($rooms as $room) {
                $availableRooms += PrimaryRoom::where('roomId', $room->id)
                    ->whereRaw('bedNumber - bedNumberBooked > 0')
                    ->count();
            }
            // If availableRooms is not zero and the gender matches, then add houseData to $Data
            if ($availableRooms > 0 && $house->gender === $gender) {
                $houseData = [
                    'houseId' => $house->id,
                    'houseType' => $house->houseType,
                    'numberOfRooms' => $numberOfRooms,
                    'address' => $house->address,
                    'location' => $house->location,
                    'availableRoom' => $availableRooms,
                ];
                // Name of HouseOwner :
                $user = User::find($house->userId);
                if ($user) {
                    $houseData['name'] = $user->name;
                }
                // Add HousePhoto based on gender
                $houseData['housePhoto'] = $gender === UserGenderEnum::MALE ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
                $Data[] = $houseData;
            } else {
                return response()->json(['result' => $message], 200);
            }
        }
        return $Data;
    }
    public function printHouse()
    {
        $currentStudent = Auth::user();
        $gender = $currentStudent->gender;
        $houses = House::where('gender', $gender)->get();
        if ($houses->isEmpty()) {
            return response()->json(['message' => 'لا يوجد'], 404);
        }
        return $this->getdata($houses, $gender, 'لا يوجد سكنات متوفره');
    }
    public function showApartments()
    {
        $currentStudent = Auth::user();
        $gender = $currentStudent->gender;
        $houses = House::where('gender', $gender)->where('houseType', HouseTypeEnum::Apartment)->get();
        if ($houses->isEmpty()) {
            return response()->json(['message' => 'لا يوجد'], 404);
        }
        return $this->getdata($houses, $gender, 'لا يوجد شقق متوفره ');
    }
    public function showStudios()
    {
        $currentStudent = Auth::user();
        $gender = $currentStudent->gender;
        $houses = House::where('gender', $gender)->where('houseType', HouseTypeEnum::Studio)->get();
        if ($houses->isEmpty()) {
            return response()->json(['message' => 'لا يوجد'], 404);
        }
        return $this->getdata($houses, $gender, 'لا يوجد استديوهات متوفره');
    }
    public function searchFieldPost(Request $request)
    {
        $currentStudent = Auth::user();
        $gender = $currentStudent->gender;
        $id = $request->input('id');
        $house = House::find($id);
        if (!$house) {
            return response()->json(['message' => 'لا يوجد بيت بهذاالرقم'], 404);
        }
        if ($house->gender !== $gender) {
            if ($gender === UserGenderEnum::FEMALE) {
                return response()->json(['message' => 'هذا سكن طلاب '], 403);
            } else {
                return response()->json(['message' => 'هذا سكن طالبات'], 403);
            }
        }
        $rooms = Room::where('houseId', $house->id)
            ->where('roomType', RoomTypeEnum::sleepRoom)
            ->get();
        $numberOfRooms = $rooms->count();
        $availableRooms = 0;
        foreach ($rooms as $room) {
            $availableRooms += PrimaryRoom::where('roomId', $room->id)
                ->whereRaw('bedNumber - bedNumberBooked > 0')
                ->count();
        }
        if ($availableRooms == 0) {
            return response()->json(['message' => 'محجوز'], 200);
        }
        $houseData = [
            'houseType' => $house->houseType,
            'address' => $house->address,
            'location' => $house->location,
            'numberOfRooms' => $numberOfRooms,
            'availableRooms' => $availableRooms,
        ];
        $user = User::find($house->userId);
        if ($user) {
            $houseData['name'] = $user->name;
        }
        $houseData['housePhoto'] = $gender === UserGenderEnum::MALE ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
        return response()->json(['result' => $houseData], 200);
    }
    public function searchFieldGet($id)
    {
        $currentStudent = Auth::user();
        $gender = $currentStudent->gender;
        $house = House::find($id);
        if (!$house) {
            return response()->json(['message' => 'لا يوجد بيت بهذا الرقم'], 404);
        }
        if ($house->gender !== $gender) {
            if ($gender === UserGenderEnum::FEMALE) {
                return response()->json(['message' => 'هذا سكن طلاب '], 403);
            } else {
                return response()->json(['message' => 'هذا سكن طالبات'], 403);
            }
        }
        $rooms = Room::where('houseId', $house->id)
            ->where('roomType', RoomTypeEnum::sleepRoom)
            ->get();
        $availableRooms = 0;
        foreach ($rooms as $room) {
            $availableRooms += PrimaryRoom::where('roomId', $room->id)
                ->whereRaw('bedNumber - bedNumberBooked > 0')
                ->count();
        }
        if ($availableRooms == 0) {
            return response()->json(['message' => 'محجوز'], 200);
        }
        $houseData = [
            'houseType' => $house->houseType,
            'address' => $house->address,
            'location' => $house->location,
            'numberOfRooms' => $rooms->count(),
            'availableRooms' => $availableRooms,
        ];
        $user = User::find($house->userId);
        $houseData['name'] = $user ? $user->name : 'unknown';
        $houseData['housePhoto'] = $gender === UserGenderEnum::MALE ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
        return response()->json(['result' => $houseData], 200);
    }
}
