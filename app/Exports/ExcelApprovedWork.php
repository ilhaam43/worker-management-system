<?php

namespace App\Exports;

use App\Models\Job;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExcelApprovedWork implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($listApprovedWork, $i)
    {
        $this->listApprovedWork = $listApprovedWork;
        $this->i = $i;
    }

    public function view(): View
    {   
        $data = $this->listApprovedWork;
        $i = $this->i;

        return view('admin.work.exports.excelApproved', [
            'data' => $data,
            'i' => $i
        ]);        
    }
}
