<?php

namespace app\admin\controller;


class Cate extends Base
{
    public function lists(){

        //查询数据库数据

        $cates = model('Cate')->order('sort','asc')->paginate(10);
        //定义一个模板数据变量
        $viewDate= [
            'cates'=>$cates
        ];
        $this->assign($viewDate);
        return view();
    }

    public function add(){
        if(request()->isAjax()){
            $data =[
                'catename' => input('post.catename'),
                'sort' => input('post.sort')

            ];
            $result = model('Cate')->add($data);
            if ($result == 1 ){
                $this->success('添加成功','admin/cate/lists');
            }else{
                $this->error($result);
            }
        }

        return view();
    }

    //排序
    public function sort(){
        $data = [
            'id' => input('post.id'),
            'sort' => input('post.sort')
        ];
        $result = model('Cate')->sort($data);
        if ($result == 1){
            $this->success('排序成功','admin/cate/lists');
        }else{
            $this->error($result);
        }
    }

    public function edit($id=''){
        if(request()->isAjax()){
            $data=[
                'id' => input('post.id'),
                'catename' => input('post.catename'),
                'sort' => input('post.sort'),
            ];
            $result = model('Cate')->edit($data);
            if ($result == 1){
                $this->success('修改成功','admin/cate/lists');
            }else{
                $this->error($result);
            }
        }

        $cateInfo = model('Cate')->find($id);
        $viewDate= [
            'cateInfo'=>$cateInfo
        ];
        $this->assign($viewDate);
        return view();

    }

    //栏目删除
    public function del(){
        $cateInfo = model('Cate')->find(input('post.id'));
        $result = $cateInfo->delete();
        if ($result){
            $this->success('栏目删除成功','admin/cate/lists');
        }else{
            $this->error('删除失败');
        }
    }

}
