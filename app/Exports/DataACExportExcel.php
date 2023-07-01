<?php

namespace App\Exports;

use App\Models\AC;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataACExportExcel implements \Maatwebsite\Excel\Concerns\FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('dataAC.exportExcel', [
            'dataExport' => AC::all()
        ]);
    }
}
