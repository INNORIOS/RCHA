<?php

namespace App\Http\Controllers\RCHAcontroller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\paymentInfoExport;
use Maatwebsite\Excel\Facades\Excel;

class paymentInfoExportController extends Controller
{
    public function export()
    {
        return Excel::download(new paymentInfoExport, 'payments.xlsx');
    }  
}
