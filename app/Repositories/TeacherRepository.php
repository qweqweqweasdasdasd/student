<?php 
namespace App\Repositories;

use App\Teacher;

class TeacherRepository 
{
	//老师数据的保存
	public function storeTeacher($d)
	{
		return Teacher::create(array_except($d,['file']));
	}

	//获取到所有的老师的信息
	public function teachers($d = [])
	{
		return Teacher::where(function($query) use($d){
							if(!empty($d['teacher_name'])){
								$query->where('teacher_name',$d['teacher_name']);
							}
							if(!empty($d['status'])){
								$query->where('status',$d['status']);
							}
							if(!empty($d['teacher_name'] && !empty($d['status']))){
								$query->where('teacher_name',$d['teacher_name'])
									  ->where('status',$d['status']);
							}

						})->paginate(5);
	}

	//获取到老师和老师id的数组
	public function getTeacherArr()
	{
		return Teacher::pluck('teacher_id','teacher_name');
	}

	//删除指定的老师信息
	public function delete($id)
	{
		return Teacher::where('teacher_id',$id)->delete();
	}

	//获取到指定的一个老师信息
	public function getTeacher($id)
	{
		return Teacher::find($id);
	}

	//更新指定的老师信息
	public function updateTeacher($d,$id)
	{ 
		$this->img_is_new($d,$id);
		//老师图片是否更如果更新的话删除之前的保存新的
		return Teacher::where('teacher_id',$id)->update(array_except($d,['file','teacher_id']));
	}

	//判断是否更新了图片信息
	public function img_is_new($d,$id)
	{
		$teacher_pic = Teacher::where('teacher_id',$id)->value('teacher_pic');
		if($d['teacher_pic'] != $teacher_pic){
			@unlink('.'.$teacher_pic);
			return true;	//更新了图片
		}
		return false;
	}

	//同步到第三张表
	public function sync($d)
	{
		$teacher = Teacher::where('teacher_id',$d['teacher_id'])->first();
		return $teacher->courses()->sync($d['course_id']);
	}
}
?>