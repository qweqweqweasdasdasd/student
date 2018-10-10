<?php 
namespace App\Repositories;

use App\Profession;

class ProfessionRepository 
{
	//保存专业的信息
	public function storeProfession($d)
	{
		return Profession::create($d);
	}

	//获取到全部的专业信息
	public function getProfessions($d = [])
	{
		$d = $this->checkArray($d);
		return Profession::where(function($query) use($d){
								if(count($d)>0){
									$query->where($d);
								}
							})->get();
	}

	//判断数组是否为空
	public function checkArray($d)
	{
		$newData = [];
		foreach ($d as $k => $v) {
			if(!is_null($v)){
				$newData[$k] = $v;
			}
		}
		return $newData;
	}

	//删除指定的专业信息
	public function delete($id)
	{
		return Profession::where('pro_id',$id)->delete();
	}

	//获取第一条数据
	public function getProfession($id)
	{
		return Profession::with(['courses'=>function($query) {	//待添加约束的预加载 判断是否为显示楼层
								$query->limit(5);
							}])->find($id);
	}

	//更新指定的专业的信息
	public function updateProfession($d,$id)
	{
		return Profession::where('pro_id',$id)->update(array_except($d,['pro_id']));
	}

	//删除勾选的专业信息
	public function alldel($ids)
	{
		foreach ($ids as $k => $v) {
			$this->delete($v);
		}
		return true;
	}

	
}
?>