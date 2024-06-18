<?php

namespace App\Http\Controllers\Student;

use App\Enum\HouseTypeEnum;
use App\Enum\RoomTypeEnum;
use App\Enum\UserGenderEnum;
use App\Enum\HouseGenderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategorizedHouses;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\HouseOwner;
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
                ->where('roomType', RoomTypeEnum::sleepRoom->value)
                ->get();
            $numberOfRooms = $rooms->count();
            $availableRooms = 0;
            foreach ($rooms as $room) {
                $availableRooms += PrimaryRoom::where('roomId', $room->id)
                    ->whereRaw('bedNumber - bedNumberBooked > 0')
                    ->count();
            }
            if ($availableRooms > 0) {
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
                    $houseData['ownerName'] = $user->name;
                }
                // Add HousePhoto based on gender
                $houseData['housePhoto'] = $gender === HouseGenderEnum::MALE->value ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
                //check if user has favorited this house or not
                $currentStudent = Auth::user();
                $favorite = Favorite::where('userId', $currentStudent->id)
                    ->where('houseId', $house->id)
                    ->first();
                $houseData['isFavorite'] = $favorite ? true : false;
                $Data[] = $houseData;
            }
        }
        if (empty($Data)) {
            return response()->json(['result' => $message], 200);
        }
        return  response()->json(['houses' => $Data], 200);
    }
    public function getAllHouses()
    {
        $currentStudent = Auth::user();
        $gender = $currentStudent->gender === UserGenderEnum::MALE->value ? HouseGenderEnum::MALE->value : HouseGenderEnum::FEMALE->value;
        $houses = House::where('gender', $gender)->get();
        if ($houses->isEmpty()) {
            return response()->json(['message' => 'لا يوجد'], 404);
        }
        return $this->getdata($houses, $gender, 'لا يوجد سكنات متوفره');
    }
    public function showApartments()
    {
        $currentStudent = Auth::user();

        $gender = $currentStudent->gender === UserGenderEnum::MALE->value ? HouseGenderEnum::MALE->value : HouseGenderEnum::FEMALE->value;

        $houses = House::where('gender', $gender)->where('houseType', HouseTypeEnum::Apartment->value)->get();

        if ($houses->isEmpty()) {
            return response()->json(['message' => 'لا يوجد'], 404);
        }
        return $this->getdata($houses, $gender, 'لا يوجد شقق متوفره ');
    }
    public function getCategorizedHouses(CategorizedHouses $request)
    {
        $currentStudent = Auth::user();
        $gender = $currentStudent->gender === UserGenderEnum::MALE->value ? HouseGenderEnum::MALE->value : HouseGenderEnum::FEMALE->value;
        $houses = House::where('gender', $gender)
            ->where('houseType', $request['houseType'])
            ->get();
        if ($houses->isEmpty()) {
            return response()->json(['message' => 'لا يوجد'], 404);
        }
        return $this->getdata($houses, $gender, 'لا يوجد استديوهات متوفره');
    }
    public function searchFieldPost(Request $request)
    {
        $currentStudent = Auth::user();
        $genderhouse = $currentStudent->gender === UserGenderEnum::MALE->value ? HouseGenderEnum::MALE->value : HouseGenderEnum::FEMALE->value;
        $name = $request->input('name');
        $user = User::where('name', $name)->get();
        return response()->json(['user' => $user]);
        $house = House::where('userId', $user->id);
        // $house = House::find($id);
        if (!$house) {
            return response()->json(['message' => 'لا يوجد بيت بهذاالرقم'], 404);
        }
        if ($house->gender !== $genderhouse) {
            if ($currentStudent->gender === UserGenderEnum::FEMALE->value) {
                return response()->json(['message' => 'هذا سكن طلاب '], 403);
            } else {
                return response()->json(['message' => 'هذا سكن طالبات'], 403);
            }
        }
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
        $houseData['housePhoto'] = $currentStudent->gender === UserGenderEnum::MALE ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
        return response()->json(['result' => $houseData], 200);
    }

    public function search($name)
    {
        $currentStudent = Auth::user();
        $genderhouse = $currentStudent->gender === UserGenderEnum::MALE->value ? HouseGenderEnum::MALE->value : HouseGenderEnum::FEMALE->value;
        $user = User::where('name', $name)->first();

        if (!$user) {
            return response()->json(['message' => 'صاحب السكن هذا غير موجود'], 404);
        }

        $houses = House::where('userId', $user->id)->get();

        if ($houses->isEmpty()) {
            return response()->json(['message' => 'لا يوجد منازل يملكها الشخص الذي تبحث عنه'], 404);
        }

        $result = [];
        foreach ($houses as $house) {

            if ($house->gender !== $genderhouse) {
                continue; // Skip this house if it doesn't match the student's gender
            }

            $rooms = Room::where('houseId', $house->id)
                ->where('roomType', RoomTypeEnum::sleepRoom->value)
                ->get();

            $availableRooms = 0;
            foreach ($rooms as $room) {
                $availableRooms += PrimaryRoom::where('roomId', $room->id)
                    ->whereRaw('bedNumber - bedNumberBooked > 0')
                    ->count();
            }

            if ($availableRooms == 0) {
                continue; // Skip this house if no rooms are available
            }
            $houseData = [
                'houseId' => $house->id,
                'houseType' => $house->houseType,
                'address' => $house->address,
                'location' => $house->location,
                'numberOfRooms' => $rooms->count(),
                'availableRoom' => $availableRooms,
            ];

            $houseOwner = User::find($house->userId);
            $houseData['ownerName'] = $houseOwner->name;
            $houseData['housePhoto'] = $currentStudent->gender === UserGenderEnum::MALE->value ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');

            $currentStudent = Auth::user();
            $favorite = Favorite::where('userId', $currentStudent->id)
                ->where('houseId', $house->id)
                ->first();
            $houseData['isFavorite'] = $favorite ? true : false;

            $result[] = $houseData;
        }

        if (empty($result)) {
            return response()->json(['message' => 'لا يوجد منازل متاحة حاليا يملكها الشخص الذي تبحث عنه'], 404);
        }

        return response()->json(['houses' => $result], 200);
    }


    // public function search($name)
    // {
    //     $currentStudent = Auth::user();
    //     $genderhouse = $currentStudent->gender === UserGenderEnum::MALE->value ? HouseGenderEnum::MALE->value : HouseGenderEnum::FEMALE->value;
    //     $user = User::where('name', $name)->first();
    //     $houses = House::where('userId', $user->id)->get();
    //     if (!$houses) {
    //         return response()->json(['message' => 'لا يوجد منازل يملكها الشخص الذي تبحث عنه'], 404);
    //     }
    //     return response()->json(['user' => $houses]);

    //     foreach ($houses as $house) {
    //         if ($house->gender !== $genderhouse) {
    //             if ($currentStudent->gender === UserGenderEnum::FEMALE->value) {
    //                 return response()->json(['message' => 'هذا سكن طلاب '], 403);
    //             } else {
    //                 return response()->json(['message' => 'هذا سكن طالبات'], 403);
    //             }
    //         }
    //         $rooms = Room::where('houseId', $house->id)
    //             ->where('roomType', RoomTypeEnum::sleepRoom->value)
    //             ->get();


    //         $availableRooms = 0;
    //         foreach ($rooms as $room) {
    //             $availableRooms += PrimaryRoom::where('roomId', $room->id)
    //                 ->whereRaw('bedNumber - bedNumberBooked > 0')
    //                 ->count();
    //         }
    //         if ($availableRooms == 0) {
    //             return response()->json(['message' => 'محجوز'], 200);
    //         }
    //         $houseData = [
    //             'houseType' => $house->houseType,
    //             'address' => $house->address,
    //             'location' => $house->location,
    //             'numberOfRooms' => $rooms->count(),
    //             'availableRooms' => $availableRooms,
    //         ];
    //         $user = User::find($house->userId);
    //         $houseData['name'] = $user ? $user->name : 'unknown';
    //         $houseData['housePhoto'] = $currentStudent->gender === UserGenderEnum::MALE->value ? url('storage/Photos/boy_house.png') : url('storage/Photos/girl_house.png');
    //     }

    //     return response()->json(['result' => $houseData], 200);
    // }
}
