<?php

namespace app\admin\controller;;

class Member extends Base
{
    public function lists(){

        $members = model('Member')->order(['create_time'=>'desc'])->paginate(5);
        $viewData =[

            'members' => $members
        ];
        $this->assign($viewData);
        return view();
    }

    public function add(){
        if(request()->isAjax()){
            $data =[

                'username' => input('post.username'),
                'password' => input('post.password'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email')
            ];
            $result = model('Member')->add($data);
            if ($result == 1){
                $this->success('添加成功','admin/member/lists');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    public function edit($id=''){
        if(request()->isAjax()){
            $data =[
                'id' => input('post.id'),
                'username' => input('post.username'),
                'password' => input('post.password'),
                'oldpassword' => input('post.oldpassword'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email')
            ];
            $result = model('Member')->edit($data);
            if($result ==1 ){
                $this->success('编辑成功','admin/member/lists');
            }else{
                $this->error($result);
            }
        }


        $memberInfo = model('Member')->find($id);
        $viewData =[
            'memberInfo'=> $memberInfo,
        ];
        $this->assign($viewData);
        return view();
    }

    public function del(){

        $memberInfo = model('Member')->with('comments')->find(input('post.id'));
        $result = $memberInfo -> together('comments') -> delete();
        if($result){
            $this->success('删除成功','admin/member/lists');
        }else{
            $this->error('删除失败');
        }
    }
}
