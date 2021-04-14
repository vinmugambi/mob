<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'title' => 'nullable|unique:events|max:255',
            'description' => 'nullable|string|max:1000',
            'start_time' => 'nullable|string',
            'end_time' => "nullable|string",
            "image" => "nullable|image",
            "address" => "nullable|string",
            "city" => "nullable|string"
        ];
    }
}
