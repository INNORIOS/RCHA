<?php

namespace App\Http\Controllers\RCHAcontroller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\paymentInfoExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class paymentInfoExportController extends Controller
{
    public function export()
    {
        // $checksum = md5_file(storage_path('app/exported/payments.xlsx'));

        // return Excel::download(new paymentInfoExport, 'payments.xlsx');
        // Generate and store the file
        $filePath = 'exports/payments.xlsx';
        Excel::store(new paymentInfoExport, $filePath);

        // Calculate checksum
        $checksum = md5_file(storage_path('app/' . $filePath));

        // Return the download response
        return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend(true);
 
        
    }  
}
