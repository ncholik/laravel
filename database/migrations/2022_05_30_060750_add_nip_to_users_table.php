<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNipToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nip')->nullable()->after('name');
            $table->string('asal_instansi')->nullable()->after('nip');
            $table->string('jabatan_fungsional')->nullable()->after('nip');
            $table->string('pangkat_gol')->nullable()->after('jabatan_fungsional');
            $table->string('bidang_ilmu')->nullable()->after('pangkat_gol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nip');
            $table->dropColumn('asal_instansi');
            $table->dropColumn('jabatan_fungsional');
            $table->dropColumn('pangkat_gol');
            $table->dropColumn('bidang_ilmu');
        });
    }
}
