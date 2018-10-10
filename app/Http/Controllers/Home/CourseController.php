<?php

namespace App\Http\Controllers\Home;

use \App\Tools\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Repositories\CourseRepository;


class CourseController extends Controller
{
	//私有属性
	protected $courseRepository;

	//构造函数	
	function __construct(CourseRepository $courseRepository)
	{
		$this->courseRepository = $courseRepository;
	}
	
    //前台管理--课程详情
    public function detail(Request $request,$course_id)
    {
    	
	    $course = $this->courseRepository->getCourse($course_id);
	    $course->lesson_count = $course->lessons->count();
    	
    	return view('home.course.detail',compact('course'));
    }
}
