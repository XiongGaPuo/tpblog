<?php

namespace app\admin\controller;


class Home extends Base
{
    //后台首页
    public function index(){
        return view();
    }

    public function out(){
        session('admin',null);
        $this->redirect('admin/index/login');
    }
}
