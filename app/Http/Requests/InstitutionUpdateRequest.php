<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'institution_name' => [
                'required', 'min:3', 'max:60',
            ],
            'logo' => [
                'max:2040',
            ],
            'signature' => [
                 'max:2048',
            ]
        ];
    }
}
