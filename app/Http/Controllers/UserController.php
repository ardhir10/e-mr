<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:lihat-user',['only'=>'index']);
    }
    public function index()
    {
        $data['page_title'] = "Data User";


        $data['users'] = User::orderBy('id','desc')->get();
        return view('master-data.user.index', $data);
    }

    public function create()
    {
        $data['page_title'] = "Buat Data User";
        $QUERY = "select	fs_kd_peg fs_kd_dokter ,
		fs_nm_peg fs_dokter
        from	td_peg
        where	fn_profesi_medis in (0,1,2)
        and		FB_SUDAH_RESIGN = 0
        order	by fs_nm_peg";
        $data['dokter'] = DB::select($QUERY);
        $data['roles'] = Role::all();
        return view('master-data.user.create', $data);
    }
    public function edit($id)
    {
        $data['page_title'] = "Edit Data user";

        $data['user'] = User::find($id);
        $data['page_title'] = "Buat Data User";
        $QUERY = "select	fs_kd_peg fs_kd_dokter ,
		fs_nm_peg fs_dokter
        from	td_peg
        where	fn_profesi_medis in (0,1,2)
        and		FB_SUDAH_RESIGN = 0
        order	by fs_nm_peg";
        $data['dokter'] = DB::select($QUERY);
        $data['roles'] = Role::all();

        return view('master-data.user.edit', $data);
    }
    public function editProfile($id)
    {
        $data['page_title'] = "Edit Profile";

        $data['user'] = User::find($id);
        $data['page_title'] = "Edit Profile";
        $QUERY = "select	fs_kd_peg fs_kd_dokter ,
		fs_nm_peg fs_dokter
        from	td_peg
        where	fn_profesi_medis in (0,1,2)
        and		FB_SUDAH_RESIGN = 0
        order	by fs_nm_peg";
        $data['dokter'] = DB::select($QUERY);
        $data['roles'] = Role::all();

        return view('master-data.user.edit-profile', $data);
    }


    public function store(Request $request)
    {
        // dd($request->all());

        // --- BAGIAN VALIDASI
        $messages = [
            'kd_satuan_tugas_medis.required' => 'Kode satuan tugas wajib diisi !',
            'nm_satuan_tugas_medis.required' => 'Nama satuan tugas wajib diisi !',
            'role_id.required' => 'Role wajib diisi !',
        ];
        $request->validate([
            'kd_satuan_tugas_medis' => 'required',
            'nm_satuan_tugas_medis' => 'required',
            'role_id' => 'required',
        ], $messages);

        $parameterInsert = [
            'FS_KD_SAT_TUGAS' => $request->kd_satuan_tugas_medis,
            'FS_NM_SAT_TUGAS' => $request->nm_satuan_tugas_medis,
            'FB_MEDIS' => 1
        ];

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $name = time() . '.' . $avatar->getClientOriginalExtension();
            $destinationPath = public_path('images/avatar/');
            $avatar->move($destinationPath, $name);
            dd($name);
        }


        // --- HANDLE PROCESS
        try {
            DB::table('TD_SAT_TUGAS')->insert($parameterInsert);
            return redirect()->route('user.index')->with(['success' => 'Data berhasil dibuat !']);
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with(['failed' => $th->getMessage()]);
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
            'email'                 => 'required|email|unique:TAR_USERS,email,'. $id,
            'username'              => 'required|unique:TAR_USERS,username,'.$id,
            'name' => 'required',
            'role_id' => 'required',
        ], $messages);




        $parameterUpdate = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'fs_kd_peg' => $request->fs_kd_peg,
            'role_id' => $request->role_id,
        ];

        if($request->password != ''){
            $parameterUpdate['password'] = Hash::make($request->password);
        }




        // --- HANDLE PROCESS
        try {
            User::where('id',$id)->update($parameterUpdate);
            $role = Role::find($request->role_id);
            $user = User::find($id);
            $user->syncRoles($role->name);
            if ($request->hasFile('avatar')) {
                // Delete Picture
                if ($user->fs_avatar) {
                    $picture_path = public_path('images/avatar/' . $user->fs_avatar);
                    if (File::exists($picture_path)) {
                        File::delete($picture_path);
                    }
                }

                $avatar = $request->file('avatar');
                $name = time() . '.' . $avatar->getClientOriginalExtension();
                $destinationPath = public_path('images/avatar/');
                $avatar->move($destinationPath, $name);
                $user->fs_avatar = $name;
            }
            $user->save();

            return redirect()->route('user.index')->with(['success' => 'Data berhasil disimpan !']);
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with(['failed' => $th->getMessage()]);
        }
    }

    public function updateProfile(Request $request, $id)
    {
        // --- BAGIAN VALIDASI



        $parameterUpdate= [];

        if ($request->password != '') {
            $parameterUpdate['password'] = Hash::make($request->password);
        }

        // --- HANDLE PROCESS
        try {

            if ($request->hasFile('avatar')) {
                // Delete Picture
                $user = User::where('id',$id)->first();
                if ($user->fs_avatar) {
                    $picture_path = public_path('images/avatar/' . $user->fs_avatar);
                    if (File::exists($picture_path)) {
                        File::delete($picture_path);
                    }
                }

                $avatar = $request->file('avatar');
                $name = time() . '.' . $avatar->getClientOriginalExtension();
                $destinationPath = public_path('images/avatar/');
                $avatar->move($destinationPath, $name);
                $parameterUpdate['fs_avatar'] = $name;
            }


            User::where('id', $id)->update($parameterUpdate);
            return redirect()->route('dashboard')->with(['success' => 'Profile berhasil diubah !']);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with(['failed' => $th->getMessage()]);
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

    public function asignRole($id){
        // $user = User::find($id);
        // $user->assignRole('root');

        $dataPermissions = [
            'buat-user',
            'lihat-user',
            'edit-user',
            'hapus-user'
        ];

          // $user = User::find($id);
          $role = Role::findByName('root');
          $role->givePermissionTo($dataPermissions);
          dd($role);
    }

}
