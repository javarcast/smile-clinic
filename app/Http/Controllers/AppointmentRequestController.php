<?php

namespace App\Http\Controllers;

use App\Models\AppointmentRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class AppointmentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = AppointmentRequest::where('status','=', false)->get();
        foreach ($requests as $key => $value) {
            $value['user'] = User::findOrFail($value->client_id);
        }
        return Inertia::render('Request/Index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Request/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'description' => ['required', 'string'],
            'date_appointment' => ['required', 'date'],
            'client_id' => ['required', 'numeric']
        ])->validate();

        DB::beginTransaction();
        try {
            $user = User::findOrFail($request['client_id']);
            $appointment_request = new AppointmentRequest();
            $appointment_request->description = $request['description'];
            $appointment_request->date_appointment = $request['date_appointment'];
            $appointment_request->user()->associate($user);
            $appointment_request->save();
            DB::commit();
            $message = "La Solicitud ".$appointment_request->id." ha sido Creado";
            return redirect()->route('solicitudes.index')->with('status', $message);
        }catch(\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppointmentRequest  $appointmentRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment_request = AppointmentRequest::findOrFail($id);
        $appointment_request['user'] = User::findOrFail($appointment_request->client_id);
        return Inertia::render('Request/Show', compact('appointment_request'));
    }
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppointmentRequest  $appointmentRequest
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $appointment_request = AppointmentRequest::findOrFail($id);
        $appointment_request['user'] = User::findOrFail($appointment_request->client_id);
        return Inertia::render('Request/Edit', compact('appointment_request'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppointmentRequest  $appointmentRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'description' => ['required', 'string'],
            'date_appointment' => ['required', 'date'],
            'status' => ['required', 'boolean'],
            'client_id' => ['required', 'numeric']
        ])->validate();


        DB::beginTransaction();
        try {
            $appointment_request = AppointmentRequest::findOrFail($id);

            if($request['client_id'] !== $appointment_request->client_id){
                $user = User::findOrFail($request['client_id']);
                $appointment_request->user()->associate($user);
            }
            $appointment_request->description = $request['description'];
            $appointment_request->date_appointment = $request['date_appointment'];
            $appointment_request->status = $request['status'];
            $appointment_request->save();
            DB::commit();
            $message = "La Solicitud ".$appointment_request->id." ha sido Actualizada";
            return redirect()->route('solicitudes.index')->with('status', $message);
        }catch(\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentRequest  $appointmentRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = AppointmentRequest::findOrFail($id);
        $aux = $request;
        $request->delete();
        $message = "La Solicitud ".$aux->id." ha sido eliminado";
        return redirect()->route('request.index')->with('status', $message);
    }
}
