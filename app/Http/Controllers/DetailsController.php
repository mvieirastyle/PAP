<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Fotos;
use Illuminate\Http\Request;

class DetailsController extends Controller
{

    public function show(int $id) {

        $animal = Animal::with('category')->find($id); 
        
        return view('pages.details', [
            'animal' => $animal,
        ]);
    }

    
    public function store(Request $request, int $id)
    {

        $path = $request->file('image')->store('images','public');
        
        $fotos = Fotos::create(['path'=> $path, 'foto_model_type'=> Animal::class, 'foto_model_id'=> $id]);
        
        return redirect('/animal/' . $id);
    }
}
