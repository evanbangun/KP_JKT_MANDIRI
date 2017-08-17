<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class master_rak extends Model
{
	public $incrementing = false;
    protected $primaryKey = 'kode_rak';
    protected $fillable = ['kode_rak', 'kode_lokasi_rak', 'nomor_rak'];
}
