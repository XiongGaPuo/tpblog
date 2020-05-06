<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------



Route::rule('article/:id','index/article/info','get');
Route::rule('cate/:id','index/index/index','get');
Route::rule('/','index/index/index','get|post');
Route::rule('register','index/index/register','get|post');
Route::rule('login','index/index/login','get|post');
Route::get('verify','index/verify');



Route::group('admin',function(){
    Route::rule('/','admin/index/login','get|post');
    Route::rule('register','admin/index/register','get|post');
    Route::rule('sendCode','admin/index/sendCode','get|post');
    Route::rule('verify','admin/index/verify','get|post');
    Route::rule('reset','admin/index/reset','get|post');

    Route::rule('home/index','admin/home/index','get|post');
    Route::rule('home/welcome','admin/home/welcome','get|post');
    Route::rule('home/out','admin/home/out','get|post');
    Route::rule('home/admin_info','admin/home/admin_info','get|post');

    Route::rule('cate/lists','admin/cate/lists','get|post');
    Route::rule('cate/add','admin/cate/add','get|post');
    Route::rule('cate/edit/[:id]','admin/cate/edit','get|post');
    Route::rule('cate/sort','admin/cate/sort','post');
    Route::rule('cate/del','admin/cate/del','post');

    Route::rule('article/lists','admin/article/lists','get');
    Route::rule('article/add','admin/article/add','get|post');
    Route::rule('article/top','admin/article/top','get|post');
    Route::rule('article/edit/[:id]','admin/article/edit','get|post');
    Route::rule('article/del','admin/article/del','post');

    Route::rule('member/lists','admin/member/lists','get');
    Route::rule('member/add','admin/member/add','get|post');
    Route::rule('member/edit/[:id]','admin/member/edit','get|post');
    Route::rule('member/del','admin/member/del','post');

    Route::rule('admin/lists','admin/admin/lists','get');
    Route::rule('admin/add','admin/admin/add','get|post');
    Route::rule('admin/edit/[:id]','admin/admin/edit','get|post');
    Route::rule('admin/del','admin/admin/del','post');
    Route::rule('admin/super','admin/admin/super','post');
    Route::rule('admin/status','admin/admin/status','post');

    Route::rule('comment/lists','admin/comment/lists','get');
    Route::rule('comment/del','admin/comment/del','post|get');

    Route::rule('system/set','admin/system/set','get|post');

});
