<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperatorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomOperator'=> 'required|string|max:245',
            'user_id'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            'nomOperator.required' => 'A nomOperator is required',
            'nomOperator.max' => 'maximun 245 caracteres',
            'user_id.required' => 'A user_id is required',

        ];
    }
}
