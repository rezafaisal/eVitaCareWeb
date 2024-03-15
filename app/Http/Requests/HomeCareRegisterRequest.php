<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeCareRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'doctor_id' => 'required'
        ];
    }

    public function messages(){
        return [
            'doctor_id.required' => 'Mohon Pilih Dokter Terlebih Dahulu!'
        ];
    }
}
