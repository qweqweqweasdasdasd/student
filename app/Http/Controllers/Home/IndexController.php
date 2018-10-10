<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProfessionRepository;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
	//私有属性
	protected $professionRepository;

	//构造函数
	public function __construct(ProfessionRepository $professionRepository)
	{
		$this->professionRepository = $professionRepository;
	}

    //前台管理--显示主页
    public function index(Request $request)
    {
        $pro_id = $request->route('profession')?$request->route('profession'):'1';
    	$professions = $this->professionRepository->getProfessions();
    	$courses = $this->professionRepository->getProfession($pro_id)->courses;
        
    	return view('home.index.index',compact('professions','courses'));
    }

    
}
