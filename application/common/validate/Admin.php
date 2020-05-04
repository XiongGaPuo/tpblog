<?php


namespace app\common\validate;


use think\Validate;

class Admin extends Validate
//继承thinkphp验证器
{
    //验证规则,这里只验证内容是否为空

    protected $rule=[
        'username|用户名' => 'require|max:25',

        'oldpassword|旧密码'  =>'require|alphaNum',
        'password|密码' => 'require|min:6|max:25|alphaNum',


        //confirm验证 , 验证这条数据的值是否和confirm:输入的某条数据一致
        'conpass|确认密码'=>'require|confirm:password',
        'nickname|昵称' => 'require|max:25',

        //email验证 是否为@邮箱格式
        'email|邮箱' =>'require|email',

        'code|验证码'=>'require'


    ];

    //登录验证场景
    public function sceneLogin(){

        //不管有多少验证规则 只验证only里面的字段写的规则
        return $this->only(['username','password']);
    }

    //注册场景验证
    public function sceneRegister(){
        return $this->only(['username','password','conpass','nickname','email'])
            ->append(['username'=>'unique:admin','email'=>'unique:admin']);//追加规则,unique唯一的, admin数据表里的unique
    }

    //发送邮箱验证
    public function sceneSendCode(){

        return $this->only(['email']);
    }

    //验证码验证
    public function sceneVerify(){
        return $this->only(['code']);
    }

    //重置密码验证
    public function sceneReset(){
        return $this->only(['password','conpass']);
    }

    public function sceneAdd(){
        return $this->only(['username','password','nickname','email'])
            ->append(['username'=>'unique:admin','email'=>'unique:admin']);
    }
    public function sceneEdit(){
        return $this->only(['username','oldpassword','password','nickname','email'])
            ->append(['email'=>'unique:admin','password' => 'different:oldpassword']);
    }
}