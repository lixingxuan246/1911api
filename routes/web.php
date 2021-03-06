<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/wx/token','TestController@index');

Route::get('/wx/getwxtoken','TestController@getwxtoken');

Route::get('/getwww','TestController@getwww');
Route::get('/goods','TestController@goods');

Route::get('/kkk','RegController@kkk');

Route::post('/regpost','RegController@regpost');

Route::post('/loginpost','RegController@loginpost');

Route::get('/center','RegController@center')->middleware('accesstoken','viewcount');
Route::get('/apiredis','RegController@apiredis');


Route::get('/kucun','RegController@kucun')->middleware('accesstoken','viewcount');
Route::get('/qiandao','RegController@qiandao')->middleware('accesstoken','viewcount');


Route::post('/aes','TestController@aes');//对称解密
Route::post('/aes2','TestController@aes2');//非对称解密
Route::get('/sign','TestController@sign');//签名
Route::post('/signtwo','TestController@sign2');//签名

Route::post('/test2','TestController@test2');//签名

Route::get('/register','RegController@register');//注册
