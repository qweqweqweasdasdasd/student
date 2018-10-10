<?php

namespace App\Http\Middleware;

use Closure;
use App\Manager;

class fanqiang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //获取到用户的会话id信息
        $mg_id = \Auth::guard('admin')->user()->mg_id;
        //获取到角色对应的信息
        $ps_ca = Manager::find($mg_id)->role->ps_ca;

        $nowCA = strtolower(getCurrentControllerName() . '-' . getCurrentMethodName());
        if(strpos($ps_ca,$nowCA) === false){
            echo '当前路由'.$nowCA.'<br/>';
            echo '路由列表'.$ps_ca.'<br/>';
            exit('没有权限');
        }
        return $next($request);
    }
}
