<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuControllerApi extends Controller
{
    /**
     * Restituisci i menu filtrati per categoria.
     */
public function index(Request $request)
{
    // Filtra i menu in base alla categoria o alle sottocategorie di vini
    if ($request->has('category')) {
        if ($request->category === 'vini') {
            $menus = Menu::whereIn('category', ['vini_rossi', 'vini_bianchi', 'vini_rose', 'vini_bollicine'])->get();
        } else {
            $menus = Menu::where('category', $request->category)->get();
        }
    } else {
        $menus = Menu::all();
    }

    // Costruisci il percorso completo delle immagini
    foreach ($menus as $menu) {
        // Controlla se esiste un immagine per questo menu
        if ($menu->image_path) {
            $menu->image_path = asset('storage/' . $menu->image_path);
        }
    }

    return response()->json($menus);
}

    /**
     * Restituisci le categorie come JSON.
     */
    public function getCategories()
    {
        // Definisci le categorie principali e le sottocategorie di vini
        $categories = [
            ['id' => 1, 'name' => 'analcolici'],
            ['id' => 2, 'name' => 'caffetteria'],
            ['id' => 3, 'name' => 'birre'],
            ['id' => 4, 'name' => 'aperitivi'],
            ['id' => 5, 'name' => 'vini'], // Categoria principale "vini"
            ['id' => 6, 'name' => 'cocktail'],
            ['id' => 7, 'name' => 'superalcolici'],
            ['id' => 8, 'name' => 'food'],
        ];


        return response()->json($categories);
    }
}
