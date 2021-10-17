<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsesmenDokter extends Model
{
    protected $casts = [
        'FJ_DS' => 'array',
        'FJ_DO' => 'array',
        'FJ_PEMERIKSAAN_FISIK' => 'array',
        'FJ_DIAGNOSA_SEKUNDER' => 'array',
        'FJ_RENCANA_TINDAK_LANJUT' => 'array'
    ];
    protected $guarded = [];

    protected $table = 'TAR_ASESMEN_DOKTER';
    protected $primaryKey = 'FN_ID';


}
