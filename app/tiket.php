<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tiket extends Model
{
    public $incrementing = true;
	protected $primaryKey = 'no_tiket';
    protected $fillable = ['no_tiket','Email','FullName','TicketSource','HelpTopic','Departement','SLAplan','DueDate','IssueSummary','IssueDetails','file','Priority','PeriodeWaktu','jumlahFile','DataSource','status','create_at','updated_at'];
}
