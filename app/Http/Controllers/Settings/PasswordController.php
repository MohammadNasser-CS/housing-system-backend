<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['ForgetPassword']]);
    }
    public function changePassword(ChangePasswordRequest $request)
    {

        if (!(Hash::check($request->password, Auth::user()->password))) {
            return response()->json(['message' => 'كلمة السر الحالية ليست متطابقه'], 400);
        }
        $user = Auth::user();
        $user->password = Hash::make($request->newPassword);
        $user->save();
        return response()->json(['message' => 'تم تغيير كلمة السر بنجاح'], 200);
    }
    /*public function ForgetPassword(Request $request)
    {
        try {
            $user = User::where('Email' , $request->Email)->get();
            if(count($user) > 0 ){
                $token = Str::Random(6);
                $Domain = URL::to('/');
                $Url = $Domain.'/reset-password?token='.$token;
                $Path =
                $Data['url'] = $Url;
                $Data['Email'] = $request->Email;
                $Data['title'] = 'نسيان كلمة المرور';
                $Data['Body'] = 'اضغط على الرابط لتضع كلمة المرور الجديدة';
                Mail::send('forgetPasswordMail' , ['data' => $Data] , function($message) use ($Data){
                    $message->to($Data['Email'])->subject($Data['title']);
                });
                $dateTime = Carbon::now()->format('Y-m-d H:i:s');
                PasswordReset::updateOrCreate(
                    ['Email' => $request->Email],
                    [
                        'Email' => $request->Email,
                        'token' => $token,
                        'created_at' => $dateTime
                    ]
                );
                return response()->json(['success'=>true , 'message'=> 'يرجى فتح الايميل لوضع كلمة المرور الجديدة الخاصة بك']);
            }else{
                return response()->json(['success'=>false , 'message'=> 'User not found!']);
            }

        } catch (\Exception $e) {
            return response()->json(['success'=>false , 'message'=> $e->getMessage()]);
        }

    }*/
}
