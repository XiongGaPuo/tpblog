<?php

namespace app\index\controller;



class Article extends Base
{
    //文章详情页
    public function info(){

        $articleInfo = model('Article')->with('admin,comments,comments.member')->find(input('id'));
        $articleInfo->setInc('click');
        $viewData = [
            'articleInfo' => $articleInfo
        ];

        $this->assign($viewData);
        return view();
    }

    public function comment(){


        $data=[
            'article_id' => input('post.article_id'),
            'content' => input('post.content'),
            'member_id' => input('post.member_id'),


        ];
        $result = model('Comment')->comment($data);
        if ($result == 1){
            $this->success('评论成功!');
        }else{
            $this->error($result);
        }
    }
}
