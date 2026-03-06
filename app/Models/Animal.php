<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class Animal extends Model
{
    protected $fillable = [
        'nome',
        'category_id',
        'sexo',
        'coloracao',
        'idade',
        'porte',
        'storytelling',
        'observacoes',
        'comportamento',
        'data_entrada',
        'data_adocao',
        'disponivel',
        'microchip',
    ];

    public static function createNew(array $data = [])
    {
        $animal = self::create([
            'nome'  => $data['nome'],
            'category_id'  => $data['category_id'],
            'sexo' => $data['sexo'],
            'coloracao' => $data['coloracao'],
            'idade' => $data['idade'],
            'porte' => $data['porte'],
            'storytelling' => $data['storytelling'],
            'observacoes' => $data['observacoes'],
            'comportamento' => $data['comportamento'],
            'data_entrada' => $data['data_entrada'],
            'disponivel' => $data['disponivel'],
            'microchip' => (bool)(isset($data['microchip']) ? $data['microchip'] :false),
        ]);

        $animal->vacinas()->sync($data['vacinas'] ?? []);

        $new_fotos = json_decode($data['new_fotos']);

        foreach($new_fotos as $foto) {

        $foto_data = [];
        if(!file_exists($foto->path)){
            continue;
        }

        $foto_data['model_id'] = $animal->id;
        $foto_data['model_class'] = self::class;
    
        $path = Fotos::storeFoto((array)$foto);

        $foto_data['path'] = $path;

        Fotos::createNew($foto_data);
        }

        return $animal;
    }

       public static function deleteAnimal(int $id)
    {

        $animal = self::findOrFail($id);

        foreach ($animal->fotos as $foto) {
            Storage::disk('public')->delete($foto->path);
            $foto->delete();
        }

        return $animal->delete();
    }
    
    public static function updateAnimal(int $id, array $data = [])
    {

        $animal = self::findOrFail($id);

        $animal->update([
            'nome' => $data['nome'],
            'category_id' => $data['category_id'],
            'sexo' => $data['sexo'],
            'coloracao' => $data['coloracao'],
            'idade' => $data['idade'],
            'porte' => $data['porte'],
            'storytelling' => $data['storytelling'],
            'observacoes' => $data['observacoes'],
            'comportamento' => $data['comportamento'],
            'data_entrada' => $data['data_entrada'],
            'data_adocao' => $data['data_adocao'],
            'disponivel' => $data['disponivel'], 
            'microchip' => (bool)(isset($data['microchip']) ? $data['microchip'] :false),
        ]);

        $animal->vacinas()->sync($data['vacinas'] ?? []);

        $new_fotos = json_decode($data['new_fotos']);

        foreach($new_fotos as $foto) {

        $foto_data = [];
        if(!file_exists($foto->path)){
            continue;
        }

        $foto_data['model_id'] = $animal->id;
        $foto_data['model_class'] = self::class;
    
        $path = Fotos::storeFoto((array)$foto);

        $foto_data['path'] = $path;

        Fotos::createNew($foto_data);
        }

        return $animal;
        
    }

    public static function getAllAnimals(){
        $result = FacadesDB::table('animals')
        ->select()
        ->get()
        ->toArray();

        return $result;
    }


    public function vacinas()
    {
        return $this->belongsToMany(Vacina::class, 'animal_vacina');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function fotos()
    {
        return $this->morphMany(Fotos::class, 'foto_model');
    }
}
