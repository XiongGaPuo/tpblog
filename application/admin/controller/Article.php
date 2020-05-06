<?php

namespace app\admin\controller;

class Article extends Base
{
    //文章列表

    public function lists(){

        $articles = model('Article')->with('cate')->order(['is_top'=> 'asc','create_time'=>'desc'])->paginate(5);
        $viewData =[
            'articles' => $articles
        ];
        $this->assign($viewData);

        return view();
    }

    public function add(){
        if(request()->isAjax()){

            $data=[
                'title' => input('post.title'),
                'tags' => input('post.tags'),
                'is_top' => input('post.is_top',0) ,
                'cate_id' => input('post.cate_id'),
                'desc' => input('post.desc'),
                'content' => input('post.content'),
                'admin_id' => session('admin.id'),
            ];
            $result = model('Article')->add($data);
            if ($result == 1){
                $this->success('文章添加成功'
                    ,'admin/article/lists');
            }else{
                $this->error($result);
            }


        }
        $cates = model('Cate')->order('sort','asc')->select();
        $viewDate = [
            'cates' => $cates
        ];
        $this->assign($viewDate);
        return view();
    }

    public function top(){
        $data = [
            'id' => input('post.id'),
            'is_top' => input('post.is_top') ? 0:1
            //直接在这里进行修改,如果是1推荐的话就将值改成0不推荐,如果是0不推荐的话,贼改为1推荐

        ];
        $result = model('Article')->top($data);
        if ($result == 1 ){
            $this->success('操作成功','admin/article/lists');
        }else{
            $this->error($result);
        }
    }

    public function edit($id=''){


        if(request()->isAjax()){
            $data=[
                'id' => input('post.id'),
                'title' => input('post.title'),
                'tags' => input('post.tags'),
                'is_top' => input('post.is_top',0) ,
                'cate_id' => input('post.cate_id'),
                'desc' => input('post.desc'),
                'content' => input('post.content')
            ];
            $result = model('Article')->edit($data);

            if ($result == 1){
                $this->success('文章编辑成功','admin/article/lists');
            }else{
                $this->error($result);
            }
        }

       $articleInfo = model('Article')->find($id);
       $cates = model('Cate')->order('sort','asc')->select();
        $viewDate =[
            'articleInfo' => $articleInfo,
            'cates' => $cates
        ];
        $this->assign($viewDate);
        return view();
    }

    public function del(){


        $articleInfo =  model('Article')->with('comments')->find(input('post.id'));
        $result=$articleInfo -> together('comments') -> delete();
        if ($result){
            $this->success('删除成功','admin/article/lists');
        }else{
            $this->error('删除失败');
        }
    }
}
