<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tape extends Model
{
	public $incrementing = false;
    protected $primaryKey = 'nomor_label_tape';
    protected $fillable = ['nomor_label_tape','jenis_tape','status_tape','lokasi_tape','kode_rak_tape','lapis_tape','baris_tape','slot_tape','keterangan_tape','digunakan_tape'];
}
