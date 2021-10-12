<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFsRegisterOnTarCpptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TAR_CPPT', function (Blueprint $table) {
            $table->string('FS_REGISTER')->nullable();
            $table->string('FS_KD_PEG')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TAR_CPPT', function (Blueprint $table) {
            $table->dropColumn('FS_REGISTER');
            $table->dropColumn('FS_KD_PEG');
        });
    }
}
