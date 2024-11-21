<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\B2B;
use App\Models\B2C;

class DataExport implements FromQuery, WithHeadings, WithTitle, WithStyles
{
    protected $pays;
    protected $type;

    /**
     * DataExport constructor.
     * 
     * @param string $pays
     * @param string $type
     */
    public function __construct($pays, $type)
    {
        $this->pays = $pays;
        $this->type = $type;
    }

    /**
     * Définir la requête pour récupérer les données
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = $this->type === 'b2b' ? B2B::class : B2C::class;
        
        return $model::query()
            ->whereHas('pays', function($query) {
                $query->where('name', $this->pays);
            });
    }

    /**
     * Définir les en-têtes des colonnes
     *
     * @return array
     */
    public function headings(): array
    {
        // Définir les en-têtes de colonne en fonction du modèle
        $model = $this->type === 'b2b' ? new B2B() : new B2C();
        return array_diff(array_keys($model->getAttributes()), ['id', 'pays_id', 'created_at', 'updated_at']);
    }

    /**
     * Définir le titre de l'onglet Excel
     *
     * @return string
     */
    public function title(): string
    {
        return $this->type === 'b2b' ? 'B2B Data' : 'B2C Data';
    }

    /**
     * Définir les styles du fichier Excel
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        // Appliquer des styles aux en-têtes
        $sheet->getStyle('A1:Z1')->getFont()->setBold(true); // En-têtes en gras
        $sheet->getStyle('A1:Z1')->getAlignment()->setHorizontal('center'); // Centrer les en-têtes
        
        // Appliquer un style pour la ligne entière de données
        $sheet->getStyle('A2:Z1000')->getAlignment()->setVertical('center');
        
        return [
            // Vous pouvez ajouter plus de styles pour les colonnes spécifiques
            // Par exemple : 'A' => ['font' => ['italic' => true]]
        ];
    }
}
