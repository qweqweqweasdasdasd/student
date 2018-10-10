<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ordercourse extends Model
{
    protected $primaryKey = 'id';
	
	protected $table = 'order_course';
	
    protected $fillable = [
    	'order_id','course_id','course_price'
    ];
    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];
}
