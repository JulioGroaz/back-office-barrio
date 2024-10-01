<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Eventi;
use Illuminate\Http\Request;

class EventiControllerApi extends Controller
{
    public function index()
    {
        // Restituisce tutti gli eventi
        return response()->json(Eventi::all());
    }
}
