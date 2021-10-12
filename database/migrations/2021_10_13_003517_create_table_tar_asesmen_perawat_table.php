<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTarAsesmenPerawatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TAR_ASESMEN_PERAWAT', function (Blueprint $table) {
            $table->id('FN_ID');

            $table->string('FD_DATE')->nullable();
            $table->string('FS_MR')->nullable();
            $table->string('FS_KD_LAYANAN')->nullable();
            $table->string('FS_PROFESI')->nullable();
            $table->string('FS_USER')->nullable();
            $table->string('FS_DPJP')->nullable();
            $table->string('FS_VERIFIED_BY')->nullable();
            $table->string('FS_REGISTER')->nullable();
            $table->string('FS_KD_PEG')->nullable();
            $table->string('FS_FROM')->nullable();
            $table->string('FS_TYPE')->nullable();

            $table->string('FS_ALASAN_KUNJUNGAN')->nullable();

            // PEMERIKSAAN FISIK
            $table->string('FN_PF_TD')->nullable();
            $table->string('FN_PF_TB')->nullable();
            $table->string('FN_PF_NADI')->nullable();
            $table->string('FN_PF_BB')->nullable();
            $table->string('FN_PF_RESPIRASI')->nullable();
            $table->string('FN_PF_SUHU')->nullable();

            // RIWAYAT KELUHAN UTAMA
             $table->json('FJ_RKU_RPD_PDRWT')->nullable();
             $table->json('FJ_RKU_RPD_PDOPR')->nullable();
             $table->json('FJ_RKU_RPD_MSDPO')->nullable();
             $table->json('FJ_RPK')->nullable();
             $table->json('FJ_KETERGANTUNGAN')->nullable();
             $table->json('FJ_RIWAYAT_ALERGI')->nullable();

            // RIWAYAT PSIKOSOSIAL
            $table->json('FJ_RP_SPSI')->nullable();
            $table->json('FJ_RP_SMEN')->nullable();
            $table->json('FJ_RP_SSOS_HPDAK')->nullable();
            $table->json('FJ_RP_SSOS_KTYDD')->nullable();
            $table->json('FJ_RP_SEKO')->nullable();
            $table->json('FJ_RP_AGAMA')->nullable();

            // SKALA NYERI
            $table->json('FJ_SN_RATE')->nullable();
            $table->json('FJ_SN_NYERI')->nullable();
            $table->string('FS_SN_LOKASI')->nullable();
            $table->string('FS_SN_DURASI')->nullable();
            $table->string('FS_SN_FREKUENSI')->nullable();
            $table->json('FJ_SN_NHB')->nullable();
            $table->json('FJ_SN_DKD')->nullable();


















            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TAR_ASESMEN_PERAWAT');
    }
}
