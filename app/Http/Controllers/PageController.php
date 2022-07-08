<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Patient;
use App\Models\User;
use App\Models\Treatment;
use App\Models\AppoimentTreatments;
use App\Models\Appointment;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    

    public function calculator(){

        $treatments = Treatment::all();
        return Inertia::render('Calculator/Index', compact('treatments'));
    }
}
