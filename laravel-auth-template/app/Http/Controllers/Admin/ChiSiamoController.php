<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChiSiamo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChiSiamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera tutte le sezioni "Chi Siamo" (anche se ce ne sarà solo una)
        //$chisiamo = ChiSiamo::all();
        $chisiamo = ChiSiamo::orderBy('created_at', 'desc')->get();
        return view('admin.chisiamo.indexchisiamo', compact('chisiamo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Verifica se esiste già una sezione "Chi Siamo"
        $existingSection = ChiSiamo::first();

        if ($existingSection) {
            // Se esiste, reindirizza alla pagina di modifica
            return redirect()->route('admin.chisiamo.edit', $existingSection)->with('warning', 'Puoi solo modificare la sezione esistente.');
        }

        // Se non esiste, mostra la vista di creazione
        return view('admin.chisiamo.createchisiamo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida i dati
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Crea una nuova sezione "Chi Siamo"
        $chisiamo = new ChiSiamo();
        $chisiamo->title = $request->title;
        $chisiamo->description = $request->description;

        // Gestione dell'immagine
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $chisiamo->image_path = $imagePath;
        }

        // Salva la nuova sezione nel database
        $chisiamo->save();

        // Reindirizza alla lista delle sezioni con un messaggio di successo
        return redirect()->route('admin.chisiamo.index')->with('success', 'Sezione creata con successo');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Recupera la sezione "Chi Siamo" esistente
        $chisiamo = ChiSiamo::findOrFail($id);

        // Mostra la vista di modifica
        return view('admin.chisiamo.editchisiamo', compact('chisiamo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Valida i dati
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Recupera la sezione "Chi Siamo" esistente
        $chisiamo = ChiSiamo::findOrFail($id);

        // Aggiorna i dati
        $chisiamo->title = $request->title;
        $chisiamo->description = $request->description;

        // Gestione dell'immagine
        if ($request->hasFile('image')) {
            // Rimuovi la vecchia immagine se esiste
            if ($chisiamo->image_path) {
                Storage::delete('public/' . $chisiamo->image_path);
            }

            // Carica la nuova immagine
            $imagePath = $request->file('image')->store('images', 'public');
            $chisiamo->image_path = $imagePath;
        }

        // Salva le modifiche
        $chisiamo->save();

        // Reindirizza con un messaggio di successo
        return redirect()->route('admin.chisiamo.index')->with('success', 'Sezione aggiornata con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Recupera la sezione "Chi Siamo"
        $chisiamo = ChiSiamo::findOrFail($id);

        // Rimuovi l'immagine se esiste
        if ($chisiamo->image_path) {
            Storage::delete('public/' . $chisiamo->image_path);
        }

        // Elimina la sezione
        $chisiamo->delete();

        // Reindirizza alla lista con un messaggio di successo
        return redirect()->route('admin.chisiamo.index')->with('success', 'Sezione eliminata con successo');
    }
}
