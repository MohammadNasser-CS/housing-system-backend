<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'base64Image' => 'required|string', // Ensure base64Image is present and a string
            'imageName' => 'required|string', // Ensure imageName is present and a string
        ]);

        if ($request->has('base64Image') && $request->has('imageName')) {

            // Decode base64 image data
            $imageData = base64_decode($request->input('base64Image'));
            if ($imageData === false) {
                return response()->json(['message' => 'Invalid base64 format'], 400);
            }

            // Define the storage path (assuming 'public' disk is configured in filesystems.php)
            $imageName = $request->input('imageName');
            $path = 'images/' . $imageName;
            Storage::disk('public')->put($path, $imageData);

            // Return response with image URL
            $url = url('storage/' . $path);
            return response()->json(['path' => $url, 'message' => 'Image uploaded successfully'], 201);
        }

        return response()->json(['message' => 'لا يوجد بيانات صورة مرفقة'], 400);
    }
}
