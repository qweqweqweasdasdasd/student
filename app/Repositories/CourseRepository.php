<?php 
namespace App\Repositories;

use App\Course;
use App\Lesson;

class CourseRepository 
{
	//通过指定的专业id获取到课程信息
	public function getcoursebypro($pro_id)
	{
		return Course::where('pro_id',$pro_id)->get();
	}

	//通过指定的课程id获取到课时信息
	public function getlessonbycourse($course_id)
	{
		return Lesson::where('course_id',$course_id)->get();
	}

	//获取所有课程数据
	public function getCourses($k = [])
	{
		return Course::where(function($query) use($k){
								if(!empty($k['course_name'])){
									$query->where('course_name',$k['course_name']);
								}
							})->paginate(11);	
	}

	//保存课程的信息
	public function storeCourse($d)
	{
		return Course::create(array_except($d,['file']));
	}

	//获取到指定的课程信息
	public function getCourse($id)
	{
		return Course::find($id);
	}

	//删除指定的课程信息
	public function delete($id)
	{
		//删除图片
		$course = $this->getCourse($id);
		@unlink('.'.$course->cover_img);
		return Course::where('course_id',$id)->delete();
	}

	//更新指定的课程信息
	public function updateCourse($d,$id)
	{
		$this->is_change_image($d,$id);

		return Course::where('course_id',$id)->update(array_except($d,['file']));
	}

	//判断图片是否更新
	public function is_change_image($d,$id)
	{
		$course = Course::where('course_id',$id)->first();
		if($course->cover_img != $d['cover_img']){
			(@unlink('.'.$course->cover_img));	//更换了
			return true;
		}
		return false;
	}

	//通过课程id获取到老师的信息
	public function getgetTeacherWithCourse($d)
	{
		$course = $this->getCourse($d['course_id']);

		return $course->teachers;
	}

	//获取到图片
	public function getCourseImg($course_ids)
	{
		return Course::whereIn('course_id',$course_ids)->pluck('cover_img','course_id');
	}
}
?>