<?php

namespace App\Exports;

use App\Models\Limbah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LimbahPerDriverExport implements FromQuery, WithMapping, WithHeadings
{
    protected $driverId;

    public function __construct($driverId)
    {
        $this->driverId = $driverId;
    }

    public function query()
    {
        return Limbah::where('driver_id', $this->driverId);
    }

    public function map($limbah): array
    {
        return [
            $limbah->customer->name,
            $limbah->code_manifest,
            $limbah->document_manifest,
            $limbah->weight_limbah,
            $limbah->pickup_1,
            $limbah->pickup_2,
            $limbah->pickup_3,
            $limbah->pickup_4,
            $limbah->date_pickup_1,
            $limbah->date_pickup_2,
            $limbah->date_pickup_3,
            $limbah->date_pickup_4,
            $limbah->driver->name,
            $limbah->province->name,
            $limbah->city->name,
            $limbah->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'Customer Name',
            'Code Manifest',
            'Document Manifest',
            'Weight',
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
}
