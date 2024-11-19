<?php
namespace App\Services;

use Maatwebsite\Excel\Facades\Excel;

class ExcelService
{
    public function readHeaders($file)
    {
        $excel = Excel::toArray([], $file);
        return $excel[0][0] ?? [];
    }

    public function readData($file)
    {
        $excel = Excel::toArray([], $file);
        return $excel[0] ?? [];
    }
}
