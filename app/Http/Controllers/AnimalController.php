<?php

namespace App\Http\Controllers;

use App\Exports\AnimalsChartExport;
use App\Http\Requests\AnimalRequest;
use App\Models\Animal;
use App\Models\Category;
use App\Models\Fotos;
use App\Models\Vacina;
use App\Exports\AnimalsExport;
use App\Exports\AnimalsExport as ExportsAnimalsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;

class AnimalController extends Controller
{

    public function show()
    {
        $animals = Animal::all();
        return view('pages.admin.animal.list', [
            'animals' => $animals,
        ]);
    }

    public function showAdd()
    {
        $animals = Animal::with(['vacinas', 'category', 'fotos']);
        $categories = Category::all();
        $vacinas = Vacina::all();
        $fotos = Fotos::all();

        $animals = Animal::all();
        return view('pages.admin.animal.add', [
            'animals' => $animals,
            'categories' => $categories,
            'vacinas' => $vacinas,
            'fotos' => $fotos,
        ]);
    }

    public function add(AnimalRequest $request)
    {
        $request->validated();

        Animal::createNew($request->all());

        return redirect('/admin/animal/list')->with('success', 'Animal adicionado com sucesso');
    }


    public function showEdit(int $id)
    {
        $animal = Animal::with(['vacinas', 'category', 'fotos'])->find($id);
        $categories = Category::all();
        $vacinas = Vacina::all();
        $vacinasSelecionadas = $animal->vacinas->pluck('id')->toArray();


        return view('pages.admin.animal.edit', [
            'animal' => $animal,
            'categories' => $categories,
            'vacinas' => $vacinas,
            'vacinasSelecionadas' => $vacinasSelecionadas,
        ]);
    }


    public function update(AnimalRequest $request, int $id)
    {

        $request->validated();

        Animal::updateAnimal($id, $request->all());

        return redirect('/admin/animal/list')->with('success', 'Animal editado com sucesso');
    }

    public function delete($id)
    {
        Animal::deleteAnimal($id);

        return redirect('/admin/animal/list')->with('success', 'Animal removido com sucesso');
    }

    public function exportExcel()
    {

        return Excel::download(new AnimalsExport, 'animais-excel.xlsx');
    }

    public function generatePdf(Animal $animals)
    {
        $pdf = Pdf::loadView('pages.admin.animal.generate-pdf', ['animals' => $animals->all()]);

        return $pdf->download('relatorio-animais.pdf');
    }

    public function generatePdfAnimalsChart(array $rows = [])
    {
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

        $pdf = Pdf::loadView('pages.admin.pdf-animais', ['rows' => $rows]);

        return $pdf->download('relatorio-animais-grafico.pdf');

    }

    public function generatePdfAdocoesChart($startDate = null, $endDate = null)
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

        $rows = [];

        foreach ($data as $row) {
            $monthName = \Carbon\Carbon::create()->month($row->month)->translatedFormat('M');

            $rows[] = [
                'Mês/ano' => $monthName . '/' . $row->year,
                'Qnt. Adoções' => $row->total,
            ];
        }

        $pdf = Pdf::loadView('pages.admin.pdf-adocoes', ['rows' => $rows]);

        return $pdf->download('relatorio-adocoes-grafico.pdf');
    }
}
