<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ChiSiamo;
use Illuminate\Http\Request;

class ChiSiamoControllerApi extends Controller
{
    public function index()
    {

    // Recupera tutti i record dalla tabella ChiSiamo
        // Restituisce i dati in formato JSON
        return response()->json(ChiSiamo::all());
    }
}
