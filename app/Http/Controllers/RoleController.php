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

        $data['user'] = User::find($id);


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
            'name.required' => 'Nama user wajib diisi !',
            'email.required' => 'Email user wajib diisi !',
            'username.required' => 'Username user wajib diisi !',
            'username.unique' => 'Username Sudah ada !',
            'email.unique' => 'Email Sudah ada !',
        ];

        $request->validate([
            'email'                 => 'required|email|unique:users,email,' . $id,
            'username'              => 'required|unique:users,username,' . $id,
            'name' => 'required',
        ], $messages);




        $parameterUpdate = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];

        if ($request->password != '') {
            $parameterUpdate['password'] = Hash::make($request->password);
        }



        // --- HANDLE PROCESS
        try {
            User::where('id', $id)->update($parameterUpdate);
            return redirect()->route('user.index')->with(['success' => 'Data berhasil disimpan !']);
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with(['failed' => $th->getMessage()]);
        }
    }


    public function delete($id)
    {

        try {
            User::destroy($id);
            return redirect()->route('user.index')->with(['failed' => 'Data berhasil dihapus !']);
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with(['failed' => $th->getMessage()]);
        }
    }
}
