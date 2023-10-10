<?php

namespace App\Http\Controllers\RCHAcontroller;
// use JWTAuth;
use App\Models\Place;
use App\Models\Token;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class paymentController extends Controller
{
   

public function generatePaidLink(Request $request)
{
   try{// $place = Place::find($placeId);
    // $user = Auth::user();
    $user = JWTAuth::parseToken()->authenticate(); 
    $place = Place::find($request->get('place_id'));
    //$place_id = $request->input('place_id');
    if (!$place) {
         // Handle invalid place ID
         return response()->json([
            'message' => 'Place not found!',
        ], 404);
    }
    $paidToken = Str::random(32); // Generate a random token
    //$tokenExpiresAt = now()->addHours(24); // Set token expiry to 24 hours from now
    $tokenExpiresAt = now()->addMinutes(2); //Set token expiry to 1 minutes from now
    //$timestamp = now()->timestamp;

    // Save the paid token in the tokens table
    $token = new Token();
    $token->paid_token = $paidToken;
    $token->token_expires_at = $tokenExpiresAt;
    // Generate the paid link based on place_link and paid_token and save it in DB
    $token->paid_link= $paidLink = $place->place_link . '/' . $paidToken;
    
    $token->save();
//dd($token);
    return response()->json([
        'message'=>'paid link is created and saved in DB',
        'paidLink'=>$paidLink,
        'paidToken'=>$paidToken,
        // 'token_id'=>$token->id
    ]);
    
     
}catch(\Exception $e){
    Log::error('Exception occurred: ' . $e->getMessage());
    //dd($e);
        return response()->json([
            'message' => 'An error occurred while processing your request about generatePaidLink.',
        ], 500);
}
   
}
public function getPaidToken($paidToken)
{   
    try{
    //dd($paidToken);
    $token = Token::where('paid_token', $paidToken)->first();
    // dd($token, $token->token_expires_at);
// dd($token->id);
    if (!$token || $token->token_expires_at->isPast()) {
        // Token is invalid or expired
        return response()->json(['message' => 'Invalid or expired token'], 422);
    }

    // Redirect the user to the paid_link
    return redirect($token->paid_link);
} catch (\Exception $e) {
    // Handle the exception
    Log::error('Exception occurred: ' . $e->getMessage());
//dd($e);
    return response()->json([
        'message' => 'An error occurred while processing your paidToken.',
    ], 500);
}
}


        public function payment(Request $request)
{
    
    try{
    $user = Auth::user();
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
