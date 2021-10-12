<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add3FieldPlanOnTarCpptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TAR_CPPT', function (Blueprint $table) {
            $table->string('FS_IPPA1C')->nullable();
            $table->string('FS_IPPA2C')->nullable();
            $table->string('FS_IPPA4A')->nullable();
            $table->string('FS_IPPA4B')->nullable();
            $table->string('FS_IPPA4C')->nullable();
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
            $table->dropColumn('FS_IPPA1C');
            $table->dropColumn('FS_IPPA2C');
            $table->dropColumn('FS_IPPA4A');
            $table->dropColumn('FS_IPPA4B');
            $table->dropColumn('FS_IPPA4C');
        });
    }
}
