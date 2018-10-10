<?php 
namespace App\Repositories;

use App\Permission;

class PermissionRepository 
{
	//获取到所有的权限信息
	public function getPermissions()
	{
		return Permission::get()->toArray();
	}

	//保存权限信息
	public function storePermission($d)
	{
		$data = $this->createLevel($d);
		
		return Permission::create($data);
	}

	//计算level
	public function createLevel($d)
	{
		if($d['ps_pid'] != 0){
			$d['level'] = (string)(Permission::where('ps_id',$d['ps_pid'])->value('level')+1);
		}
		return $d;
	}

	//获取到一个权限信息
	public function getPermission($id)
	{
		return Permission::find($id);
	}

	//更新权限信息
	public function updatePermission($d,$id)
	{
		$data = $this->createLevel($d);
		
		return Permission::where('ps_id',$id)->update(array_except($data,['ps_id']));
	}

	//删除指定的权限信息
	public function delete($id)
	{
		if(Permission::where('ps_pid',$id)->count()){
			return false;
		}
		return Permission::where('ps_id',$id)->delete();
	}

	//获取到指定的level权限
	public function permission_n($n = 0)
	{
		return Permission::where('level',$n)->get();
	}
}
?>