<?php

namespace App\Http\Requests\API\v1\Answer;

use App\Repositories\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed $thread_id
 */
class StoreAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool|JsonResponse
     */
    public function authorize()
    {
         if ((new UserRepository())->isBlock()){
            return true;
        }else{
            return response()->json([
               'message' => 'Unfortunately you are blocked.'
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'contents'=> 'required',
            'thread_id'=> 'required'
        ];
    }
}
