<?php

namespace App\Exports;

use App\Models\Limbah;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class LimbahPerProvinceExport implements FromQuery, WithMapping, WithHeadings, WithStyles, ShouldAutoSize, WithColumnFormatting
{
    protected $provinceId;

    public function __construct($provinceId)
    {
        $this->provinceId = $provinceId;
    }

    public function query()
    {
        return Limbah::where('province_id', $this->provinceId);
    }

    public function map($limbah): array
    {
        return [
            $limbah->customer->name,
            $limbah->code_manifest,
            basename($limbah->document_manifest), // Display only the file name
            $limbah->weight_limbah,
            $limbah->pickup_1,
            $limbah->pickup_2,
            $limbah->pickup_3,
            $limbah->pickup_4,
            optional($limbah->date_pickup_1)->format('d-m-Y'),
            optional($limbah->date_pickup_2)->format('d-m-Y'),
            optional($limbah->date_pickup_3)->format('d-m-Y'),
            optional($limbah->date_pickup_4)->format('d-m-Y'),
            $limbah->driver->name,
            $limbah->province->name,
            $limbah->city->name,
            Carbon::parse($limbah->created_at)->format('d-m-Y'),
        ];
    }

    public function headings(): array
    {
        return [
            'Customer Name',
            'Code Manifest',
            'Document Manifest',
            'Weight (kg)',
            'Pickup 1',
            'Pickup 2',
            'Pickup 3',
            'Pickup 4',
            'Date Pickup 1',
            'Date Pickup 2',
            'Date Pickup 3',
            'Date Pickup 4',
            'Driver Name',
            'Province',
            'City',
            'Created At',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Freeze the header row
        $sheet->freezePane('A2');

        // Style the header row
        $sheet->getStyle('A1:P1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '4CAF50'],
            ],
        ]);

        return [
            'A1:P1' => ['font' => ['bold' => true]], // Apply bold font to header
        ];
    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY, // Date Pickup 1
            'J' => NumberFormat::FORMAT_DATE_DDMMYYYY, // Date Pickup 2
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY, // Date Pickup 3
            'L' => NumberFormat::FORMAT_DATE_DDMMYYYY, // Date Pickup 4
            'P' => NumberFormat::FORMAT_DATE_DDMMYYYY, // Created At
        ];
    }
}
