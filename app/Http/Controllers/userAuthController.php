<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Factory;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class userAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->All(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|email|unique:users',
            'phone_number' => 'required',
            'country' => 'required',
            'password' => 'required|string|confirmed|min:6'

        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->toJson(), 400);
        //else create a user
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
    
        $user->sendEmailVerificationNotification();
       
        return response()->json(
            [
                'message' => 'User is registered successful!  A verification link has been sent to your email address',
                'user' => $user
            ],
            201
        );
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->All(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 422);
        //else login a user
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unautholized'], 401);
        }
        return $this->crateNewToken($token);
    }
    public function crateNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'baerer',
            // 'expires_in'=>auth()->factory()->getTTL()*60,
            'expires_in' => auth()->factory()->getTTL() * 60,

            'user' => auth()->user()
        ]);
    }
    public function profile()
    {
        return response()->json([auth()->user()]);
    }
    public function logout()
    {
        auth()->logout();
        return response()->json(
            ['message' => 'User is loged out successful!']
        );
    }
}
