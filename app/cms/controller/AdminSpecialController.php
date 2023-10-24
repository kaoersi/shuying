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

use app\cms\model\CmsSpecialModel;
use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;


/**
 * Class AdminTagsController 专题管理
 * @package app\cms\controller
 */
class AdminSpecialController extends AdminBaseController
{
    /**
     * 专题列表
     */
    public function index()
    {
       
        $data = $this->request->param();

        $majorlist = Db::name('CmsSpecial')
            ->where(function (Query $query) use ($data) {
                 $startTime = empty($data['start_time']) ? 0 : strtotime($data['start_time']);
                    $endTime   = empty($data['end_time']) ? 0 : strtotime($data['end_time']);

                    if (!empty($startTime)) {
                        $query->where('create_time', '>=', $startTime);
                    }
                    if (!empty($endTime)) {
                        $query->where('create_time', '<=', $endTime);
                    }



                if (!empty($data['keyword'])) {
                    $keyword = $data['keyword'];
                    $query->where('title|seotitle|seokeyword', 'like', "%$keyword%");
                }


            })
            ->order("create_time DESC")
            ->paginate(10,false,['query' =>$this->request->param()]);

        // 获取分页显示
        $page = $majorlist->render();

        $this->assign('asks', $majorlist);
        $this->assign('page', $page);

        $this->assign("start_time", isset($data['start_time']) ? $data['start_time'] : '');
        $this->assign('end_time', isset($data['end_time']) ? $data['end_time'] : '');
        $this->assign('keyword', isset($data['keyword']) ? $data['keyword'] : '');
       

        return $this->fetch();
    }

 
    /**
     * 添加问答
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 添加问答提交
     */
    public function addPost()
    {

        $arrData = $this->request->param();
        $CmsSpecialModel = new CmsSpecialModel();
        $arrData['post']['create_time']=strtotime($arrData['post']['create_time']);
        $CmsSpecialModel->data($arrData['post'])->save();
        $this->success(lang("SAVE_SUCCESS"));

    }
 /**
     * 修改问答
     */
      public function edit()
    {
         $CmsSpecialModel = new CmsSpecialModel();
          $id = $this->request->param("id");
         $result=$CmsSpecialModel->where(array('id'=>$id))->find();
         $this->assign('result', $result);
        return $this->fetch();
    }

    /**
     * 更新问答
     */
    public function editPost()
    {
   
        $arrData = $this->request->param();
        $arrData['post']['create_time']=strtotime($arrData['post']['create_time']);
        $CmsSpecialModel = new CmsSpecialModel();
        $CmsSpecialModel->update($arrData['post']);
        $this->success(lang("SAVE_SUCCESS"));

    }

    /**
     * 删除问答
     */
    public function delete()
    {
        $intId = $this->request->param("id", 0, 'intval');
        if (empty($intId)) {
            $this->error(lang("NO_ID"));
        }
        $CmsSpecialModel = new CmsSpecialModel();
        $CmsSpecialModel->where('id' , $intId)->delete();
        $this->success(lang("DELETE_SUCCESS"));
    }



}
