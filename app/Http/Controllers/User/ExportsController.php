<?php

namespace App\Http\Controllers\User;

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
    
            // Calculer le total des enregistrements exportés
            $totalRecords = $export->query()->count();
    
            // Récupérer l'utilisateur connecté ou null
            $user = Auth::user();
    
            // Créer l'historique
            $history = new ImportHistory();
            $history->table_type = $type;
            $history->pays_id = $paysModel ? $paysModel->id : null;
            $history->user_name = $user ? $user->name : 'admin';
            $history->tag = $fileName;
            $history->action = 'export_' . $format;
            $history->total_records = $totalRecords; // Enregistrer le total des enregistrements
            $history->save();
    
            // Gestion du format TXT
            if ($format === 'txt') {
                return $this->exportToTxt($export, $fileName);
            }
    
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
            $history->total_records = 0; // Aucun enregistrement exporté
            $history->save();
    
            return response()->json([
                'error' => 'Une erreur est survenue lors de l\'export',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    

    private function exportToTxt(DataExport $export, string $fileName)
    {
        // Récupérer les données et les en-têtes
        $data = $export->query()->get()->toArray();
        $headers = $export->headings();
    
        // Définir les largeurs de colonnes (à ajuster selon vos besoins)
        $columnWidths = [20, 25, 25, 25, 25, 25, 25, 25, 25];
    
        // Fonction pour formater chaque cellule avec une largeur fixe
        $formatCell = function ($value, $width) {
            return str_pad(substr((string)$value, 0, $width), $width, ' ', STR_PAD_RIGHT);
        };
    
        // Formater les en-têtes
        $content = '';
        foreach ($headers as $index => $header) {
            $content .= $formatCell($header, $columnWidths[$index] ?? 20);
        }
        $content .= "\r\n";
    
        // Ajouter une ligne de séparation
        $content .= str_repeat('-', array_sum($columnWidths)) . "\r\n";
    
        // Formater les lignes de données
        foreach ($data as $row) {
            $rowArray = array_values($row); // Convertir en tableau indexé
            foreach ($rowArray as $index => $value) {
                $content .= $formatCell($value, $columnWidths[$index] ?? 20);
            }
            $content .= "\r\n";
        }
    
        // Retourner une réponse avec le fichier TXT
        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', "attachment; filename=\"$fileName\"");
    }
    
}
