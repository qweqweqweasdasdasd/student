<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $primaryKey = 'order_id';
	
	protected $table = 'order';
	
    protected $fillable = [
    	'order_sn','trade_sn','std_id','total_price','pay_money','pay_status','pay_time'
    ];
    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];
}
