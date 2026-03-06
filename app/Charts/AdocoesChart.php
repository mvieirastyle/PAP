<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Animal;

class AdocoesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($startDate = null, $endDate = null): \ArielMejiaDev\LarapexCharts\AreaChart
    {
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

        $labels = [];
        $counts = [];

        foreach ($data as $row) {
            $monthName = \Carbon\Carbon::create()
                ->month($row->month)
                ->translatedFormat('M');

            $labels[] = $monthName . '/' . $row->year;
            $counts[] = $row->total;
        }

        return $this->chart->areaChart()
            ->setTitle('Quantidade de Animais Adotados por Mês')
            ->addData($counts, 'Adoções')
            ->setXAxis($labels)
            ->setColors(['#00aa69'])
            ->setGrid(color: '#ffaf46', opacity: 0.1, strokeDashArray: 10);
    }
}
