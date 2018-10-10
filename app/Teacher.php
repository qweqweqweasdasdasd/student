<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    protected $primaryKey = 'teacher_id';
	
	protected $table = 'teacher';
	
    protected $fillable = [
    	'teacher_name','teacher_phone','province','city','area','teacher_address','teacher_company','teacher_email','teacher_pic','teacher_desc','status'
    ];
    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];

}
