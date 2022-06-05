<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

use Illuminate\Support\Facades\DB;
use App\Models\Role;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id'=>['required', 'numeric'],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        DB::beginTransaction();
        try {
            $role = Role::findOrFail($input['role_id']);
            $user = new User();
            $user->id = $input['id'];
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->address = $input['address'];
            $user->phone_number = $input['phone_number'];
            $user->password = Hash::make($input['password']);
            $user->role()->associate($role);
            $user->save();
            DB::commit();

            return $user;
        } catch( \Exception $e) {
            DB::rollBack();
            return json_encode( array('status' => 400, $e));
        }

    }
}
