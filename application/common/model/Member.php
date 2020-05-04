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
}
