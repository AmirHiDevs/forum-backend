<?php

namespace App\Http\Requests\API\v1\Channel;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $id
 */
class DestroyChannelRequest extends FormRequest
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
            'id'=>'required'
        ];
    }
}
