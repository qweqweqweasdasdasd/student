<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    protected $primaryKey = 'course_id';
	
	protected $table = 'course';
	
    protected $fillable = [
    	'pro_id','course_name','course_price','course_desc','cover_img'
    ];
    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];

    //课程和专业的关系(一对多)逆
    public function profession()
    {
        return $this->belongsTo('App\Profession','pro_id','pro_id');
    }
    
    //课程和老师的关系(多对多)
    public function teachers()
    {
        return $this->belongsToMany('App\Teacher','teacher_course','course_id','teacher_id');
    }

    //课程与课时的关系(一对多)
    public function lessons()
    {
        return $this->hasMany('App\Lesson','course_id','course_id');
    }
}
