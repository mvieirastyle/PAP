<?php

namespace App\Exports;

use App\Models\Animal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AnimalsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Animal::with('category')->get()->map(function ($animal) {
            return [
                'id' => $animal->id,
                'nome' => $animal->nome,
                'categoria' => $animal->category->type ?? '',
                'sexo' => $animal->sexo,
                'coloracao' => $animal->coloracao,
                'idade' => $animal->idade,
                'porte' => $animal->porte,
                'storytelling' => $animal->storytelling,
                'observacoes' => $animal->observacoes,
                'comportamento' => $animal->comportamento,
                'data_entrada' => $animal->data_entrada,
                'disponivel' => $animal->disponivel ? 'Sim' : 'Não',
                'microchip' => $animal->microchip ? 'Sim' : 'Não',
                'data_adocao' => $animal->data_adocao,
                'created_at' => $animal->created_at,
                'updated_at' => $animal->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nome',
            'Categoria',
            'Sexo',
            'Coloração',
            'Idade',
            'Porte',
            'História',
            'Observações',
            'Comportamento',
            'Data de Entrada',
            'Disponível',
            'Microchip',
            'Data de Adoção',
            'Criado em',
            'Atualizado em',
        ];
    }
}
