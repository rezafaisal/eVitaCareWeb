<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|max:1',
            'name' => 'required|unique:dm_genders,gender,' . $this->id
        ];
    }

    public function messages(){
        return [
            'id.required' => 'Mohon Masukkan Kode Jenis Kelamin!',
            'id.max' => 'Mohon Masukkan Kode Sebanyak 1 Huruf!',
            'name.required' => 'Mohon Masukkan Nama Jenis Kelamin Terlebih Dahulu!',
            'name.unique' => 'Nama Jenis Kelamin Sudah Terdaftar Sebelumnya!'
        ];
    }
}
