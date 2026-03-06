<?php

namespace App\Exports;

use App\Models\Animal;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AnimalsChartExport implements FromCollection, WithHeadings
{
   /**
    * @return \Illuminate\Support\Collection
    */

    public function collection(){

    $rows = [];

    $categories = Category::pluck('type', 'id')->toArray();

    $counts = Animal::selectRaw('category_id, sexo, COUNT(*) as total')
        ->groupBy('category_id', 'sexo')
        ->get();


    $grouped = [];

    foreach ($counts as $count) {
        $grouped[$count->category_id][$count->sexo] = $count->total;
    }

    foreach ($categories as $id => $name) {
        $rows[] = [
            'tipo' => $name,
            'machos' => $grouped[$id]['Macho'] ?? 0,
            'femeas' => $grouped[$id]['Fêmea'] ?? 0,
        ];
    }

    return new Collection($rows);
}

public function headings(): array
{
    return [
        'Tipo de Animal',
        'Machos',
        'Fêmeas'
    ];
}

}

