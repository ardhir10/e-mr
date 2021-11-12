<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarAsesmenDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TAR_ASESMEN_DOKTER', function (Blueprint $table) {
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

            // --- PENGKAJIAN
            $table->json('FJ_DS')->nullable();
            $table->string('FS_RPD')->nullable();
            $table->string('FS_RO')->nullable();
            $table->json('FJ_DO')->nullable();

            // --- PEMERIKSAAAN FISIK
            $table->json('FJ_PEMERIKSAAN_FISIK')->nullable();
            $table->string('FS_PEMERIKSAAN_PENUNJANG')->nullable();
            $table->string('FS_TINDAKAN_TERAPI')->nullable();
            $table->string('FS_KODE_DIAGNOSIS')->nullable();
            $table->json('FJ_DIAGNOSA_SEKUNDER')->nullable();
            $table->string('FS_DETAIL_DIAGNOSIS')->nullable();

            // --- TINDAK LANJUT
            $table->json('FJ_RENCANA_TINDAK_LANJUT')->nullable();



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
        Schema::dropIfExists('TAR_ASESMEN_DOKTER');
    }
}
