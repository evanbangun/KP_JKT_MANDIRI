<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    public $incrementing = true;
    protected $primaryKey = 'id';
    protected $fillable = ['no_tiket',  'lokasi_sumber','lokasi_tujuan', 'nomor_label_tape','lama_peminjaman','keterangan','create_at','updated_at'];
}

