<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class master_jenis_tape extends Model
{
	public $incrementing = false;
    protected $primaryKey = 'nomor_jenis';
    protected $fillable = ['nomor_jenis','nama_jenis'];
}
