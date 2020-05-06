<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Member extends Model
{
    //软删除
    use SoftDelete;

    //只读字段
    protected $readonly =['username','email'];

    //关联评论 一对多
    public function comments(){
        return $this->hasMany('Comment','member_id','id');
    }

    public function add($data){
        $validate = new \app\common\validate\Member();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result){
            return 1;
        }else{
            return '会员添加失败';
        }
    }

    public function edit($data){
        $validate = new \app\common\validate\Member();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $member = $this->find($data['id']);
        if($member['password']!=$data['oldpassword']){
            return '原密码不正确';
        }
        $result = $member->allowField(true)->save($data);
        if ($result){
            return 1;
        }
        else{
            return '会员修改失败';
        }


    }

    public function register($data){

        $validate = new \app\common\validate\Member();
        if(!$validate->scene('register')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if($result == null){
            return '注册失败';
        }
        return 1;
    }

    public function login($data){

        $validate = new \app\common\validate\Member();
        if(!$validate->scene('login')->check($data)){
            return $validate->getError();
        }

        unset($data['verify']);
        $result=$this->where($data)->find();
        if ($result){
            $sessionData=[
                'id' => $result['id'],
                'nickname' => $result['nickname'],
            ];
            session('index',$sessionData);
            return 1;
        }else{
            return '账号密码错误';

        }

    }


}
