<?php

namespace App\Charts;

use App\Models\Animal;
use App\Models\Category;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MicrochipsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }
    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $labels = [];
        $data = [];

        $categories = Category::pluck('type', 'id')->toArray();

        $counts = Animal::where('microchip', true)
            ->selectRaw('category_id, COUNT(*) as total')
            ->groupBy('category_id')
            ->get()
            ->keyBy('category_id');

        foreach ($categories as $id => $name) {
            $labels[] = $name;
            $data[] = $counts[$id]->total ?? 0;
        }

        return $this->chart->pieChart()
            ->setTitle('Quantidade de Animais com Microchip por Tipo')
            ->addData($data)
            ->setLabels($labels)
            ->setColors(['#00aa69', '#ffaf46', '#008ffb']);
    }
}
