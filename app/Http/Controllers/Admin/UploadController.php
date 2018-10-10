<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
	protected $allow_ext = ['jpg','jpeg','gif','png'];
	protected $ext = '';
	protected $max_size = 5*2014*2014;
	protected $path = './uploads/image/';
	protected $path_url = '';

    //上传课时的图片
    public function images(Request $request)
    {
    	//文件后缀名称检查一下
    	if(!$this->check_ext($_FILES['file'])){
    		return ['code'=>config('code.error'),'msg'=>'文件必须是jpg,jpeg,gif,png'];
    	};
    	//文件的大小检查一下
    	if(!$this->check_size($_FILES['file'])){
    		return ['code'=>config('code.error'),'msg'=>'文件必须不可大于'.$this->max_size];
    	}
    	//创建目录
    	$sub_path = date('Ymd',time()).'/';

    	if(!is_dir($this->path.$sub_path)){
    		mkdir($this->path.$sub_path,0777,true);
    	}
    	$file_name = date('YmdHis',time()).'.'.$this->ext;
    	//保存到数据库内
    	$this->path_url = ltrim($this->path.$sub_path.$file_name,'.');

    	//移动图片到服务器上面
    	if(move_uploaded_file($_FILES['file']['tmp_name'],'.'.$this->path_url)){
    		return ['code'=>config('code.success'),'path_url'=>$this->path_url];
    	}
    	return ['code'=>config('code.error')];
    	
    }

    //文件大小检查一下
    public function check_size($file)
    {
    	if($file['size'] > $this->max_size){
    		return false;
    	}
    	return true;
    }

    //文件名称检查
    public function check_ext($file)
    {
    	$this->ext = explode('.',$file['name'])[1];

    	return in_array($this->ext,$this->allow_ext);
    }
}
