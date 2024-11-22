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

    public function __construct($pays, $type)
    {
        $this->pays = $pays;
        $this->type = $type;
    }

    public function query()
    {
        $model = $this->type === 'b2b' ? B2B::class : B2C::class;
        
        return $model::query()
            ->select($this->getSelectColumns())
            ->join('pays', 'pays.id', '=', $this->type.'.pays_id')
            ->whereHas('pays', function($query) {
                $query->where('name', $this->pays);
            });
    }

    private function getSelectColumns()
    {
        if ($this->type === 'b2c') {
            return [
                'b2c.id',
                'b2c.first_name',
                'b2c.last_name', 
                'b2c.address',
                'b2c.postal_code',
                'b2c.ville',
                'b2c.phone',
                'b2c.gsm',
                'pays.name as pays'
            ];
        } else {
            return [
                'b2b.id',
                'b2b.raison_social',
                'b2b.dirigeant_name',
                'b2b.dirigeant_prenom',
                'b2b.address',
                'b2b.postal_code', 
                'b2b.ville',
                'b2b.phone',
                'b2b.gsm',
                'pays.name as pays'
            ];
        }
    }

    public function headings(): array
    {
        if ($this->type === 'b2c') {
            return [
                'ID',
                'Prénom',
                'Nom',
                'Adresse',
                'Code postal',
                'Ville', 
                'Téléphone fixe',
                'Téléphone mobile',
                'Pays'
            ];
        } else {
            return [
                'ID',
                'Raison sociale',
                'Nom dirigeant',
                'Prénom dirigeant', 
                'Adresse',
                'Code postal',
                'Ville',
                'Téléphone fixe',
                'Téléphone mobile',
                'Pays'
            ];
        }
    }

    public function title(): string
    {
        return $this->type === 'b2b' ? 'Données B2B' : 'Données B2C';
    }

    public function styles(Worksheet $sheet)
    {
        $lastCol = $this->type === 'b2c' ? 'I' : 'J';

        $sheet->getStyle('A1:'.$lastCol.'1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ]);

        $sheet->getRowDimension(1)->setRowHeight(30);

        foreach (range('A', $lastCol) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:'.$lastCol.$lastRow)->applyFromArray([
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC']
                ]
            ]
        ]);

        for ($row = 2; $row <= $lastRow; $row++) {
            if ($row % 2 == 0) {
                $sheet->getStyle('A'.$row.':'.$lastCol.$row)->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'F5F5F5']
                    ]
                ]);
            }
        }

        return [];
    }
}