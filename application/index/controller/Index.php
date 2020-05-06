<?php
namespace app\index\controller;

use think\captcha\Captcha;
class Index extends Base
{
    public function index(){


        $data = [];
        $catename=null;
        if(input('id')){
            $data = [
                'cate_id' => input('id')

            ];
            $catename=model('Cate')->where('id',input('id'))->value('catename');
        }
        $articles = model('Article')->where($data)->with('admin')->order('create_time','desc')->paginate(5);

        $viewDate =[
            'articles' => $articles,
            'catename' => $catename,
        ];
        $this->assign($viewDate);
        return view();
    }

    public function register(){

        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email'),
                'password'=>input('post.password'),
                'conpass'=>input('post.conpass'),
                'verify'=>input('post.verify')

            ];
            $result=model('Member')->register($data);
            if($result == 1){
                $this->success('注册成功','index/index/login');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    public function login(){
        if(request()->isAjax()){

            $data=[
                'username' => input('post.username'),
                'password' => input('post.password'),
                'verify' => input('post.verify')
            ];
            $result=model('Member')->login($data);
            if ($result == 1){
                $this->success('登录成功','index/index/index');
            }else{
                $this->error($result);
            }
        }

        return view();
    }

    public function verify() {
        $captcha = new Captcha();
        return $captcha->entry(); 
    }
}
