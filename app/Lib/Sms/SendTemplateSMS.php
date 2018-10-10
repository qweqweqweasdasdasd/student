<?php
    
    /**
     * 自定义荣联运发送短信的类
     */
    namespace App\Lib\Sms;

    use App\Lib\Sms\REST;

    class RongLianYun
    {
        protected $accountSid = '';
        protected $accountToken = '';
        protected $appId = '';
        protected $serverIP = 'app.cloopen.com';
        protected $serverPort = '8883';
        protected $softVersion = '2013-12-26';
         
        public function __construct()
        {
            $this->accountSid = config('sms.accountSid');
            $this->accountToken = config('sms.accountToken');
            $this->appId = config('sms.appId');
        }
        
        /**
          * 发送模板短信
          * @param to 手机号码集合,用英文逗号分开
          * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
          * @param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
          */       
        function sendTemplateSMS($to,$datas,$tempId)
        {
             // 初始化REST SDK
             $rest = new REST($this->serverIP,$this->serverPort,$this->softVersion);
             $rest->setAccount($this->accountSid,$this->accountToken);
             $rest->setAppId($this->appId);
             // 发送模板短信
             $result = $rest->sendTemplateSMS($to,$datas,$tempId);
             
             return $result;
            /* if($result == NULL ) {
                 echo "result error!";
                 break;
             }
             if($result->statusCode!=0) {
                 echo "error code :" . $result->statusCode . "<br>";
                 echo "error msg :" . $result->statusMsg . "<br>";
                 //TODO 添加错误处理逻辑
             }else{
                 echo "Sendind TemplateSMS success!<br/>";
                 // 获取返回信息
                 $smsmessage = $result->TemplateSMS;
                 echo "dateCreated:".$smsmessage->dateCreated."<br/>";
                 echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
                 //TODO 添加成功处理逻辑
             }*/
        }
    }
?>
