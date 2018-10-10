<?php 
namespace App\Repositories;

use App\Lesson;
use App\Profession;
use App\Teacher;

class LessonRepository 
{
	//获取到指定的老师和老师id数组
	public function getTeacherArr()
	{
		return Teacher::pluck('teacher_name','teacher_id');
	}
	//获取到所有的课时信息
	public function getLessons($data)
	{
		return Lesson::select('lesson_id','lesson_name','course.course_id','course_name','lesson_duration','lesson.cover_img','lesson.teacher_ids','lesson.status','lesson.deleted_at')
						->leftJoin('course','lesson.course_id','course.course_id')
						->leftJoin('profession','course.pro_id','profession.pro_id')
						->where(function($query) use($data){
							if(!empty($data['pro_id']) && !empty($data['course_id']) && !empty($data['lesson_id'])){
								$query->whereNull('lesson.deleted_at')
									  ->where('profession.pro_id',$data['pro_id'])
									  ->where('course.course_id',$data['course_id'])
									  ->where('lesson.lesson_id',$data['lesson_id']);
							}
							if(!empty($data['pro_id']) && !empty($data['course_id'])){
								$query->whereNull('lesson.deleted_at')
									  ->where('profession.pro_id',$data['pro_id'])
									  ->where('course.course_id',$data['course_id']);
							}
							if(!empty($data['pro_id'])){
								$query->where('course.pro_id',$data['pro_id'])
									  ->whereNull('lesson.deleted_at');
							}
							if(!empty($data['course_id'])){
								$query->where('course.course_id',$data['course_id'])
									  ->whereNull('lesson.deleted_at');
							}
							if(!empty($data['lesson_id'])){
								$query->where('lesson.lesson_id',$data['lesson_id'])
									  ->whereNull('lesson.deleted_at');
							}
						})
						->whereNull('lesson.deleted_at')
						->paginate(9);
	}

	//编辑查询的条件
	public function createQuery($d)
	{
		$newData = [];
		foreach ($d as $k => $v) {
			if(!is_null($v)){
				if($k != 'lesson_id'){
					$newData['course.'.$k] = $v;
				}else{
					$newData[$k] = $v;
				}
			}
		}
		return $newData;
	}

	//保存课时信息
	public function storeLesson($d)
	{
		return Lesson::create(array_except($d,['file']));
	}

	//获取到指定到额课时信息
	public function getLesson($id)
	{
		return Lesson::find($id);
	}

	//检查图片是否有重复的,如果有重复的话删除
	public function checkImageSame($d,$id)
	{
		$cover_img = Lesson::where('lesson_id',$id)->value('cover_img');
		if($d['cover_img'] != $cover_img){
			//删除指定的图片
			return @unlink('.'.$cover_img);
		}
		return true;
	}

	//更新编辑的数据保存
	public function updateLesson($d,$id)
	{
		return Lesson::where('lesson_id',$id)->update(array_except($d,['file']));
	}

	//删除指定的课时信息
	public function delete($id)
	{
		//删除指定的图片
		@unlink('.'.Lesson::where('lesson_id',$id)->value('cover_img'));
		return Lesson::where('lesson_id',$id)->delete();
	}
}
?>