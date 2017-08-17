
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
        Schema::create('master_rak', function (Blueprint $table) {
            //$table->increments('id');
            $table->string('kode_rak',10);
            $table->primary('kode_rak');
            $table->integer('kode_lokasi_rak', false, true)->unsigned();
            $table->string('nomor_rak', 100);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
        Schema::table('master_rak',function($table){
            $table->foreign('kode_lokasi_rak')
                  ->references('kode_lokasi')
                  ->on('master_lokasi')
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
