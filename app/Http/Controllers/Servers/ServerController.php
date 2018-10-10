<?php

namespace App\Http\Controllers\Servers;

use Illuminate\Http\Request;
use App\Lib\Sms\RongLianYun;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\CheckphoneRequest;

class ServerController extends Controller
{
    //短信发送的接口
    public function sendsms(CheckphoneRequest $request)
    {
    	$tel = ($request->get('_phone'));
    	$rl = new \App\Lib\Sms\RongLianYun();
    	//调用方法
    	$result = $rl->sendTemplateSMS($tel,array('123456',config('sms.delay')),config('sms.template_id'));
    	if($result == NULL ) {
   
            return ['code'=>config('sms.error'),'error'=>'请求失败!'];
         }
         if($result->statusCode!=0) {
          
            return ['code'=>$result->statusCode,'msg'=>$result->statusMsg];
             //TODO 添加错误处理逻辑
         }else{
            // 获取返回信息
	        $smsmessage = $result->TemplateSMS;
	        
	        /*echo "dateCreated:".$smsmessage->dateCreated."<br/>";
	        echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";*/
	       	//入库操作
	        Redis::set($tel,$smsmessage->smsMessageSid.':'.$smsmessage->dateCreated);

	        return ['code'=>config('code.success'),'error'=>'发送成功'];
         }
    	
    }
}
