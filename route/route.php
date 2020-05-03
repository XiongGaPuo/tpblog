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
});
