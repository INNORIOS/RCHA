<?php

namespace App\Http\Controllers\RCHAcontroller;

use App\Models\Place;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class paymentController extends Controller
{
    public function payment(Request $request)
{
    $user = Auth::user();

    $place = Place::find($request->get('place_id'));
    $payment = new Payment();
    $payment->user_id = $user->id;
    $payment->place_id = $place->id;
    $payment->amount = $request->get('amount');
    $payment->save();

   
}

}
