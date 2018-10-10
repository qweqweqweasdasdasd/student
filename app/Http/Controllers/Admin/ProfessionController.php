<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProfessionRepository;

class ProfessionController extends Controller
{
    //私有属性
    protected $professionRepository;

    //构造函数
    function __construct(ProfessionRepository $professionRepository)
    {
        $this->professionRepository = $professionRepository;
    }
    
    //显示权限的列表
    public function index(Request $request)
    {
        error_reporting(0);
        $professions = $this->professionRepository->getProfessions($request->all());

        return view('admin.profession.index',compact('professions'));
    }

    //创建视图显示
    public function create()
    {
        return view('admin.profession.create');
    }

    //专业数据的保存
    public function store(Request $request)
    {
        $this->professionRepository->storeProfession($request->all());
        
        return ['code'=>config('code.success')];
    }

    //不用
    public function show($id)
    {
        //
    }

    //编辑修改的页面
    public function edit($id)
    {
        $profession = $this->professionRepository->getProfession($id);

        return view('admin.profession.edit',compact('profession'));
    }

    //更新指定的专业
    public function update(Request $request, $id)
    {
        $this->professionRepository->updateProfession($request->all(),$id);

        return ['code'=>config('code.success')];
    }

    //删除指定的专业
    public function destroy($id)
    {
        $this->professionRepository->delete($id);

        return ['code'=>config('code.success')];
    }

    //专业管理--删除勾选专业
    public function alldel(Request $request)
    {
        $this->professionRepository->alldel($request->get('ids'));

        return ['code'=>config('code.success')];
    }
}
