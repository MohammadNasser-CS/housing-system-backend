<?php

namespace App\Http\Controllers\HouseOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreHouseRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Models\House;
use App\Models\Room;
use App\Models\PrimaryRoom;
use App\Models\RoomPhoto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AddHouse extends Controller
{
    public function AddHouse(StoreHouseRequest $request)
    {
        House::create([
            'description' => $request['description'],
            'address' => $request['address'],
            'houseType' => $request['houseType'],
            'gender' => $request['gender'],
            'location' => $request['location'],
            'internet' => $request['internet'],
            'water' => $request['water'],
            'electricity' => $request['electricity'],
            'gas' => $request['gas'],
            'userId' => Auth::id(),
        ]);
        return response()->json(['message' => 'تم إنشاء البيت بنجاح'], 201);
    }
    public function AddRoom(StoreRoomRequest $request)
    {
        $room = Room::create([
            'houseId' => $request['houseId'],
            'roomType' => $request['roomType'],
        ]);
        PrimaryRoom::create([
            'roomId' => $room->id,
            'bedNumber' => $request['bedNumber'],
            'bedNumberBooked' => $request['bedNumberBooked'],
            'roomSpace' => $request['roomSpace'],
            'balcony' => $request['balcony'],
            'desk' => $request['desk'],
            'ac' => $request['ac'],
            'price' => $request['price'],
        ]);
        foreach ($request['photos'] as $photo) {
            // Decode base64 image data
            $imageData = base64_decode($photo['base64Image']);
            if ($imageData === false) {
                return response()->json(['message' => 'Invalid base64 format'], 400);
            }

            $uniqueId = Str::uuid()->toString(); // ID for PhotoRoom
            $imageExtension = $photo['imageExtension'];
            $ownerName = Auth::user()->name;
            $nameFile = str_replace(' ', '_', $ownerName);

            // Photo path in storage :
            $path = 'photos/' . $nameFile . '/houses/house' . $request['houseId'] . '/room' . $room->id . '/photo' . $uniqueId . '.' . $imageExtension;

            // Create the directory if it doesn't exist
            $directory = dirname($path);
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory, 0775, true);
            }
            // Save the image
            Storage::disk('public')->put($path, $imageData);

            RoomPhoto::create([
                'roomId' => $room->id,
                'photoUrl' => $path,
            ]);
        }
        return response()->json(['message' => 'تم إضافة الغرفة بنجاح'], 201);
    }
}
