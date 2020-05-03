<?php

namespace app\admin\controller;


class Home extends Base
{
    //后台首页
    public function index(){
        return view();
    }

    public function Welcome(){
        return view();
    }

    public function admin_info(){
        return view();
    }

    public function menu(){
        return view();
    }

    public function out(){
        session('admin',null);
        $this->redirect('admin/index/login');
    }
}
