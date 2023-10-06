<?php

namespace App\Http\Controllers\paymentGatways;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class flutterController extends Controller
{
    public function initialize(Request $booking, $bookingId)
    {
        try {
          
           // Retrieve data from the request
           $bookingId = $booking->input('bookingId'); 
           $bookId = $booking->input('bookId'); 
           $phone_number = $booking->input('phone_number');
           $bookingStatus = $booking->input('status');
           $total = $booking->input('total');
           $deposit = $booking->input('deposit');
           $total = $booking->input('total');
           $email = $booking->input('email');
           $name = $booking->input('name');
           $currency = $booking->input('currency');
           if ($deposit > 0) {
             $pay = $deposit;
         } else {
             $pay = $total;
         }
            // Retrieve the booking details, including the total
            $booking = Booking::find($bookingId);
            // Validate the request data here before using it
            $reference = Flutterwave::generateReference();
    
            // Enter the details of the payment
            //$formatted_currency = format_money($booking->total);
            $data = [
                //'public_key' => 'FLWPUBK_TEST-e2e00ff6ae2bc3dc50655cb4a3fb29ac-X',
                'tx_ref' =>$reference,
                'email' => $email,
                'amount' =>$pay,
                'bookingStatus' =>$bookingStatus,
                'name' =>$name,
                'bookId' => $bookId,
                'payment_options' => 'card,banktransfer',
                // 'currency' => "USD",
                'currency' => $currency,
                //  'redirect_url' => route('callback', ['bookingId' => $bookingId],['bookId' => $bookId]),
                'redirect_url' => route('callback',['bookId' => $bookId]),
    
                //'redirect_url' => route('callback'),
                'customer' => [
                   'email' => $email,            
                   'name' => $name,
                   'phone_number' => $phone_number
               ],
              
            ];
           // dd($data);
            $payment = Flutterwave::initializePayment($data);
            //dd($payment);
            if ($payment['status'] !== 'success') {
             
               return response()->json(['message' => 'Payment initiation failed'], 400);  
            }
             //  return view('pays', ['paymentLink' => $payment['data']['link'],'bookingId' => $bookingId,'bookId' => $bookId]);
             return view('pays', ['paymentLink' => $payment['data']['link'],'bookId' => $bookId]);
    
          } catch (\Exception $e) {
          dd($e);
           // return response()->json(['message' => 'An error occurred during payment initiation'], 500);
        }
    }
}
