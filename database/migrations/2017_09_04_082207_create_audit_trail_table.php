<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudittrailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_trails', function (Blueprint $table) {
            $table->increments('idaudit');
            $table->string('actor_at', 128);
            $table->string('keterangan_at', 1024);
            $table->timestamp('waktu_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::table('audit_trails',function($table){
            $table->foreign('actor_at')
                  ->references('email')
                  ->on('users')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audittrails');
    }
}
