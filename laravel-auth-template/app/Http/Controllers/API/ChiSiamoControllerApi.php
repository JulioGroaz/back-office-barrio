<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ChiSiamo;
use Illuminate\Http\Request;

class ChiSiamoControllerApi extends Controller
{
    public function index()
    {
        // Restituisce la sezione "Chi Siamo"
        return response()->json(ChiSiamo::first());
    }
}
