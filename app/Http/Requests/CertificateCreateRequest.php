<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificateCreateRequest extends FormRequest
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
            'course_name' => [
                'required', 'min:3', 'max:60','unique:assign_certificate,course_name',
            ],
            'total_hours' => [
                'required',
            ],
            'date_completion' => [
                'required',
            ],
            'institution_name' => [
                'required',
            ],
        ];
    }
}
