<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodsModel;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    //
    public function index(){
//        echo '123';
        $appid = 'wxfe4e16669b91d830';
        $appsercret = 'b6cde8048ba58f021050069aafa613ea';
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsercret.'';
        $a=file_get_contents($url);
        echo $a;
    }


    public function getwxtoken(){
        $appid = 'wxfe4e16669b91d830';
        $appsercret = 'b6cde8048ba58f021050069aafa613ea';
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsercret.'';
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);//请求url地址
        curl_setopt($ch,CURLOPT_HEADER,0);//是否返回响应头信息
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//s是否将结果返回
        $response = curl_exec($ch);//执行
        curl_close($ch);//关闭
        echo $response;
    }


    /*
     * 商品
     * */
    public function goods(){
        $goods_id = request()->get('goods_id');
//        $goodsinfo = GoodsModel::select('goods_id')->where('goods_id',$goods_id)->first();
        $key =  'good_count'.$goods_id;
        $redis_count = Redis::hget($key,'data');
        if(empty($redis_count)){
            $goodsinfo = GoodsModel::select('goods_id','cat_id','goods_name','shop_price')->where('goods_id',$goods_id)->first();
            $data = $goodsinfo->toArray();
            Redis::hset($key,'data',$data);
            echo '正在缓存';
        }else{
            echo '已经缓存';
            $count = Redis::incr('good-'.$goods_id);
            echo '访问次数：'. $count;
            echo '<br>';
            echo date('Ymd');
        }




    }


/*
 *
 *对称解密
 * */
    public function aes(){
        $method = 'AES-256-CBC';
        $enc_data = $_POST['data'];
//        $data = '李星轩';
        $iv = 'jjjjjkkkkkiiiiii';
        $key = '1911www';
        $data = openssl_decrypt($enc_data,$method,$key,OPENSSL_RAW_DATA,$iv);
            echo '解密的数据:'.$data;


//        echo '访问api';
    }

    /*
     * 非对称解密
     * */
    public function aes2(){
       $data = $_POST['data'];
        $content = file_get_contents(storage_path('priv.key'));
        $priv_key = openssl_get_privatekey($content);
        openssl_private_decrypt($data,$dec_data,$priv_key);
       echo '解密的数据：'.$dec_data;

       $wwwpub = file_get_contents(storage_path('pub.key'));
       openssl_public_encrypt($dec_data,$enc_data,$wwwpub);
       echo '再次加密的：'.$enc_data;
        $url = 'http://www.1911.com/usr/aes3';
        $post_data = [
            'data' => $enc_data,
        ];
        $ch=curl_init();
        //设置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //发送请求
        $response=curl_exec($ch);
        echo $response;
        curl_close($ch);


    }


/*
 * 签名
 * */
public function sign(){
        $key = 'api1911';
        $sign = $_GET['sign'];
        $data = $_GET['data'];
        $sign_str = sha1($data.$key);
        if($sign_str == $sign){
            echo '签名成功';
        }else{
            echo '签名失败';
        }


}


public function sign2(){
    $data = $_POST['data'];
    $signature = $_POST['sign'];
    $contents = file_get_contents(storage_path('pub.key'));
    $sign = openssl_get_publickey($contents);
    $ok = openssl_verify($data,$signature,$sign,OPENSSL_ALGO_SHA1);
    echo '1';
 echo $ok;

}

    public function getwww(){
        $url = "http://www.1911.com/usr/info";
        $response = file_get_contents($url);
       var_dump($response);
    }



}
