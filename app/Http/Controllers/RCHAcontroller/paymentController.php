<?php

namespace App\Http\Controllers\RCHAcontroller;
// use JWTAuth;
// use Carbon\Carbon;
use session;
use Carbon\Carbon;
use App\Models\Place;
use App\Models\Token;
use App\Models\Payment;
use Illuminate\Support\Str;
use Cohensive\OEmbed\OEmbed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Contracts\Providers\Auth;


class paymentController extends Controller
{
   

// public function generatePaidLink(Request $request)
// {
//    try{// $place = Place::find($placeId);
//     // $user = Auth::user();
//     $user = JWTAuth::parseToken()->authenticate(); 
//     $place = Place::find($request->get('place_id'));
//     //$place_id = $request->input('place_id');
//     if (!$place) {
//          // Handle invalid place ID
//          return response()->json([
//             'message' => 'Place not found!',
//         ], 404);
//     }
    
//     //$tokenExpiresAt = now()->addHours(24); // Set token expiry to 24 hours from now
//     // $tokenExpiresAt = now()->addMinutes(2); //Set token expiry to 1 minutes from now
//     //$tokenExpiresAt =auth()->factory()->getTTL() * 2;

//     // Save the paid token in the tokens table
//     $paidToken = Str::random(32); // Generate a random token

//     $token = new Token();
    
//     $token->paid_token = $paidToken;
//     $token->token_expires_at = now()->addMinutes(10);
//     // Generate the paid link based on place_link and paid_token and save it in DB
//     $token->paid_link= $paidLink = $place->place_link . '/' . $paidToken;
    
//     $token->save();
// //dd($token);
//     return response()->json([
//         'message'=>'paid link is created and saved in DB',
//         'paidLink'=>$paidLink,
//         'paidToken'=>$paidToken,
//         // 'token_id'=>$token->id
//     ]);
    
     
// }catch(\Exception $e){
//     Log::error('Exception occurred: ' . $e->getMessage());
//     //dd($e);
//         return response()->json([
//             'message' => 'An error occurred while processing your request about generatePaidLink.',
//         ], 500);
// }
   
// }
// public function getPaidToken($paidToken)
// {   
//     try{
//     // Decode the token to get user information
//     $user = JWTAuth::parseToken()->authenticate();

//     $token = Token::where('paid_token', $paidToken)->first();
//      //dd($token, $token->token_expires_at);
// // dd($token->id);
    
//     $now = Carbon::now();
//     $startDate = Carbon::parse($token['created_at'])->format('d.m.y h:m:sa');
//     $token_expires_at = Carbon::parse($token['created_at'])->addMinutes(5)->format('d.m.y h:m:sa');
//     if($now->between($startDate, $token_expires_at)){
//     // if (!$token || $token->token_expires_at->isPast()) {
//         // Token is invalid or expired
//          // Redirect the user to the paid_link
//          return response()->json(['message' => 'Date is not expired'], 422);
//     //return redirect($token->paid_link);
//     }
//     return response()->json(['message' => 'Invalid or expired token'], 422);
   
// } catch (\Exception $e) {
//     // Handle the exception
//     Log::error('Exception occurred: ' . $e->getMessage());
// //dd($e);
//     return response()->json([
//         'message' => 'An error occurred while processing your paidToken.',
//     ], 500);
// }
// }


// public function generatePaidLink(Request $request)
// {
//     try {
//         // $user = Auth::user();
//         $user = JWTAuth::parseToken()->authenticate(); // Get the authenticated user using JWT
//         $place = Place::find($request->get('place_id'));
//         if (!$place) {
//             return response()->json([
//                 'message' => 'Place not found!',
//             ], 404);
//         }

//         $paidToken = Str::random(32);
//         // $tokenExpiresAt = auth()->factory()->getTTL() * 2;
//         //$tokenExpiresAt = now()->addMinutes(2); //Set token expiry to 1 minutes from now
//         // $tokenExpiresAt = Carbon::parse('+2 minutes');
//         // $tokenExpiresAt = now()->addMinutes(2);

//         $paidTokens = $request->session()->put('paid_token', $paidToken);
//         $tokenExpiresAt = $request->session()->put('token_expires_at', now()->addMinutes(1));
        

//         $paid_link = $place->place_link . '/' . $paidTokens;

//         $token = new Token();
//         $token->paid_token = $paidTokens;
//         // $token->token_expires_at = now()->addMinutes($tokenExpiresAt);
//         $token->token_expires_at =$tokenExpiresAt;
//         $token->paid_link =$paid_link;
//        // $token->created_at = Carbon::now();
//         $token->save();
// //dd( $token);
// //dd( $token->created_at);
//         $token = auth()->login($user);
//       //  return redirect(route('videoView'));
//         return response()->json([
//             'message' => 'paid link is created and saved in DB',
//             'paidLink' => $paid_link,
//             'paidToken' => $paidTokens,
//             'expires_in' => $tokenExpiresAt
//         ]);
//     } catch (\Exception $e) {
//         Log::error('Exception occurred: ' . $e->getMessage());
//         return response()->json([
//             'message' => 'An error occurred while processing your request about generatePaidLink.',
//         ], 500);
//     }
// }



// public function getPaidToken($paidToken)
// {
//     try {
//         // Check for empty token
//         if (empty($paidToken)) {
//             return response()->json(['message' => 'Empty token'], 422);
//         }

//         // Get the token from the database
//         $token = Token::where('paid_token', $paidToken)->first();

//         // If the token is not found, return an error response
//         if (!$token) {
//             return response()->json(['message' => 'Invalid token'], 422);
//         }

//         // Get the current time
//        // $now = Carbon::now();
//        $currentTime = time();
//        $tokenExpirationTime = strtotime($token->token_expires_at);
//        dd($tokenExpirationTime,$tokenExpirationTime);
//         // Get the token expiration time
// //         $tokenExpiresAt = Carbon::parse($token->token_expires_at);
// // dd($tokenExpiresAt);
//         // Check if the token is expired
//         if ($currentTime >= $tokenExpirationTime) {
//             return response()->json(['message' => 'Valid token'], 200);    
//         }

//         // Return a success response
//         //return response()->json(['message' => 'Valid token'], 200);
//     } catch (\Exception $e) {
//         // Log the error
//         Log::error('Exception occurred: ' . $e->getMessage());

//         // Return an error response
//         return response()->json([
//             'message' => 'An error occurred while processing your paidToken.',
//         ], 500);
//     }
// }
public function generatePaidLink(Request $request)
{
    try {
        $user = JWTAuth::parseToken()->authenticate(); // Get the authenticated user using JWT
        $place = Place::find($request->get('place_id'));
        if (!$place) {
            return response()->json([
                'message' => 'Place not found!',
            ], 404);
        }

        $paidToken = Str::random(32);
        // Set the token expiration time to 1 minutes from now
        $tokenExpiresAt = Carbon::now()->addMinutes(3);

        $token = new Token();
        $token->paid_token = $paidToken;
        $token->token_expires_at = $tokenExpiresAt;
        $token->paid_link = $place->place_link . '/' . $paidToken;
        $token->save();

        return response()->json([
            'message' => 'Paid link generated successfully!',
            'paidLink' => $token->paid_link,
            'paidToken' => $paidToken,
            'expires_in' => $tokenExpiresAt,
        ], 200);
    } catch (\Exception $e) {
        Log::error('Exception occurred: ' . $e->getMessage());
        return response()->json([
            'message' => 'An error occurred while generating the paid link.',
        ], 500);
    }
}

public function validatePaidToken($paidToken)
{
    try {
        // Get the token from the database
        $token = Token::where('paid_token', $paidToken)->first();

        // If the token is not found, return an error response
        if (!$token) {
            return response()->json(['message' => 'Invalid token'], 422);
        }

        // Get the current time
        $now = Carbon::now();

        // Get the token expiration time
        $tokenExpiresAt = Carbon::parse($token->token_expires_at);

        // Check if the token is expired
        if ($now->isAfter($tokenExpiresAt)) {
            return response()->json(['message' => 'Token has expired'], 422);
        }

        // Return a success response
        //   return redirect(route('videoView'));
         // Display the video to the user
    // return view('videoView', ['paidLink' => $token->paid_link]);
    // return view('videoView', ['token' => $token]);
    //dd($token->paid_link);
    $embed = OEmbed::get($token->paid_link);
    if($embed){
        return $embed->html(['width => 300']);
    }
    
    //return view('videoView')->with(['token' => $token->paid_link]);
        //return response()->json(['message' => 'Valid token'], 200);
    } catch (\Exception $e) {
        Log::error('Exception occurred: ' . $e->getMessage());
        return response()->json([
            'message' => 'An error occurred while validating the paid token.',
        ], 500);
    }
}




        public function payment(Request $request)
            {
    
    try{
    // $user = Auth::user();
    $user = JWTAuth::parseToken()->authenticate(); // Get the authenticated user using JWT
    $token = Token::find($request->get('token_id'));
    $place = Place::find($request->get('place_id'));
    $payment = new Payment();
    $payment->user_id = $user->id;
    $payment->place_id = $place->id;
    $payment->token_id = $token->id;
    $payment->amount =$request->get('amount');

    if($payment->save()) {
     Log::info('Payment created');
      return response()->json([
        'message' => 'Payment created successfully!',
        'payment' => $payment,
    ], 201);
    
    }
    Log::info('Payment not created');
    return response()->json([
        'message' => 'Payment info is not saved!',], 422);
    } catch (\Exception $e) {
        // Handle the exception
        Log::error('Exception occurred: ' . $e->getMessage());
    //dd($e);
        return response()->json([
            'message' => 'An error occurred while processing your request.',
        ], 500);
    }
}
public function getPaymentInfo(){
    $payInfoQuery = DB::table('users')
    ->join('payments', 'users.id', '=', 'payments.user_id')
    ->join('places', 'payments.place_id', '=', 'places.id')
    ->join('tokens', 'payments.token_id', '=', 'tokens.id')
    ->where('users.id', Auth::user()->id)
    ->select('users.email', 'users.phone_number', 'users.first_name', 'users.last_name', 'places.place_name', 'places.place_location', 'payments.amount','tokens.paid_token');
    $results = $payInfoQuery->get();
    if($results){
        foreach ($results as $result) {
        echo $result->email . ' ' . $result->phone_number . ' ' . $result->first_name . ' ' . $result->last_name . ' ' . $result->place_name . ' ' . $result->place_location . ' ' . $result->amount . ' ' . $result->paid_token. PHP_EOL ;
    }
    }
}

}
