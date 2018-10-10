<?php 
namespace App\Repositories;

use App\Order;
use App\Ordercourse;

class OrderRepository 
{
	//创建订单信息
	public function createOrder($order)
	{
		return Order::create($order);
	}

	//订单详情表入库
	public function createOrderCourse($cartinfo,$order)
	{
		foreach ($cartinfo as $k => $v) {
			Ordercourse::create([
				'order_id'=>$order->order_id,
				'course_id'=>$v['course_id'],
				'course_price'=>$v['course_price'],
			]);
		}
		return true;
	}

	//根据商户订单号指定更新支付信息
	public function updatePayInfo($d)
	{
		//商户订单号
		$out_trade_no = htmlspecialchars($d['out_trade_no']);
		//支付号交易号
		$trade_no = htmlspecialchars($d['trade_no']);

		return Order::where('order_sn',$out_trade_no)
						->update([
							'trade_sn'=>$trade_no,
							'pay_money'=>$d['total_amount'],
							'pay_time'=>$d['timestamp'],
							'pay_status'=>config('payStatus.payed'),
						]);
		
	}
}
?>