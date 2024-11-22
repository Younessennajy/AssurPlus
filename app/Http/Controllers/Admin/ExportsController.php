<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExport;
use App\Models\ImportHistory;
use App\Models\Pays;
use Illuminate\Support\Facades\Auth;

class ExportsController extends Controller
{
    public function export(Request $request, $pays, $type)
    {
        try {
            $format = $request->input('format', 'xlsx');
            $export = new DataExport($pays, $type);
            $fileName = strtolower($pays) . '_' . $type . '_' . date('Y-m-d') . '.' . $format;

            // Récupérer l'ID du pays
            $paysModel = Pays::where('name', $pays)->first();
            
            // Enregistrer l'action d'export
            ImportHistory::create([
                'table_type' => $type,
                'pays_id' => $paysModel->id,
                'user_name' => Auth::user() ? Auth::user()->name : 'admin',
                'tag' => $fileName,
                'action' => 'export_' . $format
            ]);

            return Excel::download($export, $fileName);

        } catch (\Exception $e) {
            // En cas d'erreur, on enregistre quand même l'action avec une indication d'échec
            ImportHistory::create([
                'table_type' => $type,
                'pays_id' => $paysModel->id ?? null,
                'user_name' => Auth::user() ? Auth::user()->name : 'admin',
                'tag' => 'error_' . $fileName,
                'action' => 'export_failed_' . $format
            ]);

            // Retourner une réponse d'erreur
            return response()->json([
                'error' => 'Une erreur est survenue lors de l\'export',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}