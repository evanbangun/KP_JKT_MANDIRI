<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tikets', function (Blueprint $table) {
            //$table->increments('id');
            $table->increments('no_tiket');
           
            $table->string('Email',50);
            $table->string('FullName',50);
            $table->string('TicketSource',20);
            $table->string('HelpTopic',200);
            $table->string('Departement',50);
            $table->string('SLAplan',100);
            $table->date('DueDate');
            $table->string('IssueSummary',1000);
            $table->string('IssueDetails',1000);
            $table->binary('file');
            $table->string('Priority',50);
            $table->string('PeriodeWaktu',100);
            $table->string('jumlahFile',50);
            $table->string('DataSource',100);
            $table->integer('status', false, true)->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            

             
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tikets');
    }
}
