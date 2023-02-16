<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'ticket_desc' => 'required',
            'importance' => 'required',
            'posted_on' => 'required',
        ];
    }

    public function messages()
{
    return [
            
            'ticket_desc.required' => 'The ticket description field is required.',
            'importance.required' => 'The importance field is required.',
            'posted_on.required' => 'The posted on field is required.',
        ];
    }
}
