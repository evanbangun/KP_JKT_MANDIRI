<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
	public $incrementing = false;
	public $timestamps = false;
	protected $primaryKey = 'email';
    protected $fillable = ['email','name','password','role'];
}
