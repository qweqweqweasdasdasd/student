<?php 
namespace App\Repositories;

use App\Role;
use App\Permission;

class RoleRepository 
{
	//保存创建的数据
	public function storeRole($d)
	{
		return Role::create($d);
	}

	//显示所有的角色信息
	public function getroles($r)
	{
		return Role::where(function($query) use($r) {
						if(!empty($r)){
							$query->where('r_name',$r);
						}
					})->paginate(6);
	}

	//删除指定的角色信息
	public function delete($id)
	{
		return Role::where('r_id',$id)->delete();
	}

	//获取到指定的角色
	public function getRoleById($id)
	{
		return Role::find($id);
	}

	//更新指定的信息
	public function updateRoleById($id,$d)
	{
		return Role::where('r_id',$id)->update(array_except($d,['r_id']));
	}

	//批量删除
	public function alldel($ids)
	{
		foreach ($ids as $v) {
			$this->delete($v);
		}
		return true;
	}

	//根据角色id更新ps_ids信息
	public function updateDis($d)
	{
		$data['ps_ids'] = implode(',',$d['ps_id']); // ps_ids
		$ps_ca = Permission::whereIn('ps_id',$d['ps_id'])
										->select(\DB::raw("concat(ps_c,'-',ps_a) as ca"))
										->whereIn('level',[1,2])
										->pluck('ca')
										->toArray();
		$data['ps_ca'] = implode(',', $ps_ca);
		
		return Role::where('r_id',$d['r_id'])->update($data);
	}
}
?>