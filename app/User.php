<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{

    protected $table = 'TAR_USERS';
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username', 'fs_avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function namaDokter(){
        $QUERY = "select	fs_kd_peg fs_kd_dokter ,
		fs_nm_peg fs_dokter
        from	td_peg
        where	fn_profesi_medis in (0,1,2)
        and fs_kd_peg =  '$this->fs_kd_peg'
        and		FB_SUDAH_RESIGN = 0
        order	by fs_nm_peg";
        $data['dokter'] = DB::select($QUERY);
        if($data['dokter']){
            return $data['dokter'][0]->fs_dokter;
        }else{
            return '-';
        }
    }


    public function role(){
        return $this->belongsTo(Role::class);
    }
}
