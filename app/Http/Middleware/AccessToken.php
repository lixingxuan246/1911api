<?php

namespace App\Http\Middleware;

use App\Models\TokenController;
use Closure;
use Illuminate\Support\Facades\Redis;

class AccessToken
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

        $token = $request->get('tokens');

        if(empty($token)){
            $data =  [
              'error' => '00001',
              'msg' => '用户未授权'
            ];
            echo json_encode($data);
        }
        $models = new TokenController();

        $tokeninfo = $models->where('token','=',$token)->first();

//        echo $tokeninfo['token'];
        if($tokeninfo['token'] != $token){
            $data =  [
                'error' => '00001',
                'msg' => '授权失败'
            ];
            echo json_encode($data);
        }





        return $next($request);
    }
}
