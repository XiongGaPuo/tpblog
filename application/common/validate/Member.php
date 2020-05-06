<?php


namespace app\common\validate;


use think\Validate;

class Member extends Validate
{

    protected $rule=[
      'username|用户名' => 'require',
      'nickname|昵称' => 'require',
      'email|邮箱' => 'require|email',
      'oldpassword|旧密码'  =>'require|alphaNum',
      'password|密码' => 'require|alphaNum',
      'conpass|确认密码'=>'require|confirm:password',

      'verify|验证码'=>'require|captcha',
    ];

    public function sceneAdd(){
        return $this->only(['username','password','nickname','email'])->append([
            'username' => 'unique:member'
        ]);
    }


    public function sceneEdit(){
        return $this->only(['username', 'oldpassword', 'password', 'nickname', 'email'])->append([
            'username'=>'unique:member',
            'password' => 'different:oldpassword',
        ]);

    }

    public function sceneRegister(){
        return $this->only(['username','nickname','email','conpass','password','verify'])->append([
            'username' => 'unique:member'
        ]);
    }

    public function sceneLogin(){
        return $this->only(['username','password','verify']);
    }
}