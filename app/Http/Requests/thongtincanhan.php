<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class thongtincanhan extends FormRequest
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
            'name' => 'required|max:23', 
            'phone' => 'max:11', 
            'address' => 'max:50', 
            'cmt' => 'max:25', 
        ];
    }
    public function messages()
    {
        return [
            'name.request'=>'Vui lòng nhập tên của bạn',
            'name.max'=>'Tên vượt quá 23 ký tự',
            'phone.max'=>'Số điện thoại vượt quá 11 ký tự',
            'address.max'=>'Địa chỉ vượt quá 50 ký tự',
            'cmt.max'=>'Số chứng minh thư vượt quá 25 ký tự',
        ];
    }
}
