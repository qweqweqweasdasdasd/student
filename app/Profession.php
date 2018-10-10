<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    protected $primaryKey = 'pro_id';
	
	protected $table = 'profession';
	
    protected $fillable = [
    	'pro_name','teacher_ids','pro_desc','pro_img','carousel_imgs','status'
    ];
    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];

    //专业与课关系(一对多)
    public function courses()
    {
    	return $this->hasMany('App\Course','pro_id','pro_id');
    }
}
