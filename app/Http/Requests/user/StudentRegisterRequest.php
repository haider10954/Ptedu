<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class StudentRegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'en_name' => 'required',
            'user_id' => 'required|unique:users|numeric',
            'password' => 'required|min:6|same:confirm_password',
            'job' => 'required',
            'mobile' => 'required|min:9',
            'email_name' => 'required',
            'email_extension' => 'required',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "이름을 입력해주세요.",
            'en_name.required' => "영문이름을 입력해주세요.",
            'password.required' => "비밀번호를 입력해주세요.",
            'job.required' => "직업을 선택해주세요.",
            'mobile.required' => "휴대폰번호를 입력해주세요.",
            'email_name.required' => "이메일을 입력해주세요.",
            'email_extension.required' => "이메일을 입력해주세요.",
            'address.required' => "주소를 입력해주세요.",
        ];
    }
}
