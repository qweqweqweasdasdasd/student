<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    protected $primaryKey = 'lesson_id';
	
	protected $table = 'lesson';
	
    protected $fillable = [
    	'course_id','lesson_name','cover_img','video_address','lesson_desc','lesson_duration','teacher_ids','status'
    ];
    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];

    //建立课时与课程的关系,,一对多(逆)
    public function course()
    {
        return $this->belongsTo('App\Course','course_id','course_id');
    }
}
