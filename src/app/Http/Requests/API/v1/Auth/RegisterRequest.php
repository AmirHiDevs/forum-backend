<?php

namespace App\Http\Requests\API\v1\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $name
 * @property mixed $email
 * @property mixed $password
 */
class RegisterRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required', 'email', 'unique:users',
            'password' => 'required'
        ];
    }


}
