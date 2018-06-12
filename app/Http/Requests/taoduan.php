<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class taoduan extends FormRequest
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
            'tenduan' => 'required|string|max:230', 
            // 'motangan' => 'required|string|max:500',
            // 'adress' => 'required|string|max:230',
        ];
    }
    public function messages()
    {
        return [
            'tenduan.required'=>'Vui lòng nhập tên dự án',
            'tenduan.max'=>'Tên dự án quá dài',
            // 'motangan.required'=>'Vui lòng nhập mô tả',
            // 'motangan.max'=>'Mô tả dự án quá dài',
            // 'adress.required'=>'Vui lòng nhập địa điểm',
            // 'adress.max'=>'Tên địa điểm án quá dài',
        ];
    }
}
