<?php

namespace App\Http\Controllers\Admin;
use App\Models\ChiSiamo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChiSiamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chisiamo = ChiSiamo::all();
        return view('admin.chisiamo.indexchisiamo', compact('chisiamo'));
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
