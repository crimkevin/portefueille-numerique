<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'amountTransaction'=> 'required',
            'statue'=> 'required',
            'dateTransaction'=> 'required',
            // 'senderName'=> 'required',
            'receiverName'=> 'required',
            'refTransaction'=> 'required',
            'PaymentMethod'=> 'required',
            // 'user_id'=> 'required',
        ];
    }
    public function messages()
    {
        return [
            'amountTransaction.required' => 'A  amountTransaction is required',
            'statuestatue.required' => 'statue is required',
            'dateTransaction.required' => 'A  dateTransaction is required',
            // 'senderName.required' => 'senderName is required',
            'receiverName.required' => 'A  receiverName is required',
            'refTransaction.required' => 'refTransaction is required',
            'PaymentMethod.required' => 'PaymentMethod is required',
            // 'user_id.required' => 'A user_id is required',

        ];
    }
}
