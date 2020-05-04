<?php

namespace app\admin\controller;

use think\Controller;

class Admin extends Base
{
    //

    public function lists(){


        $admins = model('Admin')->order(['id'=>'asc'])->paginate(5);
        $viewData =[
            'admins' => $admins
        ];
        $this->assign($viewData);
        return view();
    }

    public function add(){
        if(request()->isAjax()){
            $data=[
                'username' => input('post.username'),
                'password' => input('post.password'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email'),
                'status' => input('post.status','0'),
                'is_super' => input('post.is_super','0'),
            ];
            $result = model('Admin') -> add($data);
            if ($result == 1){
                $this->success('添加成功','admin/admin/lists');
            } else{
                $this->error($result);
            }
        }
        return view();
    }


    public function edit($id=''){

        if(request()->isAjax()){
            $data=[
                'id' => input('post.id'),
                'username' => input('post.username'),
                'password' => input('post.password'),
                'oldpassword' => input('post.oldpassword'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email'),
                'status' => input('post.status','0'),
                'is_super' => input('post.is_super','0')
            ];
            $result = model('Admin') -> edit($data);
            if ($result == 1){
                $this->success('编辑成功','admin/admin/lists');
            } else{
                $this->error($result);
            }
        }
        $adminInfo = model('Admin')->find($id);
        $viewData =[
            'adminInfo'=> $adminInfo,
        ];
        $this->assign($viewData);
        return view();

    }

    public function status(){
    $data = [
        'id' => input('post.id'),
        'status' => input('post.status') ? 0:1
        //直接在这里进行修改,如果是1推荐的话就将值改成0不推荐,如果是0不推荐的话,贼改为1推荐

    ];
    $result = model('Admin')->status($data);
    if ($result == 1 ){
        $this->success('操作成功','admin/admin/lists');
    }else{
        $this->error($result);
    }
    }

    public function super(){
        $data = [
            'id' => input('post.id'),
            'is_super' => input('post.is_super') ? 0:1
            //直接在这里进行修改,如果是1推荐的话就将值改成0不推荐,如果是0不推荐的话,贼改为1推荐

        ];
        $result = model('Admin')->super($data);
        if ($result == 1 ){
            $this->success('操作成功','admin/admin/lists');
        }else{
            $this->error($result);
        }
    }


    public function del(){
        $memberInfo = model('Admin')->find(input('post.id'));
        $result = $memberInfo -> delete();
        if($result){
            $this->success('删除成功','admin/admin/lists');
        }else{
            $this->error('删除失败');
        }
    }
}
