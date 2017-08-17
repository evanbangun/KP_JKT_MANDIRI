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
        Schema::create('tape', function (Blueprint $table) {
            //$table->increments('id');
            $table->string('nomor_label_tape',10);
            $table->primary('nomor_label_tape');
            $table->string('nomor_jenis_tape', 10);
            $table->string('kode_rak_tape', 10);
            $table->integer('status', false, true)->default('1');
            $table->integer('nomor_baris_tape', false, true);
            $table->string('peminjam',1024)->->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
        Schema::table('tape',function($table){
            $table->foreign('nomor_jenis_tape')
                  ->references('nomor_jenis')
                  ->on('master_jenis_tape')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::table('tape',function($table){
            $table->foreign('kode_rak_tape')
                  ->references('kode_rak')
                  ->on('master_rak')
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
