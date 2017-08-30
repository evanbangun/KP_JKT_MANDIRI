<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamen', function (Blueprint $table) {

            $table->increments('id');
            $table->string('no_tiket',50);
            $table->string('nomor_label_tape',100);
            $table->string('lokasi_sumber', 5);
            $table->string('lokasi_tujuan', 5);
            $table->date('lama_peminjaman');
            $table->string('keterangan',100);
            $table->integer('status', false, true)->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });

        Schema::table('peminjamen',function($table){
            $table->foreign('nomor_label_tape')
                  ->references('nomor_label_tape')
                  ->on('tapes')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });

        Schema::table('peminjamen',function($table){
            $table->foreign('lokasi_sumber')
                  ->references('kode_lokasi')
                  ->on('master_lokasis')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });

         Schema::table('peminjamen',function($table){
            $table->foreign('lokasi_tujuan')
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
        Schema::dropIfExists('peminjamen');
    }
}
