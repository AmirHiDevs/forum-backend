<?php

namespace App\Http\Requests\API\v1\Subscribe;


use App\Repositories\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * @property mixed $id
 * @property mixed $thread_id
 */
class DestroySubscribeRequest extends FormRequest
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
            'id' => 'required',
            'user_id' => Auth::check() ? 'required' : '',
            'thread_id' => 'required'
        ];
    }
}
