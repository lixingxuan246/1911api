<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class ViewCount
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
        //获取用户访问的接口  接口计数
        $b = $request->getRequestUrI();
//        echo $b;
//        $c = $request->getMethod();
        $c = substr($b,0,7);
//        echo $c;
        $user_id = $request->get('user_id');
        $date = date('Ymd');
        echo $date;
        $key = $c.'..'.$date;
        Redis::zincrby($key,'1','count');




        //获取每个用户访问的接口统计
        $key2 = "h:view_count:".$user_id;
        $key13 = 'key4'.$user_id;
        $key9 = Redis::hget('key4'.$user_id,'count');
        if(empty($key9)){
            $key3 = '1';
        }else{
            $key3 = $key9;
        }

        $key7 = Redis::hset($key2,$key3,$b);
        $key4 = Redis::hincrby($key13,'count',1);

        $key8 = Redis::hset('key4'.$user_id,'count',$key4);
        return $next($request);
    }
}
