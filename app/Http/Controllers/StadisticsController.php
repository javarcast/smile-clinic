<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class StadisticsController extends Controller
{
    public function index(request $request)
    {
        return Inertia::render('Stadistics/Index');
    }
}
