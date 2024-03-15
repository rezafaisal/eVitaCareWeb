<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'nik' => 'required|unique:patients,nik|digits:16|numeric',
            'birth_date' => 'required|date',
            'gender_id' => 'required',
            'bpjs_number' => 'required|unique:patients,bpjs_number',
            'phone_number' => 'required|numeric|unique:patients,phone_number',
            'address' => 'required',
            'email' => 'required|email|unique:patients,email',
            'password' => 'required|min:5|alpha_num',
            'confirmation_password' => 'required|same:password'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Mohon Isikan Nama Lengkap Terlebih Dahulu!',
            'nik.required' => 'Mohon Isikan NIK Terlebih Dahulu!',
            'nik.unique' => 'NIK Sudah Pernah Terdaftar Sebelumnya!',
            'nik.digits' => 'NIK Memiliki 16 Digit Angka!',
            'nik.numeric' => 'Mohon Masukkan NIK Sebagai Angka!',
            'birth_date.required' => 'Mohon Pilih Tanggal Lahir Telebih Dahulu!',
            'birth_date.date' => 'Mohon Masukkan Format Tanggal yang Valid!',
            'gender_id.required' => 'Mohon Pilih Jenis Kelamin Terlebih Dahulu!',
            'bpjs_number.required' => 'Mohon Isikan Nomor BPJS Terlebih Dahulu!',
            'bpjs_number.unique' => 'Nomor BPJS Sudah Pernah Terdaftar Sebelumya!',
            'phone_number.required' => 'Mohon Isikan Nomor Telepon Terlebih Dahulu!',
            'phone_number.numeric' => 'Mohon Isikan Nomor Telepon Sebagai Angka!',
            'phone_number.unique' => 'Nomor Telepon Sudah Pernah Terdaftar Sebelumnya!',
            'address.required' => 'Mohon isikan Alamat Tempat Tinggal Terlebih Dahulu!',
            'email.required' => 'Mohon Isikan Email Terlebih Dahulu!',
            'email.email' => 'Mohon Masukkan Format Email yang Valid!',
            'email.unique' => 'Email Sudah Pernah Terdaftar!',
            'password.required' => 'Mohon Masukkan Password Terlebih Dahulu!',
            'password.min' => 'Mohon Masukkan Password Minimal 5 Karakter!',
            'password.alpha_num' => 'Mohon Masukkan Password Berupa Gabungan Angka dan Huruf!',
            'confirmation_password.required' => 'Mohon Masukkan Konfirmasi Password Terlebih Dahulu!',
            'confirmation_password.same' => 'Konfirmasi Password Tidak Sama Dengan Password!' 
        ];
    }
}
