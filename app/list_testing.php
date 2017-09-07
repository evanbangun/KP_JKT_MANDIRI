<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class list_testing extends Model
{
    public $incrementing = true;
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['kode_tape_testing', 'label_tape_testing', 'umur_tape_testing', 'library_awal_testing', 'library_tujuan_testing', 'object_awal_testing', 'object_new_testing', 'hasil_tape_testing', 'keterangan_tape_testing', 'penguji_tape_testing'];
}
