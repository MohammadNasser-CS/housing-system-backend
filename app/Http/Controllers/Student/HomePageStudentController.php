<?php

namespace App\Http\Controllers\Student;

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
            $rooms = Room::where('HouseId', $house->id)
                ->where('RoomType', 'Primary')
                ->get();
            $NumberOfRooms = $rooms->count();
            $availableRooms = 0;
            foreach ($rooms as $room) {
                $availableRooms += PrimaryRoom::where('RoomId', $room->id)
                    ->whereRaw('BedNumber - BedNumberBooked > 0')
                    ->count();
            }
            // If availableRooms is not zero and the gender matches, then add houseData to $Data
            if ($availableRooms > 0 && $house->Gender === $gender) {
                $houseData = [
                    'HouseId' => $house->id,
                    'HouseType' => $house->HouseType,
                    'NumberOfRooms' => $NumberOfRooms,
                    'Address' => $house->Address,
                    'Location' => $house->Location,
                    'AvailableRoom' => $availableRooms,
                ];
                // Name of HouseOwner :
                $user = User::find($house->UserId);
                if ($user) {
                    $houseData['Name'] = $user->Name;
                }
                // Add HousePhoto based on gender
                $houseData['HousePhoto'] = $gender === 'ذكر' ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
                $Data[] = $houseData;
            } else {
                return response()->json(['result' => $message], 200);
            }
        }
        return $Data;
    }
    public function PrintHouse()
    {
        $currentStudent = Auth::user();
        $gender = $currentStudent->Gender;
        $houses = House::where('Gender', $gender)->get();
        if ($houses->isEmpty()) {
            return response()->json(['message' => 'لا يوجد'], 404);
        }
        return $this->getdata($houses, $gender, 'لا يوجد سكنات متوفره');
    }
    public function ShowApartments()
    {
        $currentStudent = Auth::user();
        $gender = $currentStudent->Gender;
        $houses = House::where('Gender', $gender)->where('HouseType', 'شقة')->get();
        if ($houses->isEmpty()) {
            return response()->json(['message' => 'لا يوجد'], 404);
        }
        return $this->getdata($houses, $gender, 'لا يوجد شقق متوفره ');
    }
    public function ShowStudios()
    {
        $currentStudent = Auth::user();
        $gender = $currentStudent->Gender;
        $houses = House::where('Gender', $gender)->where('HouseType', 'استديو')->get();
        if ($houses->isEmpty()) {
            return response()->json(['message' => 'لا يوجد'], 404);
        }
        return $this->getdata($houses, $gender, 'لا يوجد استديوهات متوفره');
    }
    public function SearchFieldPost(Request $request)
    {
        $currentStudent = Auth::user();
        $gender = $currentStudent->Gender;
        $id = $request->input('id');
        $house = House::find($id);
        if (!$house) {
            return response()->json(['message' => 'لا يوجد بيت بهذاالرقم'], 404);
        }
        if ($house->Gender !== $gender) {
            if ($gender === 'أنثى') {
                return response()->json(['message' => 'هذا سكن طلاب '], 403);
            } else {
                return response()->json(['message' => 'هذا سكن طالبات'], 403);
            }
        }
        $rooms = Room::where('HouseId', $house->id)
            ->where('RoomType', 'Primary')
            ->get();
        $NumberOfRooms = $rooms->count();
        $AvailableRooms = 0;
        foreach ($rooms as $room) {
            $AvailableRooms += PrimaryRoom::where('RoomId', $room->id)
                ->whereRaw('BedNumber - BedNumberBooked > 0')
                ->count();
        }
        if ($AvailableRooms == 0) {
            return response()->json(['message' => 'محجوز'], 200);
        }
        $houseData = [
            'HouseType' => $house->HouseType,
            'Address' => $house->Address,
            'Location' => $house->Location,
            'NumberOfRooms' => $rooms->count(),
            'AvailableRooms' => $AvailableRooms,
        ];
        $user = User::find($house->UserId);
        if ($user) {
            $houseData['Name'] = $user->Name;
        }
        $houseData['HousePhoto'] = $gender === 'ذكر' ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
        return response()->json(['result' => $houseData], 200);
    }
    public function SearchFieldGet($id)
    {
        $currentStudent = Auth::user();
        $gender = $currentStudent->Gender;
        $house = House::find($id);
        if (!$house) {
            return response()->json(['message' => 'لا يوجد بيت بهذا الرقم'], 404);
        }
        if ($house->Gender !== $gender) {
            if ($gender === 'أنثى') {
                return response()->json(['message' => 'هذا سكن طلاب '], 403);
            } else {
                return response()->json(['message' => 'هذا سكن طالبات'], 403);
            }
        }
        $rooms = Room::where('HouseId', $house->id)
            ->where('RoomType', 'Primary')
            ->get();
        $AvailableRooms = 0;
        foreach ($rooms as $room) {
            $AvailableRooms += PrimaryRoom::where('RoomId', $room->id)
                ->whereRaw('BedNumber - BedNumberBooked > 0')
                ->count();
        }
        if ($AvailableRooms == 0) {
            return response()->json(['message' => 'محجوز'], 200);
        }
        $houseData = [
            'HouseType' => $house->HouseType,
            'Address' => $house->Address,
            'Location' => $house->Location,
            'NumberOfRooms' => $rooms->count(),
            'AvailableRooms' => $AvailableRooms,
        ];
        $user = User::find($house->UserId);
        $houseData['Name'] = $user ? $user->Name : 'Unknown';
        $houseData['HousePhoto'] = $gender === 'ذكر' ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
        return response()->json(['result' => $houseData], 200);
    }
}
