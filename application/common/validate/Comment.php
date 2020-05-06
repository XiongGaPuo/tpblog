<?php

namespace app\common\validate;

use think\Validate;

class Comment extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'article_id|栏目' => 'require',
	    'content|内容' => 'require'

    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [];


    public function sceneComment(){
        return $this->only(['article_id','content']);
    }

}
