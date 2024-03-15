<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => 'required',
            'description' => 'required'
        ];
    }

    public function messages(){
        return [
            'status.required' => 'Mohon Masukkan Nama Status!',
            'description.required' => 'Mohon Masukkan Deskripsi Status!'
        ];
    }
}
