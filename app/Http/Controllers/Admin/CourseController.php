<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CourseRepository;
use App\Http\Requests\StoreCourseRequest;
use App\Repositories\ProfessionRepository;

class CourseController extends Controller
{
    //私有属性
    protected $courseRepository;
    protected $professionRepository;

    //构造函数   
    function __construct(CourseRepository $courseRepository,ProfessionRepository $professionRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->professionRepository = $professionRepository;
    }
    
    //显示列表
    public function index(Request $request)
    {
        $courses = $this->courseRepository->getCourses($request->all());
        
        return view('admin.course.index',compact('courses'));
    }

    //创建新增页面
    public function create()
    {
        $professions = $this->professionRepository->getProfessions();

        return view('admin.course.create',compact('professions'));
    }

    //新增课程保存
    public function store(StoreCourseRequest $request)
    {
        $this->courseRepository->storeCourse($request->all());

        return ['code'=>config('code.success')];
    }

    //无用
    public function show($id)
    {
        //
    }

    //显示编辑
    public function edit($id)
    {
        $course = $this->courseRepository->getCourse($id);
        $professions = $this->professionRepository->getProfessions();

        return view('admin.course.edit',compact('course','professions'));
    }

    //更新数据入库
    public function update(Request $request, $id)
    {
        $this->courseRepository->updateCourse($request->all(),$id);

        return ['code'=>config('code.success')];
    }

    //删除指定的课程信息
    public function destroy($id)
    {
        $this->courseRepository->delete($id);

        return ['code'=>config('code.success')];
    }

    //通过课程id获取到老师的信息
    public function getteacherbycourse(Request $request)
    {
        $getTeacherWithCourse = $this->courseRepository->getgetTeacherWithCourse($request->all());

        return ['code'=>config('code.success'),'data'=>$getTeacherWithCourse];
    }
}
