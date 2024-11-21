<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExport;

class ExportsController extends Controller
{
    public function export(Request $request, $pays, $type)
    {
        $format = $request->input('format', 'xlsx');
        
        // Créer l'exportation en passant le pays et le type
        $export = new DataExport($pays, $type);
        
        // Nom du fichier
        $fileName = strtolower($pays) . '_' . $type . '_' . date('Y-m-d') . '.' . $format;
        
        // Retourner le téléchargement du fichier
        return Excel::download($export, $fileName);
    }
}
