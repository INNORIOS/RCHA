<?php

namespace App\Http\Controllers\RCHAcontroller;

use App\Models\Payment;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class feedbackController extends Controller
{
 

public function feedback(Request $request)
{
    try {
        // Get the payment ID from the request.
        $paymentId = $request->input('payment_id');

        // Check if the user has paid for the place.
        $payment = Payment::find($paymentId);
        if (!$payment || $payment->amount === 0) {
            return response()->json([
                'message' => 'You have not paid for this place.',
            ], 403);
        }
        // Create a new feedback record.
        $feedback = new Feedback();
        $feedback->payment_id = $paymentId;
        $feedback->comment = $request->input('comment');
        $feedback->rate = $request->input('rate');
       $result = $feedback->save();

        // Return a success response.
        return response()->json([
            'message' => 'Feedback submitted successfully.',
            'result' => $result,
        ], 201);
    } catch (\Exception $e) {
        // Log the exception
        Log::error($e->getMessage());
        // Return an error response
        return response()->json([
            'message' => 'An error occurred while processing your request.',
        ], 500);
    }
}
public function getFeedback(Request $request)
{
    try {
        // Get the place ID from the request.
        $placeId = $request->input('place_id');
        $payment= Payment::where('place_id',$placeId);
        $payment_id=$payment->id;
        // Retrieve feedback records for the given place ID.
        $feedback = Feedback::where('payment_id', $payment_id)->get();

        // Return the feedback as a JSON response.
        return response()->json($feedback, 200);
    } catch (\Exception $e) {
        // Log the exception.
        Log::error($e->getMessage());

        // Return an error response.
        return response()->json([
            'message' => 'An error occurred while fetching feedback.',
        ], 500);
    }
}


}
