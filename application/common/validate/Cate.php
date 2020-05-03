<?php


namespace app\common\validate;


use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename|栏目名称' => 'require|unique:cate',
        'sort|排序' =>'require|number'
    ];

    protected $message =[
        'catename.require' => '不能为空',
    ];

    public function sceneAdd(){
        return $this->only(['catename','sort']);
    }

    public function sceneEdit(){
        return $this->only(['catename','sort']);
    }

    public function sceneSort(){
        return $this->only(['sort']);
    }
}