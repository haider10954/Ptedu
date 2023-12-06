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
            'first_name' => 'required',
            'last_name' => 'required',
            'user_id' => 'required|unique:users',
            'password' => 'required|min:8|same:confirm_password|regex:/^(?=.*[A-Za-z])(?=.*\d)/',
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
            'first_name.required' => "이름을 입력하세요.",
            'last_name.required' => "당신의 성을 입력하세요.",
            'password.required' => "비밀번호를 입력해주세요.",
            'job.required' => "직업을 선택해주세요.",
            'mobile.required' => "휴대폰번호를 입력해주세요.",
            'email_name.required' => "이메일을 입력해주세요.",
            'email_extension.required' => "이메일을 입력해주세요.",
            'address.required' => "주소를 입력해주세요.",
            'password.same' => '비밀번호와 확인 비밀번호가 일치해야 합니다.',
            'password.regex' => '비밀번호는 영문, 숫자 조합 8자리 이상이여야 합니다.',
            'user_id.regex' => '아이디는 영문숫자 조합이여야 합니다.'
        ];
    }
}
