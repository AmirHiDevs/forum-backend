<?php

namespace App\Http\Requests\API\v1\Thread;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $id
 */
class UpdateThreadRequest extends FormRequest
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
            'id'=> 'required',
            'user_id' => 'sometimes',
            'title' => 'required',
            'contents'=> 'required',
            'channel_id'=> 'required',
            'best_answer_id' => 'nullable'
        ];
    }
}
