<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use App\Models\Dentist;
use App\Models\Appointment;
use App\Models\AppointmentTreatment;
use App\Models\User;
use App\Model\Treatment;
use Carbon\Carbon;

class StadisticsController extends Controller
{
    public function index(Request $request)
    {   
        $initDate   = ($request->dateStart)?$request->dateStart:Carbon::createFromFormat('m/d/Y', '01/01/2021')->format('Y-m-d');
        $endDate    = ($request->dateEnd)?$request->dateEnd:Carbon::now()->format('Y-m-d');
        $aTs        = AppointmentTreatment::groupBy('treatments.id','treatments.name')
                    ->selectRaw('count(appointment_treatment.appointment_id) as number_of_treatments, treatments.name')
                    ->join('treatments','treatments.id', '=', 'appointment_treatment.treatment_id')
                    ->join('appointments','appointments.id','=', 'appointment_treatment.appointment_id')
                    ->whereBetween('appointments.date',[$initDate,$endDate])
                    ->get();
        
        $st1n= [];
        $st1v =[];
        $cpdn = [];
        $cpdv= [];
       
        
        foreach ($aTs as $key => $aT) {
            // echo '<pre>';
            // var_dump($aT->number_of_treatments);
            // echo '</pre>';
            // var_dump('test');
            array_push($st1v,$aT->number_of_treatments);
            array_push($st1n,$aT->name);
        }
       
        $cPD = Appointment::groupBy('date')
                ->selectRaw('count(id) as number_of_appointment, date')
                ->whereBetween('date',[$initDate,$endDate])
                ->get();

        foreach ($cPD as $key => $value) {
            // echo '<pre>';
            // var_dump($value);
            // echo '</pre>';
            // var_dump('test');
            array_push($cpdv,$value->number_of_appointment);
            array_push($cpdn,$value->date);
        }
      

        $nPatients = Patient::count();
        $nDentist = User::Where('role_id', '=', "2")->count();
        $nAppointments = Appointment::count();
        return Inertia::render('Stadistics/Index',compact("nPatients", "nDentist", "nAppointments","st1n","st1v","cpdv","cpdn","initDate", "endDate"));
    }

    public function data(Request $request)
    {   
        $initDate   = ($request->dateStart)?$request->dateStart:Carbon::createFromFormat('m/d/Y', '01/01/2021')->format('Y-m-d');
        $endDate    = ($request->dateEnd)?$request->dateEnd:Carbon::now()->format('Y-m-d');
        $aTs        = AppointmentTreatment::groupBy('treatments.id','treatments.name')
                    ->selectRaw('count(appointment_treatment.appointment_id) as number_of_treatments, treatments.name')
                    ->join('treatments','treatments.id', '=', 'appointment_treatment.treatment_id')
                    ->join('appointments','appointments.id','=', 'appointment_treatment.appointment_id')
                    ->whereBetween('appointments.date',[$initDate,$endDate])
                    ->get();
        
        $st1n= [];
        $st1v =[];
        $cpdn = [];
        $cpdv= [];
       
        
        foreach ($aTs as $key => $aT) {
            // echo '<pre>';
            // var_dump($aT->number_of_treatments);
            // echo '</pre>';
            // var_dump('test');
            array_push($st1v,$aT->number_of_treatments);
            array_push($st1n,$aT->name);
        }
       
        $cPD = Appointment::groupBy('date')
                ->selectRaw('count(id) as number_of_appointment, date')
                ->whereBetween('date',[$initDate,$endDate])
                ->get();

        foreach ($cPD as $key => $value) {
            // echo '<pre>';
            // var_dump($value);
            // echo '</pre>';
            // var_dump('test');
            array_push($cpdv,$value->number_of_appointment);
            array_push($cpdn,$value->date);
        }
      

        $nPatients = Patient::count();
        $nDentist = User::Where('role_id', '=', "2")->count();
        $nAppointments = Appointment::count();
        return Inertia::render('Stadistics/Index',compact("nPatients", "nDentist", "nAppointments","st1n","st1v","cpdv","cpdn","initDate", "endDate"));
    }

    
}
