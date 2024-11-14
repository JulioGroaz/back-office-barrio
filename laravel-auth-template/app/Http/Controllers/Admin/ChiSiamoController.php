<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChiSiamo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChiSiamoController extends Controller
{
    /**
     * Display the "Chi Siamo" section if it exists, otherwise redirect to creation page.
     */
    public function index()
    {
        // Recupera la prima sezione "Chi Siamo"
        $chisiamo = ChiSiamo::first();

        if ($chisiamo) {
            // Se esiste, reindirizza alla pagina di modifica
            return redirect()->route('admin.chisiamo.edit', $chisiamo->id);
        } else {
            // Se non esiste, reindirizza alla pagina di creazione
            return redirect()->route('admin.chisiamo.create');
        }
    }

    /**
     * Show the form for creating a new section.
     */
    public function create()
    {
        return view('admin.chisiamo.createchisiamo');
    }

    /**
     * Store the newly created section.
     */
    public function store(Request $request)
    {
        // Validazione
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Crea una nuova sezione "Chi Siamo"
        $chisiamo = new ChiSiamo();
        $chisiamo->title = $request->title;
        $chisiamo->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $chisiamo->image_path = $imagePath;
        }

        $chisiamo->save();

        return redirect()->route('admin.chisiamo.index')->with('success', 'Sezione creata con successo!');
    }

    /**
     * Show the form for editing the existing section.
     */
    public function edit($id)
    {
        $chisiamo = ChiSiamo::findOrFail($id);
        return view('admin.chisiamo.editchisiamo', compact('chisiamo'));
    }

    /**
     * Update the specified section in storage.
     */
    public function update(Request $request, $id)
    {
        // Validazione
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $chisiamo = ChiSiamo::findOrFail($id);
        $chisiamo->title = $request->title;
        $chisiamo->description = $request->description;

        if ($request->hasFile('image')) {
            if ($chisiamo->image_path) {
                Storage::delete('public/' . $chisiamo->image_path);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $chisiamo->image_path = $imagePath;
        }

        $chisiamo->save();

        // Reindirizza alla pagina index dopo aver salvato le modifiche
        return redirect()->route('admin.chisiamo.index')->with('success', 'Sezione aggiornata con successo!');
    }

}
