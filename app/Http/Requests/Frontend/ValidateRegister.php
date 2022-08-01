<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\NumberMin;

class ValidateRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->guard('web')->check()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Tên của bạn không được để trống",
            "name.string" => "Tên phải là 1 chuỗi ký tự",
            "name.max" => "Số ký tự phải nhỏ hơn 255",

            "email.required" => "Email không được để trống",
            "email.string" => "Email phải là 1 chuỗi ký tự",
            "email.max" => "Số ký tự phải nhỏ hơn 255",
            "email.email" => "Làm ơn nhập đúng định dạng",
            "email.unique" => "Email đã tồn tại",

            "username.required" => "Tên đăng nhập của bạn không được để trống",
            "username.string" => "Tên đăng nhập phải là 1 chuỗi ký tự",
            "username.max" => "Số ký tự phải nhỏ hơn 255",
            "username.unique" => "Tên đăng nhập đã tồn tại",

            "password.required" => "Mật khẩu của bạn không được để trống",
            "password.string" => "Mật khẩu phải là 1 chuỗi ký tự",
            "password.min" => "Số ký tự phải lớn hơn 8",
            "password.confirmed" => "Mật khẩu và nhập lại mật khẩu không trùng khớp",
            "password_confirmation.min" => "Số ký tự phải lớn hơn 8",

            "phone.required" => "Số điện thoại của bạn không được để trống",
            "phone.regex" => "Số điện thoại là number và có 10 đến 11 ký tự",
        ];
    }
}
