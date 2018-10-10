<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Authenticatable
{
	protected $rememberTokenName = '';

    protected $primaryKey = 'std_id';
	
	protected $table = 'student';
	
    protected $fillable = [
    	'std_name','password','std_email','std_birthday','std_phone','std_sex','std_pic','std_desc'
    ];
    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];
}
