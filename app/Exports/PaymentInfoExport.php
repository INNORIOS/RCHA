<?php

namespace App\Exports;

use App\Http\Controllers\RCHAcontroller\paymentController;
use App\Models\Payment;
// use App\Exports\PaymentInfoExport;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentInfoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     $paymentInfo=Payment::all();
    //     //ddd($paymentInfo);
    //     return $paymentInfo;
    // }
    // public function headings(): array
    // {
    //     return [
    //         'id',
    //         'user_id',
    //         'place_id',
    //         'token_id',
    //         'amount',
    //         'created_at',
    //         'updated_at',
           
    //     ];
    // }
    public function collection()
    {
        // $paymentInfo = $this->getPaymentInfo();
       // getPaymentInfo is a method that retrieves payment information 
           $sortBy = 'created_at'; 
           $sortDirection = 'desc';
           $request = request()->merge(['sortBy' => $sortBy, 'sortDirection' => $sortDirection]);
   
           // Call the controller method which holds my showPaymentInfo function
           $controller = new paymentController(); 
           $paymentInfo = $controller->showPaymentInfo($request);

        return $paymentInfo;
    }
public function headings(): array
{
    return [
        'User Email',
        'User Phone Number',
        'First Name',
        'Last Name',
        'Place Name',
        'Place Location',
        'Amount',
        'Created At',
        'Paid Token'
    ];
}
    // private function getPaymentInfo()
    // {
    //     // $user = JWTAuth::parseToken()->authenticate();

    //     $payInfoQuery = DB::table('users')
    //         ->join('payments', 'users.id', '=', 'payments.user_id')
    //         ->join('places', 'payments.place_id', '=', 'places.id')
    //         ->join('tokens', 'payments.token_id', '=', 'tokens.id')
    //         ->where('users.id', $user=1)
    //         ->select('users.email', 'users.phone_number', 'users.first_name', 'users.last_name', 'places.place_name', 'places.place_location', 'payments.amount', 'payments.created_at', 'tokens.paid_token');

    //     // Add sorting logic

    //     $results = $payInfoQuery->get();

    //     return $results;
    
    // }
}
