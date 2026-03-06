<?php

namespace App\Charts;

use App\Models\Animal;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Carbon;

class EntradasChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($startDate = null, $endDate = null): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $labels = [];
        $counts = [
            'Cães' => [],
            'Gatos' => [],
        ];

        $query = Animal::query();

        if ($startDate) {
            $query->whereDate('data_entrada', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('data_entrada', '<=', $endDate);
        }


        $data = $query->selectRaw("
                YEAR(data_entrada) as year,
                MONTH(data_entrada) as month,
                category_id,
                COUNT(*) as total
            ")
            ->groupBy('year', 'month', 'category_id')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $months = [];

        foreach ($data as $row) {
            $monthKey = $row->month . '-' . $row->year;
            $months[$monthKey]['month'] = $row->month;
            $months[$monthKey]['year'] = $row->year;
            $months[$monthKey][$row->category_id] = $row->total; 
        }

        foreach ($months as $monthKey => $monthData) {
            $monthName = Carbon::create()->month($monthData['month'])->translatedFormat('M');
            $labels[] = $monthName . '/' . $monthData['year'];

            $counts['Cães'][] = $monthData[1] ?? 0;  
            $counts['Gatos'][] = $monthData[2] ?? 0;  
        }

        $lineChart = $this->chart->lineChart()
            ->setTitle('Quantidade de Animais Acolhidos por Mês')
            ->setXAxis($labels)
            ->setGrid(color: '#ffdeb8', opacity: 0.1, strokeDashArray: 10)
            ->setColors(['#00aa69', '#ffaf46']);

        foreach ($counts as $label => $data) {
            $lineChart->addData($data, $label);
        }

        return $lineChart;
    }
}
