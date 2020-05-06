<?php

namespace app\common\validate;

use think\Validate;

class System extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'webname|网站标题' => 'require',
	    'copyright|版权信息' => 'require'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [];

    public function sceneSet(){
        return $this->only(['webname','copyright']);
    }
}
