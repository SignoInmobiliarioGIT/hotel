<?php

namespace App\Http\Requests\Outservices;

use Illuminate\Foundation\Http\FormRequest;

class EditOutServiceRequest extends FormRequest
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
            'dateRange'   => 'required|string',
            'room'        => 'required|integer',
            'description' => 'required|string'
        ];
    }
}
