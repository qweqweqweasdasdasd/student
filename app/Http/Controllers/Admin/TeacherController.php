<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CourseRepository;
use App\Repositories\TeacherRepository;
use App\Http\Requests\StoreTeacherRequest;

class TeacherController extends Controller
{
    //私有属性
    protected $teacherRepository;
    protected $courseRepository;

    //构造函数
    function __construct(TeacherRepository $teacherRepository,CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->teacherRepository = $teacherRepository;
    }
    
    //显示老师列表
    public function index(Request $request)
    {
        error_reporting(0);
        $data = $request->all();
        $teacher = $this->teacherRepository->teachers($data);

        return view('admin.teacher.index',compact('teacher','data'));
    }

    //创建老师录入页面
    public function create()
    {
        return view('admin.teacher.create');
    }

    //保存创建老师的信息
    public function store(StoreTeacherRequest $request)
    {
        $this->teacherRepository->storeTeacher($request->all());

        return ['code'=>config('code.success')];
    }

    //无用
    public function show($id)
    {
        //
    }

    //显示编辑老师页面
    public function edit($id)
    {
        $teacher = $this->teacherRepository->getTeacher($id);

        return view('admin.teacher.edit',compact('teacher'));
    }

    //编辑老师的信息保存
    public function update(Request $request, $id)
    {
        $this->teacherRepository->updateTeacher($request->all(),$id);

        return ['code'=>config('code.success')];
    }

    //删除指定的老师
    public function destroy($id)
    {
        $this->teacherRepository->delete($id);

        return ['code'=>config('code.success')];
    }

    //查看指定的老师信息
    public function info(Request $request)
    {
        $teacher = $this->teacherRepository->getTeacher($request->route('teacher'));
        
        return view('admin.teacher.info',compact('teacher'));
    }

    //给老师分配课程
    public function dis(Request $request)
    {
        $teacher =  $this->teacherRepository->getTeacher($request->route('teacher'));   //如果老师的ids在总量内的话显示
        $course = $this->courseRepository->getCourses();
        $courses_arr = $this->make_courses_arr($teacher->courses->toArray());
        
        return view('admin.teacher.dis',compact('teacher','course','courses_arr'));
    }

    //将维获取id数值
    public function make_courses_arr($d)
    {
        $newData = [];
        foreach ($d as $key => $value) {
            $newData[] = $value['course_id'];
        }
        return $newData;
    }

    //分配的动作
    public function distribution(Request $request)
    {
        $this->teacherRepository->sync($request->all());

        return ['code'=>config('code.success')];
    }

}
