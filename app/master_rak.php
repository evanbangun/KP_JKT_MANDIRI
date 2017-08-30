<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class master_rak extends Model
{
	public $incrementing = true;
    protected $primaryKey = 'kode_rak';
    protected $fillable = ['lokasi_rak', 'nomor_rak', 'jenis_tape_rak', 'kapasitas_rak'];
}
