<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data['page_title'] = "Data Role";

        $data['roles'] = Role::get();
        return view('master-data.role.index', $data);
    }

    public function create()
    {
        $data['page_title'] = "Buat Data Role";
        return view('master-data.role.create', $data);
    }
    public function edit($id)
    {
        $data['page_title'] = "Edit Data user";

        $data['role'] = Role::find($id);


        return view('master-data.role.edit', $data);
    }


    public function store(Request $request)
    {

        // --- BAGIAN VALIDASI
        $messages = [
            'name.required' => 'Role name wajib diisi !',
        ];
        $request->validate([
            'name' => 'required',
        ], $messages);




        // --- HANDLE PROCESS
        try {
            $role = Role::create(['name' => $request->name]);
            return redirect()->route('role.index')->with(['success' => 'Data berhasil dibuat !']);
        } catch (\Throwable $th) {
            return redirect()->route('role.index')->with(['failed' => $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {

        // --- BAGIAN VALIDASI
        $messages = [
            'name.required' => 'Role name wajib diisi !',
        ];
        $request->validate([
            'name' => 'required',
        ], $messages);




        // --- HANDLE PROCESS
        try {
            $role = Role::where('id', $id)->update(['name' => $request->name]);
            return redirect()->route('role.index')->with(['success' => 'Data berhasil diupdate !']);
        } catch (\Throwable $th) {
            return redirect()->route('role.index')->with(['failed' => $th->getMessage()]);
        }
    }


    public function delete($id)
    {

        try {
            Role::destroy($id);
            return redirect()->route('role.index')->with(['failed' => 'Data berhasil dihapus !']);
        } catch (\Throwable $th) {
            return redirect()->route('role.index')->with(['failed' => $th->getMessage()]);
        }
    }
}
