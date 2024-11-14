<?php

namespace App\Http\Controllers\Admin;

use App\Models\Eventi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ordina gli eventi per data e ora in ordine discendente
        $events = Eventi::orderBy('event_date_time', 'desc')->get();
        return view('admin.events.indexevents', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostra la vista per creare un nuovo evento
        return view('admin.events.createevents');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida i dati in ingresso
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date_time' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Crea un nuovo evento
        $event = new Eventi();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->event_date_time = $request->event_date_time;

        // Gestione dell'immagine
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Salva in 'storage/app/public/images'
            $event->image_path = $imagePath; // Salva il percorso completo nel database
        }

        // Salva l'evento
        $event->save();

        // Reindirizza alla lista degli eventi con messaggio di successo
        return redirect()->route('admin.events.index')->with('success', 'Evento creato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Recupera l'evento da visualizzare
        $event = Eventi::findOrFail($id);

        // Passa l'evento alla vista 'showevents'
        return view('admin.events.showevents', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Recupera l'evento da modificare
        $event = Eventi::findOrFail($id);

        // Passa l'evento alla vista per modificarlo
        return view('admin.events.editevents', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Valida i dati in ingresso
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date_time' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Recupera l'evento dal database
        $event = Eventi::findOrFail($id);

        // Gestione dell'immagine
        if ($request->hasFile('image')) {
            // Rimuovi la vecchia immagine se esiste
            if ($event->image_path && Storage::exists('public/' . $event->image_path)) {
                Storage::delete('public/' . $event->image_path);
            }

            // Carica la nuova immagine
            $imagePath = $request->file('image')->store('images', 'public'); // Salva in 'storage/app/public/images'

            // Aggiorna il percorso dell'immagine nei dati
            $event->image_path = $imagePath; // Salva il percorso completo nel database
        }

        // Aggiorna i dati dell'evento
        $event->title = $request->title;
        $event->description = $request->description;
        $event->event_date_time = $request->event_date_time;

        // Salva le modifiche all'evento
        $event->save();

        // Reindirizza alla pagina 'show' dell'evento aggiornato
        return redirect()->route('admin.events.show', $event->id)->with('success', 'Evento aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recupera l'evento dal database
        $event = Eventi::findOrFail($id);

        // Rimuovi l'immagine se esiste
        if ($event->image_path && Storage::exists('public/' . $event->image_path)) {
            Storage::delete('public/' . $event->image_path);
        }

        // Elimina l'evento dal database
        $event->delete();

        // Reindirizza alla lista degli eventi con un messaggio di successo
        return redirect()->route('admin.events.index')->with('success', 'Evento eliminato con successo');
    }
}
