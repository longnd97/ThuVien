<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstName' => 'required|min:2|max:32',
            'lastName' => 'required|min:2|max:32',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:32|confirmed',
            'confirmPassword'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'firstName.required' => 'Trường này không được để trống!',
            'firstName.min' => 'Trường này có ít nhất 2 ký tự!',
            'firstName.max' => 'Trường này nhiều nhất 32 ký tự!',
            'lastName.required' => 'Trường này không được để trống!',
            'lastName.min' => 'Trường này có ít nhất 2 ký tự!',
            'lastName.max' => 'Trường này nhiều nhất 32 ký tự!',
            'email.required' => 'Trường này không được để trống!',
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã tồn tại!',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp!',
            'password.required' => 'Trường này không được để trống!',
            'confirmPassword.required' => 'Trường này không được để trống!',
        ];
    }
}
