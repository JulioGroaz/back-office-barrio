<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuControllerApi extends Controller
{
    public function index()
    {
        // Restituisce tutti gli elementi del menu
        return response()->json(Menu::all());
    }
}
