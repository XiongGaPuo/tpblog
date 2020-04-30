<?php


namespace app\common\validate;


use think\Validate;

class Admin extends Validate
//继承thinkphp验证器
{
    //验证规则,这里只验证内容是否为空
    protected $rule = [
        'username|管理员账户' => 'require',
        'password|密码' => 'require',

        //confirm验证 , 验证这条数据的值是否和confirm:输入的某条数据一致
        'conpass|确认密码'=>'require|confirm:password',
        'nickname|昵称' => 'require',

        //email验证 是否为@邮箱格式
        'email|邮箱' =>'require|email'
    ];

    //登录验证场景
    public function sceneLogin(){

        //不管有多少验证规则 只验证only里面的字段写的规则
        return $this->only(['username','password']);
    }

    //注册场景验证
    public function sceneRegister(){
        return $this->only(['username','password','conpass','nickname','email']);
    }
}