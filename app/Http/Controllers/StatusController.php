<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\DmMonitoringStatus;
use App\Http\Requests\StatusRequest;
use App\Models\HomeCarePatient;

class StatusController extends Controller
{
    public function index(){
        $statuses = DmMonitoringStatus::all();
        return view('master.status.index', compact('statuses'));
    }

    public function create(){
        return view("master.status.create");
    }

    public function store(StatusRequest $request){
        try{
            DmMonitoringStatus::create([
                'status' => $request->status,
                'description' => $request->description,
            ]);

            return to_route('status.index')->with('success', "Berhasil Menambahkan Status");
        }catch(Exception $e){
            return back();
        }
    }

    public function edit($id){
        $status = DmMonitoringStatus::find($id);
        return view('master.status.create', compact('status'));
    }

    public function update(StatusRequest $request, $id){
        try{
            DmMonitoringStatus::find($id)->update([
                'status' => $request->status,
                'description' => $request->description
            ]);

            return to_route('status.index')->with('success', "Berhasil mengubah Status");
        }catch(Exception $e){
            return back();
        }
    }

    public function delete($id){
        try{
            if(HomeCarePatient::where('dm_monitoring_status_id', $id)->count()){
                return back()->with('error', 'Gagal Menghapus, Status Masih Digunakan Pada Pasien Home Care');
            }

            DmMonitoringStatus::find($id)->delete();
            return to_route('status.index')->with('success', "Berhasil Menghapus Status");
        }catch(Exception $e){
            return back();
        }
    }
}
