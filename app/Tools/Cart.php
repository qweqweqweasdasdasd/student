<?php 
	namespace App\Tools;

	use Auth;
	use Illuminate\Support\Facades\Session;
	use Illuminate\Support\Facades\Redis;

	/**
	 * 购物车操作类
	 */
	class Cart 
	{
		//私有属性
		protected $cartInfo = array();	
		protected $useID = '';

		//构造函数
		public function __construct()
		{
			$this->useID = Auth::guard('home')->user()->std_id;
			$this->loadData();
		}
		
		//购物初始化数据
		public function loadData()
		{
			/*if(Session::has('cart')){
				$this->cartInfo = Session::get('cart');
			}*/
			if(Redis::get('cart:'.$this->useID)){
				$this->cartInfo = json_decode(Redis::get('cart:'.$this->useID),true);
			}

		}
		/*
		 * 将课程保存到购物车里面
		*/
		public function add($course)
		{
			$course_id = $course['course_id'];
			if(!empty($this->cartInfo) && array_key_exists($course_id,$this->cartInfo)){
				exit('该商品已经在购物车里面了');
			}else{
				$this->cartInfo[$course_id] = $course;
			}
			$this->savaData();
		}

		//清空指定的学员购物车信息
		public function delall()
		{
			unset($this->cartInfo);
			$this->savaData();
		}

		//获得购物车的课程总数量和总价格
		public function getNumberPrice()
		{
			$number = 0;	//数量
			$price = 0;		//价格
			foreach ($this->cartInfo as $_k => $_v) {
				$number += 1;
				$price += $_v['course_price'];
			}
			$arr['price'] = $price;
			$arr['number'] = $number;
			return $arr;
		}

		//返回所有的商品
		public function getCartInfo()
		{
			return $this->cartInfo;
		}

		/*
		 * 将刷新后的cartInfo数组的课程信息重新存入购物车
		*/
		public function savaData()
		{
			if(!empty($this->cartInfo)){
				//Session::put('cart',$this->cartInfo);
				Redis::set('cart:'.$this->useID,json_encode($this->cartInfo));
			}else{
				//Session::put('cart','');
				Redis::set('cart:'.$this->useID,'');
			}
		}

	}
?>