<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExport;

class ExportsController extends Controller
{
    public function export(Request $request, $pays, $type)
    {
        $format = $request->input('format', 'xlsx');
        
        $export = new DataExport($pays, $type);
        
        $fileName = strtolower($pays) . '_' . $type . '_' . date('Y-m-d') . '.' . $format;
        
        return Excel::download($export, $fileName);
    }
}
