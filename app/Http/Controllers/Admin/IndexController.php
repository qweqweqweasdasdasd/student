<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //后台管理--管理首页
    public function index()
    {
    	return view('admin.index.index');
    }

    //后台管理--welcome
    public function welcome()
    {
    	return view('admin.index.welcome');
    }
}
