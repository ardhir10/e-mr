<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class AsesmenDokterBidan extends Model
{
    protected $casts = [
        'FJ_DS' => 'array',
        'FJ_DO' => 'array',
        'FJ_RK' => 'array',
        'FJ_RP' => 'array',
        'FJ_RH' => 'array',
        'FJ_RPSL' => 'array',
        'FJ_DIAGNOSA_SEKUNDER' => 'array',
        'FJ_RENCANA_TINDAK_LANJUT' => 'array'
    ];

    protected $guarded = [];
    protected $table = 'TAR_ASESMEN_DOKTER_BIDAN';
    protected $primaryKey = 'FN_ID';

    public function getIcd()
    {

        $data = DB::table('tc_icd10')->where('fs_kd_icd', $this->FS_KODE_DIAGNOSIS)->first();

        return $data;
    }

}
