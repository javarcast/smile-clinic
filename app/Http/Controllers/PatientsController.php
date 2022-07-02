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
    public function index(Request $request)
    {
        $patients = Patient::where('name', 'LIKE', "%$request->q%")->orWhere('id', 'LIKE', "%$request->q%")->paginate(11);
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
        $message = [
            'required' => 'El campo :attribute es requerido.',
            'string' => 'El campo :attribute debe ser una cadena.',
            'numeric' => 'El campo :attribute debe ser numerico.'
        ];
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'numeric']
        ], $message)->validate();

        if(isset($request['dni'])){
            Validator::make($request->all(), [
                'dni' => ['numeric', 'unique:patients']
            ])->validate();
        }
        DB::beginTransaction();
        try {
            $user = User::findOrFail($request['user_id']);
            $patient = new Patient();
            $patient->dni = $request['dni'];

            if($request['email']) {
                $patient->email = $request['email'];
            }

            if($request['phone_number']) {
                $patient->phone_number = $request['phone_number'];
            }
            $patient->name = $request['name'];
            $patient->user()->associate($user);
            $patient->save();

            if(isset($request['medicaments'])) {
                foreach ($request['medicaments'] as $key => $item) {
                    $medicament_patient = new PatientMedicament();
                    $medicament_patient->patient_id = $patient->id;
                    $medicament_patient->medicament_id = $item;
                    $medicament_patient->save();
                }
            }


            if(isset($request['diseases'])) {
                foreach ($request['diseases'] as $key => $item) {
                    $disease_patient = new PatientDisease();
                    $disease_patient->patient_id = $patient->id;
                    $disease_patient->disease_id = $item;
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
    public function show( $id)
    {
        $patient = Patient::findOrFail($id);
        $patient['user'] = User::findOrfail($patient->user_id)->name;
        return Inertia::render('Patient/Show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
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
    public function update(Request $request,  $id)
    {
        $patient = Patient::findOrFail($id);
        $message = [
            'required' => 'El campo :attribute es requerido.',
            'string' => 'El campo :attribute debe ser una cadena.',
            'numeric' => 'El campo :attribute debe ser numerico.',
            'min' => 'El campo :attribute debe ser mayor a :min'
        ];
            Validator::make($request->all(), [
                'dni' => ['required', 'numeric', Rule::unique('patients')->ignore($patient->id)],
                'name' => ['required', 'string', 'max:255'],
                'user_id' => ['required', 'numeric', 'min:0']
            ], $message)->validate();
        DB::beginTransaction();

        try {
            $patient->dni = $request['dni'];
            $patient->name = $request['name'];

            if($request['email']) {
                $patient->email = $request['email'];
            }

            if($request['phone_number']) {
                $patient->phone_number = $request['phone_number'];
            }
            if($patient->user_id !== $request['user_id'])  {
                $user = User::findOrFail($request['user_id']);
                $patient->user()->associate($user);
            }
            $patient->save();

            if(isset($request['medicaments'])) {
                foreach ($request['medicaments'] as $key => $item) {
                    $medicament_patient = PatientMedicament::where('patient_id',$patient->id)
                                            ->where('medicament_id', $item)->first();
                    if(!isset($medicament_patient)) {
                        $medicament_patient = new PatientMedicament();
                        $medicament_patient->patient_id = $patient->id;
                        $medicament_patient->medicament_id = $item;
                        $medicament_patient->save();
                    }
                }
            }

            if(isset($request['diseases'])) {
                foreach ($request['diseases'] as $key => $item) {
                    $disease = Disease::findOrFail($item);

                    $disease_patient = PatientDisease::where('patient_id',$patient->id)
                    ->where('disease_id', $item)->first();
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
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $aux = $patient;
        $patient->delete();
        $message = "Paciente ".$aux->name." ha sido eliminado";

        return redirect()->route('pacientes.index')->with('status', $message);
    }
}
