<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentInfoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Payment::all();
    }
    // public function headings(): array
    // {
    //     return [
    //         'First Name',
    //         'Last Name',
    //         'Email',
    //         'Phone Number',
    //         'Place Location',
    //         'Token ID',
    //         'Amount',
    //         'Created Date',
    //     ];
    // }
}
