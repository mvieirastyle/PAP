<?php

namespace App\Http\Controllers;

use App\Charts\AdocoesChart;
use App\Models\Animal;
use App\Charts\AnimalsChart;
use App\Charts\EntradasChart;
use App\Charts\MicrochipsChart;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show()
    {
        $animals = Animal::all();
        return view('pages.admin.dashboard', [
            'animals' => $animals,
        ]);
    }

    public function dashboard(AnimalsChart $chartAnimals, AdocoesChart $chartAdocoes, EntradasChart $chartEntradas, MicrochipsChart $chartMicrochips, Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        return view('pages.admin.dashboard', [
            'chartAnimals' => $chartAnimals->build(),
            'chartMicrochips' => $chartMicrochips->build(),
            'chartAdocoes' => $chartAdocoes->build($start,$end),
            'chartEntradas' => $chartEntradas->build($start,$end),
        ]);
    }
}
