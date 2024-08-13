<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\AccessToken;
use JWTAuth;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public $loginAfterSignUp = true;

    public function login(Request $request)
    {
        $customMessages = [
            'name.required' => 'El campo name es requerido.',
            'name.string' => 'El campo name debe ser cadena.',
            'phone.required' => 'El campo phone es requerido.',
            'phone.string' => 'El campo phone debe ser cadena.',
        ];
        $this->validate($request, [
            'name' => 'required|string', 
            'phone' => 'required|string'
        ] 
        ,$customMessages);
        $credentials = $request->only("name", "phone");
        $token = null;

        $user = User::where("name", $request->name)->where('phone', $request->phone)->first();
        if($user != null){
            $token_str = JWTAuth::fromUser($user);
            AccessToken::create(['user_id' => $user->id, 'token' => $token_str]);
            return response()->json([
                "status" => true,
                "token" => $token_str
            ]);
        }else{
            
            return response()->json([
                "status" => false,
                "message" => "Unauthorized"
            ]);
        }        
    }

    public function register(Request $request)
    {
        $customMessages = [
            'name.required' => 'El campo name es requerido.',
            'name.string' => 'El campo name debe ser cadena.',
            'img_profile.string' => 'El campo img_profile debe ser cadena.',
            'phone.required' => 'El campo phone es requerido.',
            'phone.string' => 'El campo phone debe ser cadena.',
        ];
        $this->validate($request, [
            'name' => 'required|string', 
            'img_profile' => 'string|nullable',                    
            'phone' => 'required|string'
        ] 
        ,$customMessages);

        $transaction = DB::transaction(function() use($request){
            return User::create($request->all());
        });
        return $transaction;
    }
}
