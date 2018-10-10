<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    protected $primaryKey = 'mg_id';
	
	protected $table = 'manager';

	protected $rememberTokenName = 'remember_token';
	
    protected $fillable = [
    	'mg_name','password','r_id','session_id','ip','remark','status','last_login_time'
    ];
    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];

    //建立管理员和角色的关系 (一对一)
    public function role()
    {
        return $this->hasOne('App\Role','r_id','r_id');
    }
}
