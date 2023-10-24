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

use app\cms\model\CmsAsksModel;
use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;

/**
 * Class AdminTagsController 问答管理控制器
 * @package app\cms\controller
 */
class AdminAsksController extends AdminBaseController
{
    /**
     * 问答列表
     */
    public function index()
    {

   $data = $this->request->param();

        $asks = Db::name('CmsAsks')
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
                       $query->where('country', '=', $data['country']);
                  }

            })
            ->order("create_time DESC")
            ->paginate(10,false,['query' =>$this->request->param()]);

        // 获取分页显示
        $page = $asks->render();

        $this->assign('asks', $asks);
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
        $cmsAsksModel = new CmsAsksModel();
      $avatar_arr=array('1'=>'课程顾问-Lea','2'=>'课程顾问-Eva','3'=>'课程顾问-Frank','4'=>'课程顾问-Lydia','5'=>'课程顾问-Alan','6'=>'课程顾问-小管家','7'=>'课程顾问-Lucky','8'=>'课程顾问-Emily','9'=>'课程顾问-Tina','10'=>'课程顾问-Rex','11'=>'课程顾问-Silvia','12'=>'课程顾问老师-Dora','13'=>'课程顾问老师-Sky','14'=>'课程顾问老师-Chris');
      
      
      
        $avaid=$arrData['post']['answer_avatar'];
        $arrData['post']['answer_user']=$avatar_arr[$avaid];
        $arrData['post']['create_time']=strtotime($arrData['post']['create_time']);
         $arrData['post']['answer_time']=strtotime($arrData['post']['answer_time']);
         $arrData['post']['answer_time2']=strtotime($arrData['post']['answer_time2']);
          $arrData['post']['answer_time3']=strtotime($arrData['post']['answer_time3']);
    //修改
          

           //关键词处理部分S
            $post_keywords  = $arrData['post_new'];
            $post_keywords_str=implode(",",$post_keywords['keywords']);
            if(!empty($post_keywords_str)){
                 $keyword_arr=Db::name('CmsTags')->where('id','in',$post_keywords_str)->select()->column('name');
                 $arrData['post']['keywords']=implode(",",$keyword_arr);
            }else{
                $keyword_arr='';
                $arrData['post']['keywords']=='';
            }
            //E

             $id=$cmsAsksModel->insertGetId($arrData['post']);

        $cmsAsksModel->addTags($keyword_arr, $id);


        $this->success(lang("SAVE_SUCCESS"));

    }
 /**
     * 修改问答
     */
      public function edit()
    {
         $cmsAsksModel = new CmsAsksModel();
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
          $avatar_arr=array('1'=>'课程顾问-Lea','2'=>'课程顾问-Eva','3'=>'课程顾问-Frank','4'=>'课程顾问-Lydia','5'=>'课程顾问-Alan','6'=>'课程顾问-小管家','7'=>'课程顾问-Lucky','8'=>'课程顾问-Emily','9'=>'课程顾问-Tina','10'=>'课程顾问-Rex','11'=>'课程顾问-Silvia','12'=>'课程顾问老师-Dora','13'=>'课程顾问老师-Sky','14'=>'课程顾问老师-Chris');
        $avaid=$arrData['post']['answer_avatar'];
        $arrData['post']['answer_user']=$avatar_arr[$avaid];
       $arrData['post']['create_time']=strtotime($arrData['post']['create_time']);
         $arrData['post']['answer_time']=strtotime($arrData['post']['answer_time']);
         $arrData['post']['answer_time2']=strtotime($arrData['post']['answer_time2']);
          $arrData['post']['answer_time3']=strtotime($arrData['post']['answer_time3']);
        $cmsAsksModel = new CmsAsksModel();
      //关键词处理部分S
            $post_keywords  = $arrData['post_new'];
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
            //E

        $cmsAsksModel->update($arrData['post']);


        $cmsAsksModel->addTags($keyword_arr, $arrData['post']['id']);

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
        $cmsAsksModel = new CmsAsksModel();
        $cmsAsksModel->where('id' , $intId)->delete();
        $this->success(lang("DELETE_SUCCESS"));
    }

    /**
     * 批量导入问答
     */
    public function batch()
    {
   $cmsAskModel = new CmsAsksModel();
     $filename=$this->request->param("filename");
if ($filename) {

            //批量导入


                $filename = 'upload/'.$filename;//获取文件

                $exts =cmf_get_file_extension($filename);//获取后缀名

               $get_data=$cmsAskModel->do_execl_import($filename,'xlsx','3');
        //格式化
                foreach($get_data as $key => $val){

                    //过滤存在数据
                    $data['title']= trim($val['A']);
                    $data['description']= trim($val['B']);
                    $data['content']= trim($val['C']);//官方估价
                    $data['create_time']= time();
                    $res = Db::name('cms_asks')->insert($data);

                }

       

            $this->success ( "导入成功！" );

    

        } 


        return $this->fetch();
    }











}
