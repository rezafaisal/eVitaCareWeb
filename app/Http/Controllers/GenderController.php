<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\DmGender;
use Illuminate\Http\Request;
use App\Http\Requests\GenderRequest;

class GenderController extends Controller
{
    public function index(){
        $genders = DmGender::all();
        return view('master.genders.index', compact('genders'));
    }

    public function create(){
        return view('master.genders.create');
    }

    public function store(GenderRequest $request){
        try{
            if(DmGender::find($request->id)){
                return back()->withInput()->with('error', 'Kode Jenis Kelamin Sudah Terdaftar Sebelumnya!');
            }

            DmGender::create([
                'id' => $request->id,
                'gender' => $request->name
            ]);
            return to_route('gender.index')->with('success', "Berhasil Menambah Jenis Kelamin");
        }catch(Exception $e){
            return back()->with('error', 'Terjadi Kesalahan, Silahkan Coba Lagi!');
        }
    }

    public function edit($id){
        $gender = DmGender::find($id);
        return view('master.genders.create', compact('gender'));
    }

    public function update(GenderRequest $request, $id){
        try{
            DmGender::find($id)->update([
                'gender' => $request->name
            ]);
            return to_route('gender.index')->with('success', "Berhasil Mengubah Jenis Kelamin");
        }catch(Exception $e){
            return back()->with('error', 'Terjadi Kesalahan, Silahkan Coba Lagi!');
        }
    }

    public function delete($id){
        try{
            DmGender::find($id)->delete();
            return to_route('gender.index')->with('success', "Berhasil Menghapus Jenis Kelamin");
        }catch(Exception $e){
            return back()->with('error', 'Gagal Menghapus, Jenis Kelamin Terkait Dengan User!');
        }
    }
}
