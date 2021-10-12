<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFsFromOnTarCpptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TAR_CPPT', function (Blueprint $table) {
            $table->string('FS_FROM')->nullable();
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
            $table->dropColumn('FS_FROM');
        });
    }
}
