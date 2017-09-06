<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class audit_trail extends Model
{
	public $timestamps = false;
    public $incrementing = true;
    protected $primaryKey = 'idaudit';
    protected $fillable = ['actor_at','keterangan_at','waktu_at'];
}
