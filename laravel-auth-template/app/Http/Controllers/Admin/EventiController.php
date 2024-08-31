<?php

namespace App\Http\Controllers\Admin;
use App\Models\Eventi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Eventi::orderBy('event_date_time', 'desc')->get();
        return view('admin.events.indexevents', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
