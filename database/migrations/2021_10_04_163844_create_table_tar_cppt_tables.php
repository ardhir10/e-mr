<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTarCpptTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TAR_CPPT', function (Blueprint $table) {
            $table->id('FN_ID');
            $table->string('FD_DATE')->nullable();
            $table->string('FS_MR')->nullable();
            $table->text('FT_SUBJECTIVE')->nullable();
            $table->text('FT_OBJECTIVE')->nullable();
            $table->text('FT_ASSESMENT')->nullable();

            $table->string('FS_KD_LAYANAN')->nullable();
            $table->string('FS_PROFESI')->nullable();

            $table->string('FS_PLAN1')->nullable();
            $table->string('FS_PLAN2')->nullable();
            $table->string('FS_PLAN3')->nullable();
            $table->string('FS_PLAN4')->nullable();
            $table->string('FS_IPPA1A')->nullable();
            $table->string('FS_IPPA1B')->nullable();
            $table->string('FS_IPPA2A')->nullable();
            $table->string('FS_IPPA2B')->nullable();
            $table->string('FS_IPPA3A')->nullable();
            $table->string('FS_IPPA3B')->nullable();
            $table->string('FS_IPPA3C')->nullable();
            $table->string('FS_USER')->nullable();

            $table->string('FS_DPJP')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TAR_CPPT');
    }
}
