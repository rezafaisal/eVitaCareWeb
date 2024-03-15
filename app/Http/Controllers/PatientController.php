<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Patient;
use App\Models\DmGender;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Http\Requests\PatientRequest;

class PatientController extends Controller
{
    public function index(){
        $patients = Patient::orderBy('name')->get();
        return view('patient.index', compact('patients'));
    }

    public function create(){

    }

    public function store(PatientRequest $request){

    }

    public function edit($id){
        $patient = Patient::find($id);
        $genders = DmGender::all();
        return view('patient.create', compact('patient', 'genders'));
    }

    public function update(PatientRequest $request, $id){
        try{
            $patient = Patient::find($id);
            $patient->id = $request->id;
            $patient->name = $request->name;
            $patient->birth_date = $request->birth_date;
            $patient->nik = $request->nik;
            $patient->bpjs_number = $request->bpjs_number;
            $patient->email = $request->email;
            $patient->address = $request->address;
            $patient->save();

            return redirect(route('patient.index'))->with('success', 'Sukses Mengubah Data Pasien');
        }catch(Exception $e){
            return back()->with('error', 'terjadi Kesalahan, Silahkan Coba Lagi!')->withInput();
        }
    }

    public function detail($id){
        $patient = Patient::find($id);
        return view('patient.detail', compact('patient'));
    }

    public function delete($id){

    }

    public function datatable(Request $request){

    }
}
