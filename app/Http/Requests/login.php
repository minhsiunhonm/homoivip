<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class login extends FormRequest
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
            //
            'email' => 'required|string', 
            'password' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Vui lòng nhập Email',
            'password.required'=>'Vui lòng nhập Password',
        ];
    }
}
