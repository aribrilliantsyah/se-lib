<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BorrowLogExport implements FromView 
{
    protected $month, $year, $borrow_log;

    function __construct($month, $year, $borrow_log) {
        $this->month = $month;
        $this->year = $year;
        $this->borrow_log = $borrow_log;
    }

    public function view(): View
    {
        return view('excel.borrow_log', [
            'month' => $this->month,
            'year' => $this->year,
            'borrow_log' => $this->borrow_log,
        ]);
    }
}