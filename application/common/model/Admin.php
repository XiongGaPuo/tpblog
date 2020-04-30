<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    //软删除
    use SoftDelete;

    //只读字段
    protected $readonly = ['email'];

    public function login($data){

        $validate = new \app\common\validate\Admin();
        //判断:没有验证成功 场景 是 reigister 校验对比 用的是 $data数据
        if(!$validate->scene('login')->check($data)){
            return $validate->getError();
        }

        //在数据库admin表单中查询有无对应的账号密码
        $result=$this->where($data)->find();
        if ($result){
            //判断用户是否可用
            if($result['status'] != 1){
                return '此账户被禁用!';
            }
            //将数据粗唇到sesiion里面
            $sessionData=[
                'id' => $result['id'],
                'nickname' => $result['nickname'],
                'is_super' => $result['is_super']
            ];
            session('admin',$sessionData);
            //1表示有这个用户,也就是用户名和密码正确了
            return 1;
        }else{
            return '用户名或者密码错误!';
        }
    }

    //注册账户
    public function register($data){
        $validate = new \app\common\validate\Admin();
        //判断:没有验证成功 场景 是 reigister 校验对比 用的是 $data数据
        if(!$validate->scene('register')->check($data)){
            return $validate->getError();
        }
        // allowField 插入数据库中有点字段,没有则不插入 conpass则不会被插入
        $result = $this->allowField(true)->save($data);

        if ($result){
            return 1;
        }else{
            return '注册失败';
        }
    }

}
