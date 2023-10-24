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

use app\cms\model\CmsLxzkModel;
use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;

/**
 * Class AdminTagsController 留学智库资讯控制器
 * @package app\cms\controller
 */
class AdminLxzkController extends AdminBaseController
{
    /**
     * 留学资讯列表
     */
    public function index()
    {
       

  $data = $this->request->param();
       $type_id = $this->request->param('type_id', 0, 'intval');
          $start_time = $this->request->param('start_time');
          $end_time = $this->request->param('end_time');
           $keyword = $this->request->param('keyword');

        if(!empty($type_id)){
             $this->assign('type_id', $type_id);
         }else{
             $this->assign('type_id','0');
         }

        $lxzx = Db::name('CmsLxzk')
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
                    switch ($data['category']) {
                        case '1':
                              $query->where('title', 'like', "%$keyword%");
                            break;
                         case '2':
                              $query->where('keywords', 'like', "%$keyword%");
                            break;
                        default:
                             $query->where('title|keywords', 'like', "%$keyword%");
                            break;
                    }
                }
                 if (!empty($data['country'])) {
                       $query->where('type_id', '=', $data['country']);
                  }

            })
            ->order("create_time DESC")
            ->paginate(10,false,['query' =>$this->request->param()]);

        // 获取分页显示
        $page = $lxzx->render();

        $this->assign('asks', $lxzx);
        $this->assign('page', $page);

        $this->assign('start_time', $start_time);
        $this->assign('end_time', $end_time);
        $this->assign('keyword', $keyword);
     
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
        $cmsAsksModel = new CmsLxzkModel();
        $arrData['post']['create_time']=strtotime($arrData['post']['create_time']);
           //关键词处理部分S
            $post_keywords  = $arrData['post_new'];
            if(!empty($post_keywords)){
                $post_keywords_str=implode(",",$post_keywords['keywords']);
            if(!empty($post_keywords_str)){
                 $keyword_arr=Db::name('CmsTags')->where('id','in',$post_keywords_str)->select()->column('name');
                 $arrData['post']['keywords']=implode(",",$keyword_arr);
            }else{
                $keyword_arr='';
                $arrData['post']['keywords']=='';
            }


            }
            
            //E

          //修改
           $id=$cmsAsksModel->insertGetId($arrData['post']);
      
        //$cmsAsksModel->addTags($keyword_arr, $id);

        $this->success(lang("SAVE_SUCCESS"));

    }
 /**
     * 修改问答
     */
      public function edit()
    {
         $cmsAsksModel = new CmsLxzkModel();
          $id = $this->request->param("id");
         $result=$cmsAsksModel->where(array('id'=>$id))->find();

                //关键词处理部分S
         $option_str='';
        if(!empty($result['keywords'])){
            $arr_key=explode(",",$result['keywords']);
            foreach ($arr_key as $k => $v) {
                 $row=Db::name('CmsTags')->where('name','eq',$v)->find();
                 $key_ids[]=$row;
                 $option_str .=' <option value="'.$row['id'].'">'.$row['name'].'</option>';
            }
             $keyword_idstr=implode(",",array_column($key_ids, 'id'));

        }else{
             $keyword_idstr='';
             $option_str='';
        }
    
         $this->assign('option_str', $option_str);
          $this->assign('keyword_idstr', $keyword_idstr);
         //E 


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
        $cmsAsksModel = new CmsLxzkModel();

         //关键词处理部分S
            $post_keywords  = $arrData['post_new'];
              if(!empty($post_keywords)){
                 $post_keywords_str=implode(",",$post_keywords['keywords']);
            if(!empty($post_keywords_str)){
                 $keyword_arr=Db::name('CmsTags')->where('id','in',$post_keywords_str)->select()->column('name');
                 $keywords=implode(",",$keyword_arr);
                 $arrData['post']['keywords']=$keywords;
            }else{
                $keyword_arr='';
                $keywords='';
                  $arrData['post']['keywords']='';
            }

            }
           
            //E


        $cmsAsksModel->update($arrData['post']);

        //$cmsAsksModel->addTags($keyword_arr, $arrData['post']['id']);



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
        $cmsAsksModel = new CmsLxzkModel();
        $cmsAsksModel->where('id' , $intId)->delete();


       // $cmsAsksModel->addTags('',$intId);


        $this->success(lang("DELETE_SUCCESS"));
    }

  
}
