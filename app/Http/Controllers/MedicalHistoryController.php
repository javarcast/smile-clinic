<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use App\Models\PatientMedicament;
use App\Models\Disease;
use App\Models\Medicament;
use App\Models\Patient;
use App\Models\PatientDisease;
use App\Models\Radiography;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;

class MedicalHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $histories = MedicalHistory::join("patients", "patients.id", "=", "medical_histories.patient_id")
            ->select('medical_histories.id as id', 'medical_histories.updated_at as fecha', 'patients.id as pacienteID', 'patients.name as paciente')
            ->paginate(70);

        return Inertia::render('MedicalHistory/Index', compact("histories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        return Inertia::render('MedicalHistory/Create', compact('patients'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->pirate == 0) {
            $historial = new MedicalHistory();
            $historial->patient_id = $request->get('patient_id');

            $historial->save();

            if ($request->hasFile('imagenes')) {
                $imagenes = $request->file('imagenes');

                foreach ($imagenes as $index => $imagen) {
                    $radiography = new Radiography();
                    $radiography->medical_history_id = $historial->id;
                    $radiography->name = time() . '_' . $historial->patient_id . '_' . $imagen->getClientOriginalName();
                    $radiography->type = $request->type[$index];
                    $auxUrl = public_path() . '/images/radiografias';
                    $radiography->url = '/images/radiografias/' . $radiography->name;
                    $radiography->size = $imagen->getSize();
                    $imagen->move($auxUrl, $radiography->name);
                    $radiography->save();
                }
                $message = "Historia Creada";
                return redirect()->route('historial.index')->with('status', $message);
            }
        } else {
            //pirate update
            echo ($request->historia_id);
            $history = MedicalHistory::findOrFail($request->historia_id);
            $history->patient_id = $request->patient_id;
            $history->update();

            if ($request->filesDeleted) {

                $imgDeleted = $request->filesDeleted;
                foreach ($imgDeleted as $index => $imagen) {

                    $radiography = Radiography::where('name', '=', $imagen)
                        ->get();
                    if (count($radiography)>0) {
                        if (File::exists("images/radiografias/" . $radiography[0]->name)) {
                            File::delete("images/radiografias/" . $radiography[0]->name);
                            $radiography[0]->delete();
                        }
                    }
                }
            }
            if ($request->hasFile('files')) {
                $imagenes = $request->file('files');

                foreach ($imagenes as $index => $imagen) {
                    $radiography = new Radiography();
                    $radiography->medical_history_id = $history->id;
                    $radiography->name = time() . '_' . $imagen->getClientOriginalName();
                    $radiography->type = $request->type[$index];
                    $auxUrl = public_path() . '/images/radiografias';
                    $radiography->url = '/images/radiografias/' . $radiography->name;
                    $radiography->size = $imagen->getSize();
                    $imagen->move($auxUrl, $radiography->name);
                    $radiography->save();
                }
            }
            $message = "Historia Actualizada";
            return redirect()->route('historial.index')->with('status', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalHistory  $medicalHistory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicaments = MedicalHistory::join("medicament_patient", "medicament_patient.patient_id", "=", "medical_histories.patient_id")
            ->join("medicaments", "medicaments.id", "=", "medicament_patient.medicament_id")
            ->where('medical_histories.id', '=', $id)
            ->select('medicaments.name as name')
            ->paginate(7);

        $diseases = MedicalHistory::join("disease_patient", "disease_patient.patient_id", "=", "medical_histories.patient_id")
            ->join("diseases", "diseases.id", "=", "disease_patient.disease_id")
            ->where('medical_histories.id', '=', $id)
            ->select('diseases.name as enfermedad', 'diseases.disease_type_id as tipoEnfer')
            ->paginate(7);

        $radiographs = MedicalHistory::join("radiographs", "radiographs.medical_history_id", "=", "medical_histories.id")
            ->where('medical_histories.id', '=', $id)
            ->select('radiographs.name as name', 'radiographs.url as url', 'radiographs.type as type', 'medical_histories.updated_at as fecha')
            ->paginate(7);


        return Inertia::render('MedicalHistory/Show', compact('medicaments', 'diseases', 'radiographs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalHistory  $medicalHistory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $patients = Patient::all();
        // $diseases = Disease::all();
        // $medicaments = Medicament::all();
        // $history=MedicalHistory::findOrFail($id);

        // $medicaP = PatientMedicament::join("medicaments", "medicaments.id", "=", "medicament_id")
        // ->where('patient_id', '=',$history->patient_id )
        // ->select('medicaments.name as name','medicaments.id as id')
        // ->paginate(7);

        // $diseaseP = PatientDisease::join("diseases", "diseases.id", "=", "disease_id")
        // ->where('patient_id', '=',$history->patient_id )
        // ->select('diseases.name as name','diseases.id as id','diseases.disease_type_id as type')
        // ->paginate(7);

        $patients = Patient::all();
        $history = MedicalHistory::findOrFail($id);
        $radiographs = Radiography::where('medical_history_id', '=', $history->id)
            ->select('*')
            ->paginate(7);

        return Inertia::render('MedicalHistory/Edit', compact('radiographs', 'history', 'patients'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalHistory  $medicalHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalHistory  $medicalHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $radiographs = Radiography::where("medical_history_id", "=", $id)
            ->get();

        foreach ($radiographs as $index => $radio) {
            if (File::exists("images/radiografias/" . $radio->name)) {
                File::delete("images/radiografias/" . $radio->name);
            }
        }
        $radiographs->each->delete();
        $history = MedicalHistory::findOrFail($id);
        $history->delete();
        $message = "La Cita ha sido Eliminada!!";
        return back();
    }
}
