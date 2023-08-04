<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'username' => ['required', 'min:3', 'max:20', 'string', "unique:users"],
            'email' => ['required', 'email', 'max:255', "unique:users"],
            'password' => ['required', 'min:5', 'confirmed'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'name',
            'username' => 'Username',
            'password' => 'account Password',
            'email' => 'Email Id',
        ];
    }
}
