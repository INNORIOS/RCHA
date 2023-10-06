<?php

namespace App\Http\Controllers\RCHAcontroller;

use App\Models\Place;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class paymentController extends Controller
{
    public function payment(Request $request)
{
    
    try{
        //return response()->json([auth()->user()]);
    $user = Auth::user();
    $token = Token::find($request->get('token_id'));
    $place = Place::find($request->get('place_id'));
    $payment = new Payment();
    $payment->user_id = 2;
    $payment->place_id = 3;
    $payment->token_id = 2;
    $payment->amount = 1000;/*$request->get('amount');*/
    if($payment) {
        Log::info('Payment created');
     $payment->save();
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

        return response()->json([
            'message' => 'An error occurred while processing your request.',
        ], 500);
    }
}
public function getPaymentInfo(){
    $payInfoQuery = DB::table('users')
    ->join('payments', 'users.id', '=', 'payments.user_id')
    ->join('places', 'payments.place_id', '=', 'places.id')
    ->where('users.id', Auth::user()->id)
    ->select('users.email', 'users.phone_number', 'users.first_name', 'users.last_name', 'places.place_name', 'places.place_location', 'payments.amount');
    $results = $payInfoQuery->get();
    if($results){
        foreach ($results as $result) {
        echo $result->email . ' ' . $result->phone_number . ' ' . $result->first_name . ' ' . $result->last_name . ' ' . $result->place_name . ' ' . $result->place_location . ' ' . $result->amount . PHP_EOL;
    }
    }
}

}
