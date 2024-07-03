<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Jerry\JWT\JWT;

class AuthController extends Controller
{
    public function login(Request $req){
        try {
            $user = User::where("email", $req->input("email"))->first();
            if(!$user){return response()->json(["status"=>"Is Not OK", "msg"=> "User is not found"]);}

            if (!Hash::check($req->input("password"), $user->password)) {
                return response()->json(["status"=> "Is not Ok", "msg"=> "Wrong password"]);
            }

            return response()->json(["status"=> "OK", "msg"=> "Entered", "token"=>null]);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=> $th->getMessage()]);
        }
    }
    public function register(Request $req){
        try {
            $user = User::where("email", $req->input("email"))->first();
            if($user){return response()->json(["status"=>"Is Not OK", "msg"=> "User is already exists"]);}
            
            $newUser = new User();
            $newUser->name = $req->input("name");
            $newUser->email = $req->input("email");
            $newUser->password = Hash::make($req->input("password"));
            $newUser->save();

            return response()->json(["status"=> "OK", "msg"=>"Welcome, ".$newUser->name." This App"]);

        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=> $th->getMessage()]);
        }
    }
    public function forgotPassword(Request $req){
        try {
            $user = User::where("email", $req->input("email"))->first();
            if (!$user) {
                return response()->json(["status"=>"Is Not OK", "msg"=> "Please give saved mail"]);  
            }
            
            if(Cache::has("passtoken")){return response()->json(["status"=> "Is not OK", "msg"=> "Your Token already exists, please check your mailbox"]);}
            $token = JWT::encode(["userId"=>$user->id]);
            
            Cache::put("passtoken", $token, 300);
            
            $user->remember_token = $token;
            $user->save();

            $status = SendMailJob::dispatch($req->input("email"), $token);

            return response()->json(["status"=>"OK", "msg"=>"Please Check Your mailbox", "mailStatus"=>$status]);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=> $th->getMessage()]);
        }
    }
    public function newPassword(Request $request, $token){
        try {
            $decodedToken = JWT::decode($token);
            $user = User::find($decodedToken["userId"]);
            if (!$user) {return response()->json(["status"=>"Is Not OK", "msg"=>  "Invalid Token or User is not saved"]);}  

            if (!Cache::has("passtoken")) {
                return response()->json(["status"=> "Is Not OK", "msg"=> "Token Expired"]);
            }
            if ($token != $user->remember_token || $user->remember_token != Cache::get("passtoken")) {
                return response()->json(["status"=> "Is Not OK", "msg"=> "Invalid Token"]);
            }

            Cache::forget("passtoken");
            $user->password = Hash::make($request->input("password"));
            $user->remember_token = null;
            $user->save();

            return response()->json(["status"=>"OK", "msg"=>"Password Changed Successfully"]);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=> $th->getMessage()]);
        }
    }
}
