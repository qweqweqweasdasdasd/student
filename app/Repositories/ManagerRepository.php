<?php 
namespace App\Repositories;

use App\Role;
use App\Manager;

class ManagerRepository 
{
	//获取到管理员信息
	public function getManagers($mg)
	{
		return Manager::where(function($query) use($mg){
							if(!empty($mg)){
								$query->where('mg_name',$mg);
							}
						})->with('role')->paginate(7);
	}

	//获取到所有的角色信息
	public function getroles()
	{
		return Role::get();
	}

	//保存管理员信息到数据库
	public function storeManager($d)
	{
		return Manager::create($d);
	}

	//删除指定的管理员信息
	public function delete($id)
	{
		return Manager::where('mg_id',$id)->delete();
	}

	//获取到指定的管理员信息
	public function getManager($id)
	{
		return Manager::find($id);
	}

	//更新指定的管理员信息
	public function updateManager($d,$id)
	{
		return Manager::where('mg_id',$d['mg_id'])->update(array_except($d,['mg_id']));
	}

	//是否修改了密码
	public function isChangePassword($d)
	{
		$password = Manager::where('mg_id',$d['mg_id'])->value('password');
		if($password != $d['password']){
			return true;
		}
		return false;
	}

	//批量删除
	public function alldel($ids)
	{
		foreach ($ids as $v) {
			$this->delete($v);
		}
		return true;
	}
}
?>