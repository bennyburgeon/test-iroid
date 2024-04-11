<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
   

    public function login(Request $request){

        // Data validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if(Auth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ])){

            $user = Auth::user();

            $token = $user->createToken("myToken")->accessToken;

            return response()->json([
                "status" => true,
                "message" => "Login successful",
                "access_token" => $token
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "Invalid credentials"
        ]);
    }
    
    // Profile API (GET)
    public function companies(){
        
        $userdata = Auth::user();
        if($userdata){

            $data = Company::all();
            return response()->json([
                "status" => true,
                "message" => "Company List data",
                "data" => $data
            ]);
        }else{
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials"
            ]); 
        }

        
    }

    // Logout API (GET)
    public function logout(){

        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message" => "User logged out"
        ]);
    }
}