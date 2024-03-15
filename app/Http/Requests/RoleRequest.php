<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:dm_roles,name,'.$this->id,
            'description' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Nama Role Tidak Boleh Kosong!',
            'name.unique' => 'Nama Role Sudah Pernah Ditambahkan Sebelumnya!',
            'description' => 'Deskripsi Role Tidak Boleh Kosong!'
        ];
    }
}
