
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterRakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_raks', function (Blueprint $table) {
            //$table->increments('id');
            $table->increments('kode_rak');
            $table->integer('lokasi_rak', false, true)->unsigned();
            $table->string('nomor_rak', 100);
            $table->string('jenis_tape_rak', 10);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
        Schema::table('master_raks',function($table){
            $table->foreign('lokasi_rak')
                  ->references('kode_lokasi')
                  ->on('master_lokasis')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::table('master_raks',function($table){
            $table->foreign('jenis_tape_rak')
                  ->references('nomor_jenis')
                  ->on('master_jenis_tapes')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
