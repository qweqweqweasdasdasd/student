<?php

namespace App\Http\Controllers\Home;

use Auth;
use \App\Tools\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Repositories\CourseRepository;
use EchoBool\AlipayLaravel\Facades\Alipay;

class ShopController extends Controller
{
	//私有属性
	protected $courseRepository;

	//构造函数
	public function __construct(CourseRepository $courseRepository,OrderRepository $orderRepository)
	{
		$this->orderRepository = $orderRepository;
        $this->courseRepository = $courseRepository;
	}		
	
    //商店管理--添加购物车信息
    public function cart_add($course_id)
    {
    	$course = $this->courseRepository->getCourse($course_id);

    	$info = [
    		'course_id'=>$course->course_id,
    		'course_name'=>$course->course_name,
    		'course_price'=>$course->course_price
    	];
        //添加到 redis
    	$cart = new Cart();
    	$cart->add($info);

    	return view('home.shop.cartadd',compact('course'));
    }

    //商店管理--结算账目
    public function cart_account(Request $Request)
    {
        //从购物车上拿数据
        $cart = new Cart();
        $cartinfo = $cart->getCartInfo();

        //获取到课程的总数量,总价格
        $number_price = $cart->getNumberPrice();
        //给课程设置图片
        $course_ids = array_keys($cartinfo);
        $course_img = $this->courseRepository->getCourseImg($course_ids);
        
    	return view('home.shop.cartaccount',compact('cartinfo','number_price','course_img'));
    }

    //商店管理--结算
    public function cart_jiesuan()
    {
        //实例化购物车
        $cart = new Cart();
        $cartinfo = $cart->getCartInfo();
        $number_price = $cart->getNumberPrice();

        $order_sn = date('Ymdhis',time()).mt_rand(10000,99999); 
        if(!empty($number_price['price'])){
            // 数据统计记录订单
            $order = [
                'order_sn'=>$order_sn,
                'std_id'=>\Auth::guard('home')->user()->std_id,
                'total_price'=>$number_price['price'],
                'pay_status'=>config('payStatus.non-payment'),    //未付款
            ];
            //订单数据保存
            $order = $this->orderRepository->createOrder($order);
            //订单详情表
            $this->orderRepository->createOrderCourse($cartinfo,$order);
            //清空购物车
            $cart->delall();
            //对订单进行支付
            $out_trade_no = $order_sn;
            //订单名称
            $subject = '订单号: '.$order_sn;
            //支付金额
            //$total_amount = $number_price['price'];
            $total_amount = '1';
            //商品描述为空
            $body = '';
            $customData = json_encode(['model_name' => 'ewrwe', 'id' => 121]);//自定义参数
            $response = Alipay::tradePagePay($subject, $body, $out_trade_no, $total_amount, $customData);
            //输出表单
            return $response['redirect_url'];
        }
        return ['code'=>config('code.error'),'error'=>'购物车为空'];
    }

    //支付完成之后的回调函数
    public function return_url(Request $request)
    {
        $result = Alipay::notify($_GET);
         /* 实际验证过程建议商户添加以下校验。
           1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
           2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
           3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
           4、验证app_id是否为该商户本身。
           */
        if($result){    //支付成功//
            //根据商户订单号指定更新支付信息
            if(!$this->orderRepository->updatePayInfo($_GET)){
                echo '付款ok,,数据更新失败,,请拿你的单号联系在线客服';
                exit();
            };
            return view('home/shop/return_url');
        }else{
            echo '验证失败';
            exit();
        };
    }
}
