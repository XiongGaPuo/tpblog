<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class System extends Model
{
    //软伤处
    use SoftDelete;

    //更新网站信息
    public function set($data){
        $validate = new \app\common\validate\System();
        if (!$validate->scene('set')->check($data)){
            return $validate->getError();
        }
        $webInfo = $this->find($data['id']);
        $result = $webInfo->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '设置失败';
        }

    }
}
