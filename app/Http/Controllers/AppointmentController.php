<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Patient;
use App\Models\User;
use App\Models\Dentist;
use App\Models\AppointmentTreatment;
use App\Models\Treatment;
use App\Models\State;
use Carbon\Carbon;


class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $myString = $request->aux;
        $myArray = explode('.', $myString);

        if (count($myArray) > 1) {
            // Filtramos por
            // nombre de paciente y fecha
            // o
            // Id de paciente y fecha 
            if (auth()->user()->role_id != 1) {

                if (auth()->user()->role_id == 2) {
                    $appointments = Appointment::join("dentists", "dentists.id", "=", "appointments.dentist_id")
                        ->join("patients", "patients.id", "=", "appointments.patient_id")
                        ->join("users", "users.id", "=", "dentists.user_id")
                        ->where([
                            ['dentists.user_id', '=', auth()->user()->id],
                            ['patients.name', 'LIKE', "%$myArray[0]%"],
                            ['appointments.date', 'LIKE', "%$myArray[1]%"],
                        ])
                        ->orWhere([
                            ['dentists.user_id', '=', auth()->user()->id],
                            ['patients.dni', 'LIKE', "%$myArray[0]%"],
                            ['appointments.date', 'LIKE', "%$myArray[1]%"],
                        ])
                        ->orderBy('date', 'DESC')
                        ->orderBy('hour', 'DESC')
                        ->select('appointments.id', 'date', 'hour', 'users.name as doctor', 'patients.name as paciente')
                        ->paginate(10);
                } //Es Doctor
                else {
                    //es paciente
                    $appointments = Appointment::join("dentists", "dentists.id", "=", "appointments.dentist_id")
                        ->join("patients", "patients.id", "=", "appointments.patient_id")
                        ->join("users", "users.id", "=", "dentists.user_id")
                        ->where([
                            ['patients.user_id', '=', auth()->user()->id],
                            ['users.name', 'LIKE', "%$myArray[0]%"],
                            ['appointments.date', 'LIKE', "%$myArray[1]%"],
                        ])
                        ->orderBy('date', 'DESC')
                        ->orderBy('hour', 'DESC')
                        ->select('appointments.id', 'date', 'hour', 'users.name as doctor', 'patients.name as paciente')
                        ->paginate(10);
                }
            } else {
                //Es Admin

                $appointments = Appointment::join("dentists", "dentists.id", "=", "appointments.dentist_id")
                    ->join("patients", "patients.id", "=", "appointments.patient_id")
                    ->join("users", "users.id", "=", "dentists.user_id")
                    ->where([
                        ['patients.name', 'LIKE', "%$myArray[0]%"],
                        ['appointments.date', 'LIKE', "%$myArray[1]%"],
                    ])
                    ->orWhere([
                        ['patients.dni', 'LIKE', "%$myArray[0]%"],
                        ['appointments.date', 'LIKE', "%$myArray[1]%"],
                    ])
                    ->orWhere([
                        ['users.name', 'LIKE', "%$myArray[0]%"],
                        ['appointments.date', 'LIKE', "%$myArray[1]%"],
                    ])
                    ->orderBy('date', 'DESC')
                    ->orderBy('hour', 'DESC')
                    ->select('appointments.id', 'date', 'hour', 'users.name as doctor', 'patients.name as paciente')
                    ->paginate(10);
            }
        } else {
            // no hay filtro

            if (auth()->user()->role_id != 1) {
                //Es doctor o paciente
                $appointments = Appointment::join("dentists", "dentists.id", "=", "appointments.dentist_id")
                    ->join("patients", "patients.id", "=", "appointments.patient_id")
                    ->join("users", "users.id", "=", "dentists.user_id")
                    ->where([
                        ['patients.user_id', '=', auth()->user()->id]
                    ])
                    ->orWhere([
                        ['dentists.user_id', '=', auth()->user()->id]
                    ])
                    ->orderBy('date', 'DESC')
                    ->orderBy('hour', 'DESC')
                    ->select('appointments.id', 'date', 'hour', 'users.name as doctor', 'patients.name as paciente')
                    ->paginate(10);
            } else {
                //es Admin

                $appointments = Appointment::join("dentists", "dentists.id", "=", "appointments.dentist_id")
                    ->join("patients", "patients.id", "=", "appointments.patient_id")
                    ->join("users", "users.id", "=", "dentists.user_id")
                    ->orderBy('date', 'DESC')
                    ->orderBy('hour', 'DESC')
                    ->select('appointments.id', 'date', 'hour', 'users.name as doctor', 'patients.name as paciente')
                    ->paginate(10);
            }
        }


        return Inertia::render('Appointment/Index', compact("appointments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::get();
        $dentists = User::join('dentists', 'dentists.user_id', '=', 'users.id')
            ->get();
        $treatments = Treatment::get();
        $currentDate = Carbon::now()->toDateString();

        //dd($dentists);
        return Inertia::render('Appointment/Create', compact('patients', 'dentists', 'treatments', 'currentDate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'patient_id' => 'required|numeric',
            'dentist_id' => 'required',
            'total' => 'required|numeric'
        ]);

        $cita = 0;
        $cita = Appointment::where('dentist_id', '=', $request->get('dentist_id'))
            ->whereDate('date', $request->get('date'))
            ->whereTime('hour', $request->get('time'))
            ->select('dentist_id')
            ->get();

        if (count($cita) > 0) {
            $message = "El doctor ya tiene una cita asignada en ese horario";

            return redirect()->back()->with('status', $message);
        } else {
            $appointment = new Appointment();
            $appointment->date = $request->get('date');
            $appointment->hour = $request->get('time');
            $appointment->patient_id = $request->get('patient_id');
            $appointment->dentist_id = $request->get('dentist_id');
            $appointment->state_id = 2;
            $appointment->total = $request->get('total');
            $appointment->save();

            if ($request->get('list')) {

                /**si hay tratamientos */
                $aux = $request->get('list');

                $cont = 0;



                while ($cont < count($aux)) {
                    $appointmentTrea = new AppointmentTreatment();
                    $appointmentTrea->appointment_id = $appointment->id;
                    $appointmentTrea->treatment_id = $aux[$cont]['treatment_id'];
                    $appointmentTrea->price = $aux[$cont]['price'];
                    $appointmentTrea->observation = $aux[$cont]['observation'];
                    $appointmentTrea->save();
                    $cont++;
                }
            }

            $message = "La cita ha sido creada con exito";
            return redirect()->route('citas.index')->with('status', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $appointment = Appointment::findOrFail($id);
        $doctor = User::join('dentists', 'dentists.user_id', '=', 'users.id')
            ->where('dentists.id', '=', $appointment->dentist_id)
            ->get();
        $appointment['dentist'] = $doctor[0];
        $appointment['patient'] = Patient::findOrFail($appointment->patient_id);
        $appointment['state'] = State::findOrFail($appointment->state_id);

        $appTrea =  AppointmentTreatment
            ::join("treatments", "treatments.id", "=", "treatment_id")
            ->select('treatments.id as treatment_id', 'treatments.name as treatment_name', 'appointment_treatment.observation as observation', 'appointment_treatment.price as price')
            ->where("appointment_id", "=", $id)
            ->get();

        //echo($doctor);
        return Inertia::render('Appointment/Show', compact('appointment', 'appTrea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patients = Patient::get();

        $dentists = User::join('dentists', 'dentists.user_id', '=', 'users.id')
            ->get();

        $treatments = Treatment::get();
        $states = State::get();


        $appointment = Appointment::findOrFail($id);

        $appTreat = AppointmentTreatment::join("treatments", "treatments.id", "=", "treatment_id")
            ->select('treatments.id as treatment_id', 'treatments.name as treatment_name', 'appointment_treatment.observation as observation', 'appointment_treatment.price as price')
            ->where("appointment_id", "=", $id)
            ->get();


        return Inertia::render('Appointment/Edit', compact('patients', 'dentists', 'treatments', 'states', 'appointment', 'appTreat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'patient_id' => 'required|numeric',
            'dentist_id' => 'required',
            'state_id' => 'required',
            'total' => 'required|numeric'
        ]);

        $cita = 0;
        $cita = Appointment::where('dentist_id', '=', $request->get('dentist_id'))
            ->whereDate('date', $request->get('date'))
            ->whereTime('hour', $request->get('time'))
            ->where('id', '!=', $id)
            ->select('dentist_id')
            ->get();


        if (count($cita) > 0) {
            $message = "El doctor ya tiene una cita asignada en ese horario";
            return ("ocupado");
            //return redirect()->back()->with('status', $message);
        } else {
            $appointment = Appointment::findOrFail($id);
            $appointment->date = $request->get('date');
            $appointment->hour = $request->get('time');
            $appointment->state_id = $request->get('state_id');
            $appointment->patient_id = $request->get('patient_id');
            $appointment->dentist_id = $request->get('dentist_id');
            $appointment->total = $request->get('total');
            $appointment->update();

            if ($request->get('list')) {
                /**si hay tratamiento */
                $aux = $request->get('list');

                $appointmentTrea = AppointmentTreatment::where("appointment_id", "=", $id)
                    ->get();

                $appointmentTrea->each->delete();

                $cont = 0;
                while ($cont < count($aux)) {

                    $appointmentTrea = new AppointmentTreatment();
                    $appointmentTrea->appointment_id = $appointment->id;
                    $appointmentTrea->treatment_id = $aux[$cont]['treatment_id'];
                    $appointmentTrea->price = $aux[$cont]['price'];
                    $appointmentTrea->observation = $aux[$cont]['observation'];
                    $appointmentTrea->save();

                    $cont++;
                }
            }

            $message = "La Cita ha sido Actualizada!!";
            return redirect()->route('citas.index')->with('status', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointmentTrea = AppointmentTreatment::where("appointment_id", "=", $id)
            ->get();

        $appointment = Appointment::findOrFail($id);

        $message = "La Cita ha sido Eliminada!!";

        $appointmentTrea->each->delete();
        $appointment->delete();

        return redirect()->route('citas.index')->with('status', $message);
    }
}
