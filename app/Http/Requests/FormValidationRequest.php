<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormValidationRequest extends FormRequest
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
            'company_symbol' => 'required',
            'start_date' => 'required|date|before_or_equal:end_date|before_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date|before_or_equal:today',
            'email' => 'required|email',
        ];
    }
}
