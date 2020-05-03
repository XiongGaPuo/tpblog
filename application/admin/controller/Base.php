<?php

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    //初始化方法
    public function initialize()
    {
        //查看是否有 名为admin的session数据里的id, 如果有则就直接跳转后台页面避免重复登录
        if(!session('?admin.id')){
            $this->redirect('admin/index/login');
        }
    }
}
