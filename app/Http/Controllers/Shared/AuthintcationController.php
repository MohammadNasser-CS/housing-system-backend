<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\HouseOwner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validate;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequestStudent;
use App\Http\Requests\RegisterRequestHouseOwner;
use App\Http\Requests\LoginRequest;

class AuthintcationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'StudentRegister', 'HouseOwnerRegister']]);
    }
    public function StudentRegister(RegisterRequestStudent $request)
    {
        $data = $request->validated();
        $password = Hash::make($request['Password']);
        $request['Password'] = $password;
        $user = User::create([
            'Name' => $request['Name'],
            'Email' => $request['Email'],
            'Password' => $request['Password'],
            'Phone' => $request['Phone'],
            'Type' => 'Student',
            'Gender' => $request['Gender'],
        ]);
        Student::create([
            'UserId' => $user->id,
            'College' => $request['College'],
            'Specialization' => $request['Specialization'],
            'UniversityBuilding' => $request['UniversityBuilding'],
            'DateOfBirth' => $request['DateOfBirth'],
        ]);
        return $this->respondWithToken($user, 'تم إنشاء حساب بنجاح');
    }
    public function HouseOwnerRegister(RegisterRequestHouseOwner $request)
    {
        $Data = $request->validated();
        $Password = Hash::make($Data['Password']);
        $Data['Password'] = $Password;
        $UserData = [
            'Name' => $Data['Name'],
            'Email' => $Data['Email'],
            'Password' => $Password,
            'Type' => 'HouseOwner',
            'Phone' => $Data['Phone'],
            'Gender' => $Data['Gender'],
            'AccountStatus' => 'Not_Active',
        ];
        $user = User::create($UserData);
        $HouseOwnerData = [
            'UserId' => $user->id,
            'TimesList' => $Data['TimesList'] ?? null,
            'DaysList' => $Data['DaysList'] ?? null,
        ];
        if ($request->hasFile('RoyaltyPhoto')) {
            $path = $request->file('RoyaltyPhoto')->store('photos', 'public');
            $HouseOwnerData['RoyaltyPhoto'] = $path;
        }

        HouseOwner::create($HouseOwnerData);
        if (!isset($HouseOwnerData['RoyaltyPhoto'])) {
            return response()->json(['message' => 'تم التسجيل بنجاح، سيتم التواصل معك لقبول حسابك'], 201);
        } else {
            return response()->json(['message' => 'تم التسجيل بنجاح، يرجى الانتظار لقبول الادمن حسابك'], 201);
        }
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('Email', 'Password');
        $user = User::where('Email', $credentials['Email'])->first();
        if (!$user || !Hash::check($credentials['Password'], $user->Password)) {
            return response()->json(['error' => 'يوجد خطأ في الايميل أو كلمة السر'], 401);
        }
        if ($user->AccountStatus == 'Not_Active') {
            return response()->json(['message' => 'لم يتم قبول حسابك بعد'], 403);
        }
        return $this->respondWithToken($user, 'تم تسجيل الدخول');
    }
    public function logout(Request $request)
    {
        if (!$request->user() || !$request->user()->currentAccessToken()) {
            return response()->json(['message' => 'التوكن غير موجود'], 401);
        }

        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'تم تسجيل الخروج بنجاح'], 200);
    }
    protected function respondWithToken($user, $message)
    {
        if ($user) {
            $token = $user->createToken('API Token Of ' . $user->name, expiresAt: now()->addDay())->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'message' => $message,
                //'user' => $user,
            ]);
        }
        return response()->json(['error' => 'User not authenticated'], 401);
    }
}
