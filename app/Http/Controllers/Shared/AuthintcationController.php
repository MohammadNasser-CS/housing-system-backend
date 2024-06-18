<?php

namespace App\Http\Controllers\Shared;

use App\Enum\AccountStatusEnum;
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
    public function studentRegister(RegisterRequestStudent $request)
    {
        $password = Hash::make($request['password']);
        $request['password'] = $password;
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
            'phoneNumber' => $request['phoneNumber'],
            'role' => $request['role'],
            'gender' => $request['gender'],
        ]);
        Student::create([
            'userId' => $user->id,
            'college' => $request['college'],
            'specialization' => $request['specialization'],
            'universityBuilding' => $request['universityBuilding'],
            'birthDate' => $request['birthDate'],
        ]);
        return $this->respondWithToken($user, 'تم إنشاء حساب بنجاح');
    }
    public function houseOwnerRegister(RegisterRequestHouseOwner $request)
    {
        $password = Hash::make($request['password']);
        $request['password'] = $password;
        $UserData = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $password,
            'role' => $request['role'],
            'phoneNumber' => $request['phoneNumber'],
            'gender' => $request['gender'],
            'accountStatus' => AccountStatusEnum::notActive->value,
        ];
        $user = User::create($UserData);
        $HouseOwnerData = [
            'userId' => $user->id,
            'timesList' => $request['timesList'] ?? null,
            'daysList' => $request['daysList'] ?? null,
        ];
        if ($request->hasFile('royaltyPhoto')) {
            $path = $request->file('royaltyPhoto')->store('photos', 'public');
            $HouseOwnerData['royaltyPhoto'] = $path;
        }

        HouseOwner::create($HouseOwnerData);
        if (!isset($HouseOwnerData['royaltyPhoto'])) {
            return response()->json(['message' => 'تم التسجيل بنجاح، سيتم التواصل معك لقبول حسابك', 'isRegistered' => true,], 201);
        } else {
            return response()->json(['message' => 'تم التسجيل بنجاح، يرجى الانتظار لقبول الادمن حسابك', 'isRegistered' => true,], 201);
        }
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'يوجد خطأ في الايميل أو كلمة السر'], 401);
        }
        if ($user->accountStatus === AccountStatusEnum::notActive->value) {
            return response()->json(['message' => 'لم يتم قبول حسابك بعد'], 403);
        }

        // $user->tokens()->delete();

        return $this->respondWithToken($user, 'تم تسجيل الدخول');
    }
    public function logout(Request $request)
    {
        if (!$request->user() || !$request->user()->currentAccessToken()) {
            return response()->json(['message' => 'المستخدم غير مسجل دخول'], 401);
        }

        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'تم تسجيل الخروج بنجاح'], 200);
    }
    public function getUser()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Return the authenticated user's details
            return response()->json([
                'user' => Auth::user()
            ], 200);
        } else {
            // Return a response indicating the user is not authenticated
            return response()->json([
                'user' => null,
            ], 401);
        }
    }
    protected function respondWithToken($user, $message)
    {
        if ($user) {
            $token = $user->createToken('API Token Of ' . $user->name, expiresAt: now()->addDay())->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'message' => $message,
                'logged' => true,
            ]);
        }
        return response()->json(['error' => 'User not authenticated'], 401);
    }
}
