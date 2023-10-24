<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | LeoXie <380019813@qq.com>
// +----------------------------------------------------------------------
namespace app\cms\controller;

use cmf\controller\HomeBaseController;
use app\cms\model\CmsChannelModel;
use app\admin\model\RouteModel;
use think\Db;
use think\db\Query;


class SearchController extends HomeBaseController
{
 

   /**
     * 搜索
     * @return mixed
     */
    public function index()
    {
       
        $keyword = $this->request->param('keyword');
        if(!isset($keyword)){
           $keyword = $this->request->param('keywordb');
        }
        if (empty($keyword)) {
            $this -> error("关键词不能为空！请重新输入！");
        }
        $lists= Db::name('CmsArchives')->where(function($query)use($keyword){
                $query->where('status','=','1');
                $query->where('delete_time','=',0);
                if (!empty($keyword)) {
                    $query->where('title|description', 'like', "%$keyword%");
                }})->order('list_order asc,id desc')->paginate(10,false,['query' =>$this->request->param()]);
        // 获取分页显示
        $page = $lists->render();

        $this->assign('lists', $lists);
        $this->assign('page', $page);
        $this->assign('keyword', $keyword);
        $searcharr=$lists->toArray();
        return $this->fetch('/list_search');
        /*if($searcharr['total'] > 0){
        

       }else{
         return $this->fetch('/search_empty');

       }*/

    }

}
