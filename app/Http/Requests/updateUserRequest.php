<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // dd($this->username);
        $username = $this->username;
        $id = auth()->id();
        return [
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'username' => ['required', 'min:3', 'max:20', 'alpha_num', "unique:users,username,$id"],
            'email' => ['required', 'email', 'max:255', "unique:users,email,$id"],
            'password' => ['nullable', 'min:5', 'confirmed'],
            'avatar' => ['image', 'mimetypes:image/*'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'name',
            'username' => 'username',
            'password' => 'account Password',
            'avatar' => 'avatar',
            'email' => 'email Id',
        ];
    }
}
