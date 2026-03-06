<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Animal;
use App\Models\Category;

class AnimalsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $labels = [];
        $maleData = [];
        $femaleData = [];

        $categories = Category::pluck('type', 'id')->toArray();

        $counts = Animal::where('disponivel', true)
            ->selectRaw('category_id, sexo, COUNT(*) as total')
            ->groupBy('category_id', 'sexo')
            ->get();

        $grouped = [];

        foreach ($counts as $row) {
            $grouped[$row->category_id][$row->sexo] = $row->total;
        }

        foreach ($categories as $id => $name) {
            $labels[] = $name;

            $maleData[] = $grouped[$id]['Macho'] ?? 0;
            $femaleData[] = $grouped[$id]['Fêmea'] ?? 0;
        }

        return $this->chart->barChart()
            ->setTitle('Quantidade de Animais por Tipo e Sexo')
            ->addData($maleData, 'Machos')
            ->addData($femaleData, 'Fêmeas')
            ->setColors(['#00aa69', '#ffaf46'])
            ->setXAxis($labels);
    }
}
