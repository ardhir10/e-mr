<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsesmenPerawat extends Model
{
    protected $casts = [
        'FJ_RKU_RPD_PDRWT' => 'array',
        'FJ_RKU_RPD_PDOPR' => 'array',
        'FJ_RKU_RPD_MSDPO' => 'array',
        'FJ_RPK' => 'array',
        'FJ_KETERGANTUNGAN' => 'array',
        'FJ_RIWAYAT_ALERGI' => 'array',

        'FJ_RP_SPSI' => 'array',
        'FJ_RP_SMEN' => 'array',
        'FJ_RP_SSOS_HPDAK' => 'array',
        'FJ_RP_SSOS_KTYDD' => 'array',
        'FJ_RP_SEKO' => 'array',
        'FJ_RP_AGAMA' => 'array',

        'FJ_SN_RATE' => 'array',
        'FJ_SN_NYERI' => 'array',
        'FJ_SN_NHB' => 'array',
        'FJ_SN_DKD' => 'array',
     ];

    protected $guarded = [];

    protected $table = 'TAR_ASESMEN_PERAWAT';
    protected $primaryKey = 'FN_ID';

}
