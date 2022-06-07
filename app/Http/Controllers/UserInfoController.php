<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
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

        return Inertia::render('Users/Create', compact('roles'));
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
            'id' => ['required', 'numeric', 'unique:users'],
            'role_id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


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
            DB::commit();

            $message = "Usuario ".$user->name." ha sido creado";

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
        $user = User::findOrFail($id);
        $user['role'] = $user->role();

        return Inertia::render('Users/Show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return Inertia::render('Users/Edit', compact('user', 'roles'));
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

        if($request['password']) {
            Validator::make($request, [
                'current_password' => ['required', 'string'],
                'password' => $this->passwordRules(),
            ])->after(function ($validator) use ($user, $request) {
                if (! isset($request['current_password']) || ! Hash::check($request['current_password'], $user->password)) {
                    $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
                }
            });
        }
        Validator::make($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone_number' => ['required', 'string'],
            'address' => ['required', 'string'],
            'id' => ['required', 'numeric', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);


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
            ])->save();
        }


        $message = "Usuario ".$user->name." ha sido Actualizado";

        return redirect()->route('usuarios.show', ['id' => $user->id])->with('status', $message);
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
