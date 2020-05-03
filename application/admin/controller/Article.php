<?php

namespace app\admin\controller;

class Article extends Base
{
    //文章列表

    public function lists(){

        $articles = model('Article')->order(['is_top'=> 'asc','create_time'=>'desc'])->paginate(2);
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
                'content' => input('post.content')
            ];
            $result = model('Article')->add($data);
            if ($result == 1){
                $this->success('文章添加成功'
                    ,'admin/article/lists');
            }else{
                $this->error($result);
            }


        }
        $cates = model('Cate')->select();
        $viewDate = [
            'cates' => $cates
        ];
        $this->assign($viewDate);
        return view();
    }
}
