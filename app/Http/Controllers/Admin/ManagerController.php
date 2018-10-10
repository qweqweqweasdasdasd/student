<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ManagerRepository;
use App\Http\Requests\SaveManagerRequest;

class ManagerController extends Controller
{
    //私有属性
    protected $managerRepository;
    //构造函数   
    function __construct(ManagerRepository $managerRepository)
    {
        $this->managerRepository = $managerRepository;
    }
    
    //显示管理员列表
    public function index(Request $request)
    {
        $managers = $this->managerRepository->getManagers($request->get('mg'));
        
        return view('admin.manager.index',compact('managers'));
    }

    //创建录入页面
    public function create()
    {
        $roles = $this->managerRepository->getroles();

        return view('admin.manager.create',compact('roles'));
    }

    //保存录入的信息
    public function store(SaveManagerRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);  //加密
        $this->managerRepository->storeManager($data);

        return ['code'=>config('code.success')];
    }

    //无用
    public function show($id)
    {
        //
    }

    //显示修改的页面
    public function edit($id)
    {
        $roles = $this->managerRepository->getroles();
        $manager = $this->managerRepository->getManager($id);

        return view('admin.manager.edit',compact('roles','manager'));
    }

    //更新修改的数据
    public function update(Request $request, $id)
    {
        $data = $request->all();
        if($this->managerRepository->isChangePassword($request->all())){  //修改了为true
            $data['password'] = Hash::make($data['password']);  //加密
        };
        $this->managerRepository->updateManager($data,$id);
        
        return ['code'=>config('code.success')];
    }

    //删除指定的数据
    public function destroy($id)
    {
        $this->managerRepository->delete($id);

        return ['code'=>config('code.success')];
    }

    //管理员--批量删除
    public function alldel(Request $request)
    {
        $this->managerRepository->alldel($request->get('ids'));
        
        return ['code'=>config('code.success')];
    }
}
