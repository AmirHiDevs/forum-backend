<?php

namespace App\Http\Requests\API\v1\Thread;

use App\Repositories\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

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
        return (new UserRepository())->isBlock();
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
            'title' => 'required',
            'contents'=> 'required',
            'channel_id'=> 'required',
            'best_answer_id' => 'nullable'
        ];
    }
}
