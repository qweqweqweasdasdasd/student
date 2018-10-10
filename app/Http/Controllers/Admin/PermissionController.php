<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PermissionRepository;

class PermissionController extends Controller
{
    //私有属性
    protected $permissionRepository;

    //构造函数   
    function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    
    //显示权限管理页面
    public function index()
    {
        $permissions = generateTree($this->permissionRepository->getPermissions());
        
        return view('admin.permission.index',compact('permissions'));
    }

    //创建权限编辑页面
    public function create()
    {
        $permissions = generateTree($this->permissionRepository->getPermissions());

        return view('admin.permission.create',compact('permissions'));
    }

    //保存权限信息
    public function store(Request $request)
    {
        $this->permissionRepository->storePermission($request->all());

        return ['code'=>config('code.success')];
    }

    //无用
    public function show($id)
    {
        //
    }

    //编辑权限显示
    public function edit($id)
    {
        $permissions = generateTree($this->permissionRepository->getPermissions());
        $permission = $this->permissionRepository->getPermission($id);

        return view('admin.permission.edit',compact('permission','permissions'));
    }

    //更新权限数据
    public function update(Request $request, $id)
    {
        $this->permissionRepository->updatePermission($request->all(),$id);

        return ['code'=>config('code.success')];
    }

    //删除权限数据
    public function destroy($id)
    {
        //删除指定的权限信息
        $z = $this->permissionRepository->delete($id);

        return $z ? ['code'=>config('code.success')]:['code'=>config('code.error'),'error'=>'此物有子孙不得删除!'];
    }
}
