<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function show(Request $request): View 
{
    
    $animals = Animal::with(['vacinas', 'category', 'fotos']);

    $query = Animal::query();

    if ($request->filled('animal') && $request->animal !== 'all') {
        $query->where('category_id', $request->animal);
    }

    if ($request->filled('sex') && $request->sex !== 'all') {
        $query->where('sexo', $request->sex);
    }

    if ($request->filled('age') && $request->age !== 'all') {
        $query->where('idade', $request->age);
    }

    if ($request->filled('size') && $request->size !== 'all') {
        $query->where('porte', $request->size);
    }

    $animals = $query->get();

    return view('pages.gallery', [
       'animals' => $animals,
    ]);

    
}
    
}