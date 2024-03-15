<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\DmRole;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = DmRole::orderBy('name')->get();
        return view('master.roles.index', compact('roles'));
    }

    public function create(){
        return view('master.roles.create');
    }

    public function store(RoleRequest $request){
        try{
            DmRole::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return to_route('roles.index')->with('success', "Berhasil Menambahkan Role");
        }catch(Exception $e){
            return back();
        }
    }

    public function edit($id){
        $role = DmRole::find($id);
        return view('master.roles.create', compact('role'));
    }

    public function update(RoleRequest $request, $id){
        try{
            DmRole::find($id)->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return to_route('roles.index')->with('success', "Berhasil Mengubah Role");
        }catch(Exception $e){
            return back();
        }
    }

    public function delete($id){
        try{
            DmRole::find($id)->delete();
            return to_route('roles.index')->with('success', "Berhasil Menghapus Role");
        }catch(Exception $e){
            return back()->with('error', 'Gagal Menghapus, Role Terkait Dengan User!');
        }
    }
}
