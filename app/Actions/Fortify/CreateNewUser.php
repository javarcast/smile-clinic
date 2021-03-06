<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

use Illuminate\Support\Facades\DB;
use App\Models\Role;
use BaconQrCode\Renderer\Path\Path;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'id' => ['required', 'numeric', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:patients'],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        DB::beginTransaction();
        try {
            $role = Role::findOrFail(3);
            $user = new User();
            $user->id = $input['id'];
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->address = $input['address'];
            $user->phone_number = $input['phone_number'];
            $user->password = Hash::make($input['password']);
            $user->role()->associate($role);
            $user->save();
            $patient = new Patient();

            $patient->name = $user->name;
            $patient->user_id = $input['id'];
            $patient->dni = $input['id'];
            $patient->email = $user->email;
            $patient->phone_number = $user->phone_number;
            $patient->save();

            DB::commit();

            return $user;
        } catch( \Exception $e) {
            DB::rollBack();
            return $e;
        }

    }
}
