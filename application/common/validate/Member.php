<?php


namespace app\common\validate;


use think\Validate;

class Member extends Validate
{

    protected $rule=[
      'username|用户名' => 'require|unique:member',
      'oldpassword|旧密码'  =>'require|alphaNum',
      'password|密码' => 'require|alphaNum',
      'nickname|昵称' => 'require',
      'email|邮箱' => 'require|email',


    ];

    public function sceneAdd(){
        return $this->only(['username','password','nickname','email']);
    }

    public function sceneEdit(){
        return $this->only(['username','oldpassword','password','nickname','email'])->append([
            'password' => 'different:oldpassword',
        ]);
    }
}