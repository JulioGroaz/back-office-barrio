<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Definisci le categorie disponibili
    $categories = [
        'caffetteria',
        'aperitivi',
        'vini_bianchi',
        'vini_rossi',
        'vini_rose',
        'vini_bollicine',
        'cocktail',
        'superalcolici',
        'food'
    ];

    // Filtra i prodotti in base alle categorie selezionate
    if ($request->has('categories')) {
        $filteredMenus = Menu::whereIn('category', $request->categories)->orderBy('category')->get();
    } else {
        // Se nessuna categoria è selezionata, mostra tutti i prodotti
        $filteredMenus = Menu::orderBy('category')->get();
    }

    // Passa i dati alla vista
    return view('admin.menues.indexmenu', compact('filteredMenus', 'categories'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostra la vista per creare un nuovo prodotto del menu
        $categories = [
            'caffetteria',
            'aperitivi',
            'vini_bianchi',
            'vini_rossi',
            'vini_rose',
            'vini_bollicine',
            'cocktail',
            'superalcolici',
            'food'
        ];

        return view('admin.menues.createmenu', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida i dati in ingresso
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Crea un nuovo prodotto del menu
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->category = $request->category;

        // Gestione dell'immagine
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $menu->image_path = $imagePath;
        }

        // Salva il prodotto nel database
        $menu->save();

        // Reindirizza alla lista dei prodotti con messaggio di successo
        return redirect()->route('admin.menues.index')->with('success', 'Prodotto creato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Recupera il menu dal database usando l'ID
        $menu = Menu::findOrFail($id);

        // Passa il menu alla vista
        return view('admin.menues.showmenu', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Recupera il prodotto dal database
        $menu = Menu::findOrFail($id);

        // Definisci le categorie disponibili
        $categories = [
            'caffetteria',
            'aperitivi',
            'vini_bianchi',
            'vini_rossi',
            'vini_rose',
            'vini_bollicine',
            'cocktail',
            'superalcolici',
            'food'
        ];

        // Passa i dati alla vista per modificarli
        return view('admin.menues.editmenu', compact('menu', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Valida i dati in ingresso
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Recupera il prodotto dal database
        $menu = Menu::findOrFail($id);

        // Aggiorna i dati del menu
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->category = $request->category;

        // Gestione dell'immagine
        if ($request->hasFile('image')) {
            // Rimuovi la vecchia immagine se esiste
            if ($menu->image_path) {
                Storage::delete('public/images/' . $menu->image_path);
            }

            // Carica la nuova immagine
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $filename);

            // Aggiorna il percorso dell'immagine nei dati
            $menu->image_path = $filename;
        }

        // Salva le modifiche al menu
        $menu->save();

        // Reindirizza alla pagina del prodotto aggiornato
        return redirect()->route('admin.menues.show', $menu->id)->with('success', 'Prodotto aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Recupera il prodotto dal database
        $menu = Menu::findOrFail($id);

        // Rimuovi l'immagine se esiste
        if ($menu->image_path) {
            Storage::delete('public/images/' . $menu->image_path);
        }

        // Elimina il prodotto dal database
        $menu->delete();

        // Reindirizza alla lista dei prodotti con un messaggio di successo
        return redirect()->route('admin.menues.index')->with('success', 'Prodotto eliminato con successo');
    }
}
