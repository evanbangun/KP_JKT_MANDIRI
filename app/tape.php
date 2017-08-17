<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tape extends Model
{
	public $incrementing = false;
    protected $primaryKey = 'kode_label_tape';
    protected $fillable = ['kode_label_tape','nomor_jenis_tape','kode_rak_tape','nomor_baris_tape'];
}
