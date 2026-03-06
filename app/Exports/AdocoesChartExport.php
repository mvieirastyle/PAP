<?php

namespace App\Exports;

use App\Models\Animal;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdocoesChartExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection($startDate = null, $endDate = null)
    {
        $rows = [];

        $query = Animal::whereNotNull('data_adocao');

        if ($startDate) {
            $query->whereDate('data_adocao', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('data_adocao', '<=', $endDate);
        }

        $data = $query->selectRaw("
                YEAR(data_adocao) as year,
                MONTH(data_adocao) as month,
                COUNT(*) as total
            ")
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        foreach ($data as $row) {
            $monthName = \Carbon\Carbon::create()
                ->month($row->month)
                ->translatedFormat('M');

            $rows[] = [
                'Mês/ano' => $monthName . '/' . $row->year,
                'Qnt. Adoções' => $row->total,
            ];
        }

        return new Collection($rows);
    }

    public function headings(): array
    {
        return [
            'Mês/ano',
            'Quantidade de adoções',
        ];
    }
}
