<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTapeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tapes', function (Blueprint $table) {
            //$table->increments('id');
            $table->string('nomor_label_tape',100);
            $table->primary('nomor_label_tape');
            $table->string('jenis_tape', 100);
            $table->string('status_tape', 100)->default('Ada di warehouse');
            $table->string('lokasi_tape', 5);
            $table->string('bulan', 20)->nullable();
            $table->string('tahun', 20)->nullable();
            $table->integer('kode_rak_tape', false, true)->nullable();
            $table->integer('lapis_tape', false, true)->nullable();
            $table->integer('baris_tape', false, true)->nullable();
            $table->integer('slot_tape', false, true)->nullable();
            $table->string('keterangan_tape',2048)->nullable();
            $table->integer('digunakan_tape', false, true)->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
        Schema::table('tapes',function($table){
            $table->foreign('jenis_tape')
                  ->references('nomor_jenis')
                  ->on('master_jenis_tapes')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::table('tapes',function($table){
            $table->foreign('kode_rak_tape')
                  ->references('kode_rak')
                  ->on('master_raks')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::table('tapes',function($table){
            $table->foreign('lokasi_tape')
                  ->references('kode_lokasi')
                  ->on('master_lokasis')
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
        Schema::dropIfExists('tapes');
    }
}
