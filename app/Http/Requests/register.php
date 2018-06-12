<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class register extends FormRequest
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
            'name' => 'required|string|max:23',
            'password' => 'required|string|max:23',
            'password2' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'name.max'=>'Tên vượt quá 23 ký tự',
            'name.required'=>'Vui lòng nhập Full name',
            'email.required'=>'Vui lòng nhập Email',
            'password.max'=>'Password vượt quá 23 ký tự',
            'password.required'=>'Vui lòng nhập Password',
            'password2.required'=>'',
        ];
    }
}
