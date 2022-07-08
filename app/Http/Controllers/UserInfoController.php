<?php

namespace App\Http\Controllers;

use App\Models\Dentist;
use App\Models\Patient;
use Illuminate\Http\Request;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Role;
use App\Models\Specialty;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

class UserInfoController extends Controller
{

    use PasswordValidationRules;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $users = User::where('name', 'LIKE', "%$request->q%")
            ->orWhere('id', 'LIKE', "%$request->q%")->paginate(11);

        foreach ($users as $key => &$user) {
            $user['role'] = $user->role();
        }

        return Inertia::render('Users/Index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        $specialties = Specialty::all();

        return Inertia::render('Users/Create', compact('roles', 'specialties'));
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
            'numeric' => 'El campo :attribute debe ser numerico.',
            'email' => 'El campo :attribute debe ser un email',
            'min' => 'El campo :attribute debe ser minimo :min',
            'max' => 'El campo :attribute debe ser maximo :max',
            'unique' => 'El valor del campo :attribute ya esta en uso', 
            'confirmed' => 'El campo :attribute no coincide',
        ];
        $request->validate([

            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'phone_number' => ['required', 'string'],
            'address' => ['required', 'string'],
            'id' => ['required', 'numeric', 'unique:users'],
            'photo' => 'nullable|mimes:jpg,jpeg,png|max:1024',
            'role_id' => 'required|min:0|numeric',
            'password'=> 'confirmed|min:8'
        ],$message);

        if($request['role_id'] == 2) {
            Validator::make($request->all(), [
                'specialty_id' => ['required', 'numeric', 'min:0'],
            ])->validate();
        }

        DB::beginTransaction();
        try {
            $role = Role::findOrFail($request['role_id']);
            $user = new User();
            $user->id = $request['id'];
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->address = $request['address'];
            $user->phone_number = $request['phone_number'];
            $user->password = Hash::make($request['password']);
            $user->role()->associate($role);

            $user->save();

            if($role->id === 2) {
                $dentist = new Dentist();
                $specialty = Specialty::findOrFail($request['specialty_id']);

                $dentist->user_id = $request['id'];
                $dentist->specialty()->associate($specialty);

                $dentist->save();
            }

            if($role->id === 3) {
                $patient = new Patient();
                $patient->dni = $request['id'];
                $patient->email = $user->email;
                $patient->name = $user->name;

                $patient->save();
            }

            DB::commit();


            $message = "Usuario ".$user->name." ha sido creado";
                $users = User::where('name', 'LIKE', "%$request->q%")
                ->orWhere('id', 'LIKE', "%$request->q%")->paginate(11);

            foreach ($users as $key => &$user) {
                $user['role'] = $user->role();
            }
            //return Inertia::render('Users/Index',compact("message", "users"));
            return redirect()->route('usuarios.index')->with('status', $message);

        } catch( \Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $UserShow = User::findOrFail($id);
        $UserShow['role'] = Role::findOrFail($UserShow->role_id);

        return Inertia::render('Users/Show', compact('UserShow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $UserShow = User::findOrFail($id);
        $roles = Role::all();
        $specialties = Specialty::all();

        return Inertia::render('Users/Edit', compact('UserShow', 'roles', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $message = [
            'required' => 'El campo :attribute es requerido.',
            'string' => 'El campo :attribute debe ser una cadena.',
            'numeric' => 'El campo :attribute debe ser numerico.',
            'email' => 'El campo :attribute debe ser un email',
            'min' => 'El campo :attribute debe ser minimo :min',
            'max' => 'El campo :attribute debe ser maximo :max',
            'unique' => 'El valor del campo :attribute ya esta en uso', 
            'confirmed' => 'El campo :attribute no coincide',
        ];

        $request->validate([

                'name' => ['required', 'string'],
                'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
                'phone_number' => ['required', 'string'],
                'address' => ['required', 'string'],
                'password' => 'confirmed',
                'id' => ['required', 'numeric', Rule::unique('users')->ignore($user->id)],
                'photo' => 'nullable|mimes:jpg,jpeg,png|max:1024',
                'role_id' => 'required|min:0|numeric',
            ],$message);



        if($request['password']) {
            $user->forceFill([
                'password' => Hash::make($request['password']),
            ])->save();
        }

        if ($request['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $request);
        } else {

            $user->forceFill([
                'phone_number' => $request['phone_number'],
                'address' => $request['address'],
                'id' => $request['id'],
                'name' => $request['name'],
                'email' => $request['email'],
                'role_id' => $request['role_id'],
            ])->save();
        }
        if($request['role_id']=== 2) {
            if(!Dentist::Where('user_id','=', $request['id'])->get()) {
                $dentist = new Dentist();
                $specialty = Specialty::findOrFail($request['specialty_id']);
                $dentist->user()->associate($user);
                $dentist->specialty()->associate($specialty);

                $dentist->save();
            }
        }
        $message = "Usuario ".$user->name." ha sido Actualizado";
        return redirect()->route('usuarios.show', ['usuario' => $user])->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $aux = $user;
        $user->delete();

        $message = "Usuario ".$aux->name." ha sido eliminado";

        return redirect()->route('usuarios.index')->with('status', $message);
    }
}


trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        return ['required', 'string', new Password, 'confirmed'];
    }
}
