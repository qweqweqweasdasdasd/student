<?php

//后台管理--登录显示
Route::get('/login','Admin\LoginController@login')->name('login');
//后台管理--登录操作
Route::post('/dologin','Admin\LoginController@dologin');
//后台管理--管理登出
Route::get('/logout','Admin\LoginController@logout');

/////////////////////////////后台管理中间件////////////////////////////////////
Route::group(['middleware'=>'auth:admin'],function(){
	//后台管理--welcome
	Route::get('/welcome','Admin\IndexController@welcome');
	//后台管理--管理首页
	Route::get('/index/index','Admin\IndexController@index');

	//通过指定的专业id获取到课程信息
	Route::post('/lesson/getcoursebypro','Admin\LessonController@getcoursebypro');
	//通过指定的课程id获取到课时信息
	Route::post('/lesson/getlessonbycourse','Admin\LessonController@getlessonbycourse');
	//通过指定课程id获取到老师的信息
	Route::post('/course/getteacherbycourse','Admin\CourseController@getteacherbycourse');
	//课时管理文件上传
	Route::post('/upload/images','Admin\UploadController@images');
    ////////////////////////////////禁止翻墙//////////////////////////////////////
	Route::group(['middleware'=>'fanqiang'],function(){
		//角色管理--资源路由
		Route::resource('/role','Admin\RoleController');
		//角色管理--删除勾选
		Route::post('/role/alldel','Admin\RoleController@alldel');
		//角色管理--分配权限
		Route::match(['get','post'],'/role/dis/{r_id?}','Admin\RoleController@dis');

		//管理员--资源路由
		Route::resource('/manager','Admin\ManagerController');
		//管理员--批量删除
		Route::post('/manager/alldel','Admin\ManagerController@alldel');

		//权限管理--资源路由
		Route::resource('/permission','Admin\PermissionController');

		//专业管理--资源路由
		Route::resource('/profession','Admin\ProfessionController');
		//专业管理--删除勾选专业
		Route::post('/profession/alldel','Admin\ProfessionController@alldel');

		//课时管理--资源路由
		Route::resource('/lesson','Admin\LessonController');
		
		//课时勾选删除
		Route::post('/lesson/alldel','Admin\LessonController@alldel');

		//课程管理--资源路由
		Route::resource('/course','Admin\CourseController');
		
		//教师管理--资源路由
		Route::resource('/teacher','Admin\TeacherController');
		//教师管理--教师详情
		Route::get('/teacher/info/{teacher}','Admin\TeacherController@info');
		//教师管理--分配课程
		Route::get('/teacher/dis/{teacher}','Admin\TeacherController@dis');
		//教师管理--分配动作
		Route::post('/teacher/distribution','Admin\TeacherController@distribution');
	});
});


//首页
Route::get('/{profession?}','Home\IndexController@index');
//前台管理
Route::group(['prefix' => 'home','namespace'=>'Home'],function(){
	
	Route::group(['middleware'=>'auth:home'],function(){
		//商店管理--添加购物车信息
		Route::get('/shop/cart_add/{course}','ShopController@cart_add');
		//商店管理--结算账目
		Route::get('/shop/cart_account','ShopController@cart_account');
		//商店管理--结算
		Route::get('/shop/cart_jiesuan','ShopController@cart_jiesuan');
		//商店管理--支付完成回调
		Route::get('/shop/return_url','ShopController@return_url');
	});
	//前台管理--新学员注册
	Route::match(['get','post'],'/student/register','StudentController@register');
	//前台管理--课程详情
	Route::get('/course/detail/{course}','CourseController@detail');
	//前台管理--登录
	Route::match(['get','post'],'/student/login','StudentController@login')->name('home_login');
	//前台管理--退出登录
	Route::get('/student/logout','StudentController@logout');
});

