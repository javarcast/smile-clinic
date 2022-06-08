<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Disease;
use App\Models\Medicament;
use App\Models\Patient;
use App\Models\PatientDisease;
use App\Models\PatientMedicament;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Validation\Rule;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();

        return Inertia::render('Patient/Index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $diseases = Disease::all();
        $medicaments = Medicament::all();
        return Inertia::render('Patient/Create', compact('users', 'diseases', 'medicaments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request, [
            'id' => ['required', 'numeric', 'unique:Patients'],
            'name' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'numeric']
        ])->validate();

        DB::beginTransaction();
        try {
            $user = User::findOrFail($request['user_id']);
            $patient = new Patient();
            $patient->id = $request['id'];
            $patient->name = $request['name'];
            $patient->user()->associate($user);
            $patient->save();

            if(isset($request['medicaments'])) {
                foreach ($request['medicaments'] as $key => $item) {
                    $medicament = Medicament::findOrFail($item->id);

                    if(!isset($medicament)) {

                        $medicament = new Medicament();
                        $medicament->name = $item->name;
                        $medicament->save();
                    }

                    $medicament_patient = new PatientMedicament();
                    $medicament_patient->patient_id = $patient->id;
                    $medicament_patient->medicament_id = $medicament->id;
                    $medicament_patient->save();
                }
            }


            if(isset($request['diseases'])) {
                foreach ($request['diseases'] as $key => $item) {
                    $disease = Disease::findOrFail($item->id);

                    if(!isset($disease)) {

                        $disease = new Disease();
                        $disease->name = $item->name;
                        $disease->save();
                    }

                    $disease_patient = new PatientDisease();
                    $disease_patient->patient_id = $patient->id;
                    $disease_patient->disease_id = $disease->id;
                    $disease_patient->save();
                }
            }

            DB::commit();
            $message = "Paciente ".$patient->name." ha sido Creado";
            return redirect()->route('pacientes.index')->with('status', $message);
        }catch(\Exception $e) {
            DB::rollBack();
            return $e;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return Inertia::render('Patient/Show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {

        $users = User::all();
        $diseases = Disease::all();
        $medicaments = Medicament::all();
        return Inertia::render('Patient/Edit', compact('patient', 'users', 'diseases', 'medicaments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        Validator::make($request, [
            'id' => ['required', 'numeric', Rule::unique('patients')->ignore($patient->id)],
            'name' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'numeric']
        ])->validate();

        DB::beginTransaction();
        try {
            $patient->id = $request['id'];
            $patient->name = $request['name'];
            if($patient->user_id !== $request['user_id'])  {
                $user = User::findOrFail($request['user_id']);
                $patient->user()->associate($user);
            }
            $patient->save();

            if(isset($request['medicaments'])) {
                foreach ($request['medicaments'] as $key => $item) {
                    $medicament = Medicament::findOrFail($item->id);
                    if(!isset($medicament)) {

                        $medicament = new Medicament();
                        $medicament->name = $item->name;
                        $medicament->save();
                    }

                    $medicament_patient = PatientMedicament::where('patient_id',$patient->id)
                                            ->where('medicament_id', $medicament->id)->first();
                    if(!isset($medicament_patient)) {
                        $medicament_patient = new PatientMedicament();
                        $medicament_patient->patient_id = $patient->id;
                        $medicament_patient->medicament_id = $medicament->id;
                        $medicament_patient->save();
                    }
                }
            }


            if(isset($request['diseases'])) {
                foreach ($request['diseases'] as $key => $item) {
                    $disease = Disease::findOrFail($item->id);

                    if(!isset($disease)) {

                        $disease = new Disease();
                        $disease->name = $item->name;
                        $disease->save();
                    }

                    $disease_patient = PatientDisease::where('patient_id',$patient->id)
                    ->where('disease_id', $disease->id)->first();
                    if(!isset($disease_patient)) {
                        $disease_patient = new PatientDisease();
                        $disease_patient->patient_id = $patient->id;
                        $disease_patient->disease_id = $disease->id;
                        $disease_patient->save();
                    }
                }
            }

            DB::commit();
            $message = "Paciente ".$patient->name." ha sido Creado";
            return redirect()->route('pacientes.index')->with('status', $message);
        }catch(\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $aux = $patient;
        $patient->delete();
        $message = "Paciente ".$patient->name." ha sido eliminado";

        return redirect()->route('pacientes.index')->with('status', $message);
    }
}
