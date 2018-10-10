<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CourseRepository;
use App\Repositories\LessonRepository;
use App\Repositories\ProfessionRepository;

class LessonController extends Controller
{
    //私有属性
    protected $courseRepository;
    protected $lessonRepository;
    protected $professionRepository;

    //构造函数
    function __construct(CourseRepository $courseRepository,ProfessionRepository $professionRepository,LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
        $this->courseRepository = $courseRepository;
        $this->professionRepository = $professionRepository;
    }
    
    //课时显示
    public function index(Request $request)
    {   
        error_reporting(0);
        $data['pro_id'] = $request->get('pro_id')?$request->get('pro_id'):'';
        $data['course_id'] = $request->get('course_id')?$request->get('course_id'):'';
        $data['lesson_id'] = $request->get('lesson_id')?$request->get('lesson_id'):'';

        $lessons = $this->lessonRepository->getLessons($data);
       /* dd($lessons);*/
        $courses = $this->courseRepository->getCourses();
        $professions = $this->professionRepository->getProfessions();
        $teacher_arr = $this->lessonRepository->getTeacherArr();

        return view('admin.lesson.index',compact('lessons','courses','professions','data','teacher_arr'));
    }

    //课时创建页面
    public function create()
    {
        $professions = $this->professionRepository->getProfessions();
        $courses = $this->courseRepository->getCourses();
        $teacher_arr = $this->lessonRepository->getTeacherArr()->toArray();
        
        return view('admin.lesson.create',compact('professions','courses','teacher_arr'));
    }

    //保存课时信息
    public function store(Request $request)
    {
        $this->lessonRepository->storeLesson($request->all());

        return ['code'=>config('code.success')];
    }

    //无用
    public function show($id)
    {
        //
    }

    //课时编辑显示
    public function edit($id)
    {
        $professions = $this->professionRepository->getProfessions();
        $courses = $this->courseRepository->getCourses();
        $lesson = $this->lessonRepository->getLesson($id);
        $teacher_arr = $this->lessonRepository->getTeacherArr()->toArray();
       
        return view('admin.lesson.edit',compact('professions','courses','lesson','teacher_arr'));
    }

    //更新课时编辑数据
    public function update(Request $request, $id)
    {
        /*dd($request->all());*/
        $this->lessonRepository->checkImageSame($request->all(),$id);
        $this->lessonRepository->updateLesson($request->all(),$id);

        return ['code'=>config('code.success')];
    }

    //删除课时的信息
    public function destroy($id)
    {
        $this->lessonRepository->delete($id);

        return ['code'=>config('code.success')];
    }

    //通过指定的专业id获取到课程信息
    public function getcoursebypro(Request $request)
    {
        $course = $this->courseRepository->getcoursebypro($request->get('pro_id'));

        return ['code'=>config('code.success'),'course'=>$course];
    }

    //通过指定的课程id获取到课时信息
    public function getlessonbycourse(Request $request)
    {
        $lesson = $this->courseRepository->getlessonbycourse($request->get('course_id'));

        return ['code'=>config('code.success'),'lesson'=>$lesson];
    }

    //勾选的课时删除
    public function alldel(Request $request)
    {
        dd($request->all());
        $ids = $request->get('ids');
        foreach ($ids as $k => $v) {
            $this->destroy($v);
        }
        return ['code'=>config('code.success')];
    }
}
