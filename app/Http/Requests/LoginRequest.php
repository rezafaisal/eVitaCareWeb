<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages(){
        return [
            'email.required' => 'Mohon Isikan Email Terlebih Dahulu!',
            'email.email' => 'Mohon Masukkan Format Email yang Valid!',
            'password.required' => 'Mohon Masukkan Password Terlebih Dahulu!'
        ];
    }
}
