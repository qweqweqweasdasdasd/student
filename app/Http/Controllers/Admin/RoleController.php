<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use App\Http\Requests\StoreRoleRequest;
use App\Repositories\PermissionRepository;

class RoleController extends Controller
{
    //私有属性
    protected $roleRepository;
    protected $permissionRepository;

    //构造方法
    function __construct(RoleRepository $roleRepository,PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }
    
    //显示角色列表
    public function index(Request $request)
    {
        $roles = $this->roleRepository->getroles($request->get('r'));

        return view('admin.role.index',compact('roles'));
    }

    //创建录入表单
    public function create()
    {
        return view('admin.role.create');
    }

    //创建录入表单保存数据
    public function store(StoreRoleRequest $request)
    {
        $z = $this->roleRepository->storeRole($request->all());

        return ['code'=>config('code.success')];
    }

    //不知道如何使用
    public function show($id)
    {
        //
    }

    //显示修改的页面
    public function edit($id)
    {
        $role = $this->roleRepository->getRoleById($id);

        return view('admin.role.edit',compact('role'));
    }

    //更新指定的数据
    public function update(StoreRoleRequest $request, $id)
    {
        $this->roleRepository->updateRoleById($id,$request->all());

        return ['code'=>config('code.success')];
    }

    //角色的删除
    public function destroy($id)
    {
        $this->roleRepository->delete($id);

        return ['code'=>config('code.success')];
    }

    //删除勾选的角色
    public function alldel(Request $request)
    {
        $this->roleRepository->alldel($request->get('ids'));

        return ['code'=>config('code.success')];
    }

    //角色管理--分配权限
    public function dis(Request $request)
    {
        if($request->isMethod('post')){
            $z = $this->roleRepository->updateDis($request->all());

            return ['code'=>config('code.success')];
        }
        $role = $this->roleRepository->getRoleById($request->route('r_id'));
        $permission_0 = $this->permissionRepository->permission_n(0);
        $permission_1 = $this->permissionRepository->permission_n(1);
        $permission_2 = $this->permissionRepository->permission_n(2);
        $ps_ids_arr = explode(',',$role->ps_ids);

        return view('admin.role.dis',compact('role','permission_0','permission_1','permission_2','ps_ids_arr'));
    }
}
