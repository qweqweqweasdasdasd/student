<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    protected $primaryKey = 'r_id';
	
	protected $table = 'role';
	
    protected $fillable = [
    	'r_name','ps_ids','ps_ca'
    ];
    use SoftDeletes;
    protected $dates 	  = ['deleted_at'];

    //建立角色与权限的关系,,,,一对多的关系
    
}
