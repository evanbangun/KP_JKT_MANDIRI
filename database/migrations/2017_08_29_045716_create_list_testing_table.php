<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListTestingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_testings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_tape_testing', 2048);
            $table->string('label_tape_testing', 64);
            $table->integer('umur_tape_testing', false, true);
            $table->string('library_awal_testing', 1024)->nullable();
            $table->string('library_tujuan_testing', 1024)->nullable();
            $table->string('object_awal_testing', 1024)->nullable();
            $table->string('object_new_testing', 1024)->nullable();
            $table->integer('hasil_tape_testing', false, true)->default(0);
            $table->string('keterangan_tape_testing', 2048)->nullable();
            $table->string('penguji_tape_testing', 2048);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            
        });

        Schema::table('list_testings',function($table){
            $table->foreign('label_tape_testing')
                  ->references('nomor_label_tape')
                  ->on('tapes')
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
        Schema::dropIfExists('list_testings');
    }
}
