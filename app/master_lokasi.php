<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class master_lokasi extends Model
{
	public $incrementing = true;
    protected $primaryKey = 'kode_lokasi';
    protected $fillable = ['nama_lokasi'];
}
