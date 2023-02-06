<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function loginOrRegister(Request $request)
    {
        $user = User::firstOrCreate(
            ['email' => $request['email'],],
            [
                'name' => $request['name'],
                'password' => Hash::make($request['password']),
            ]
        );
        if ($user->blocked) {
            return
                response()->json([
                    'success' => false,
                ]);
        }
        $user->last = now();
        $user->save();
        $token =  $user->createToken('adsapptokenwillbethebest')->plainTextToken;
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }

    public function info()
    {
        $user = Auth::User();
        if ($user) {
            $checker2 = !($user->dailycoins > now());
            $checker = !($user->dailycount > now());
            return response()->json([
                'success' => true,
                'data' => Auth::user(),
                'canwatch' => $checker,
                'daily' => $checker2
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => 'error occurred'
            ]);
        }
    }


}
