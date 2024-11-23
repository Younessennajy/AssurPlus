<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExport;
use App\Models\ImportHistory;
use App\Models\Pays;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ExportsController extends Controller
{
    public function export(Request $request, $pays, $type)
    {
        try {
            $format = $request->input('format', 'xlsx');
            $export = new DataExport($pays, $type);
            $fileName = strtolower($pays) . '_' . $type . '_' . date('Y-m-d') . '.' . $format;

            // Récupérer le pays
            $paysModel = Pays::where('name', $pays)->first();
            
            // Récupérer l'utilisateur connecté ou null
            $user = Auth::user();
            
            // Créer l'historique
            $history = new ImportHistory();
            $history->table_type = $type;
            $history->pays_id = $paysModel ? $paysModel->id : null;
            $history->user_name = $user ? $user->name : 'admin';
            $history->tag = $fileName;
            $history->action = 'export_' . $format;
            $history->save();

            return Excel::download($export, $fileName);

        } catch (\Exception $e) {
            // En cas d'erreur
            $user = Auth::user();
            
            // Créer l'historique d'erreur
            $history = new ImportHistory();
            $history->table_type = $type;
            $history->pays_id = isset($paysModel) ? $paysModel->id : null;
            $history->user_name = $user ? $user->name : 'admin';
            $history->tag = 'error_export';
            $history->action = 'export_failed';
            $history->save();

            return response()->json([
                'error' => 'Une erreur est survenue lors de l\'export',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}