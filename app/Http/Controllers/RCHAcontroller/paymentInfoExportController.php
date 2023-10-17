<?php

namespace App\Http\Controllers\RCHAcontroller;

use Illuminate\Http\Request;
// use App\Exports\paymentInfoExport;
use App\Exports\PaymentInfoExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class paymentInfoExportController extends Controller
{
//     public function export()
//     {
//         // $checksum = md5_file(storage_path('app/exported/payments.xlsx'));

//         return Excel::download(new paymentInfoExport, 'payments.xlsx');
//         // Generate and store the file
// //         $filePath = 'exports/payments.xlsx';
// //         $excel=Excel::store(new paymentInfoExport, $filePath);
// // //dd($excel);
// //         // Calculate checksum
// //         $checksum = md5_file(storage_path('app/' . $filePath));

//         // Return the download response
//         return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend(true);
 
        
//     }  
public function exportPaymentInfo()
{
    return Excel::download(new PaymentInfoExport, 'payment-info.xlsx');
}
}
