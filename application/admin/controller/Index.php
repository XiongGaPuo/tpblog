<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{

    public function initialize()
    {
        //查看是否有 名为admin的session数据里的id, 如果有则就直接跳转后台页面避免重复登录
        if(session('?admin.id')){
            $this->redirect('admin/home/index'); //redirect 重定向方法
        }
    }

    //后台登录
    public function login(){

        if(request()->isAjax()){
            $data=[
                'username' => input('post.username'),
                'password' => input('post.password')
            ];

            $result = model('Admin')->login($data);
            if ($result == 1){
                $this->success('登录成功!','admin/home/index');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    public function register(){
        if(request()->isAjax()){
            $data=[
                'username' => input('post.username'),
                'password' => input('post.password'),
                'conpass' => input('post.conpass'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email'),
            ];
            $result = model('Admin')->register($data);

            if($result == 1){
                mailto($data['email'],'注册已成功',"您的账号是{$data['username']},密码是{$data['password']}");
                $this->success('注册成功','admin/index/login');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //发送验证码
    public function sendCode(){

        if(request()->isAjax()){
            $data = [
              'email' => input  ('post.email')
            ];
            $result = model('Admin')->sendCode($data);

            if ($result == 1){
                $this->success('验证码发送成功!');
            }else{
                $this->error($result);
            }
        }

        return view('forget');

    }

    public function verify(){
        $data = [
            'code' => input('post.code'),
        ];
        $result = model('Admin')->verify($data);
        if($result == 1){
            $this->success('验证码已经通过,请输入新密码');
        }else{
            $this->error($result);
        }
    }

    public function reset(){
        $data = [
            'email' => input('post.email'),
            'password' => input ('post.password'),
            'conpass' => input('post.conpass')
        ];
        $result = model('Admin')->reset($data);
        if($result == 1){
            $this->success('密码重置成功','admin/index/login');
        }else{
            $this->error($result);
        }
    }
}
