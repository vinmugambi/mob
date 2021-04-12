<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'title' => 'required|unique:events|max:255',
            'description' => 'required|max:1000',
            'start_date' => 'required|string',
            'end_date' => "required|string",
            "image" => "required|image",
            "address" => "required|string",
            "city" => "required|string"
        ];
    }
}
