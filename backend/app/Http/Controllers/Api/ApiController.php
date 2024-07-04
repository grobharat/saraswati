<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    // Register,Login,Profile,Logout
    //POST [name,email,password]

    /**
* @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="User's name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="201", description="User registered successfully"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */
    public function register(Request $request){
        
        //Validation
        $request->validate([
            "name" => "required|string",
            "email" => "required|string|email|unique:users",
            "password" => "required|confirmed"
        ]);
        //User
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        //Return
        return response()->json([
            "status" => true,
            "message" =>"User registered successfully",
            "data" => []
        ]);

    }
    //POST [email,password]
    /**
     * @OA\Get(
     *     path="/api/userwa",
     *     summary="Get logged-in user details",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function login(Request $request){
        //Validation
        $request->validate([
            "email"=>"required|string|email",
            "password"=>"required"
        ]);
        //User check
        $user = User::where("email",$request->email)->first();        
        //Password check
        if(!empty($user)){
            if(Hash::check($request->password,$user->password)){
                //Generate Token
                $token = $user->createToken("userToken")->plainTextToken;
                //Return
                return response()->json([
                    "status" => true,
                    "message" => "User logged in",
                    "token" => $token,
                    "data" => []
                ]);
            }else{
                return response()->json([
                    "status"=>false,
                    "message"=>"Password is wrong",
                    "data"=>[]
                ]);
            }
        }else{
            return response()->json([
                "status"=>false,
                "message"=>"User not found",
                "data"=>[]
            ]);
        }
        
      

    }
    //GET [Auth:Token]
    public function profile(){
        $user= auth()->user();
        return response()->json([
            "status"=> true,
            "message"=> "Profile information",
            "data"=> $user->toArray()
        ]);

    }
    //GET [Auth:Token]
    public function logout(){
        $user= auth()->user()->tokens()->delete();
        return response()->json([
            "status"=> true,
            "message"=> "User logged out successfully",
            "data"=> []
        ]);
    }
}
