<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class master_lokasi extends Model
{
	public $incrementing = false;
    protected $primaryKey = 'kode_lokasi';
    protected $fillable = ['kode_lokasi', 'nama_lokasi'];
}
