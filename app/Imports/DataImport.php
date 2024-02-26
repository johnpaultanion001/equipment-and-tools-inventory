<?php

namespace App\Imports;

use App\Models\Equipment;

use App\Traits\HandleDateParsing;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToCollection, WithHeadingRow
{
    use HandleDateParsing;

    public function collection(Collection $collection)
    {

        foreach ($collection as $row) {
            DB::beginTransaction();

            $equipment = [
                'item' => $row['item'],
                'brand' => $row['brand'],
                'color' => $row['color'],
                'quantity' => $row['quantity'],
                'status' => $row['status'],
                'available' => $row['available'],
                'in_out' => $row['in_out'],
                'reason' => $row['reason'],
                'note' => $row['note'],

            ];

            Equipment::create($equipment);
            DB::commit();
        }

    }
}
