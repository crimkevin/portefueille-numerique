<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
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
            'libNotif'=> 'required|string|max:245',
            'dateNotif'=> 'required|string|max:245',
            'user_id'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            'libNotif.required' => 'A libbelle of Notification is required',
            'dateNotif.required' => 'date of Notification is required',
            'user_id.required' => 'A user_id is required',

        ];
    }
}
