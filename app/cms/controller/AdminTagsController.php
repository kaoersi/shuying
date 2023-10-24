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

use app\cms\model\CmsTagsModel;
use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;
/**
 * Class AdminTagsController 标签管理控制器
 * @package app\cms\controller
 */
class AdminTagsController extends AdminBaseController
{
    /**
     * 标签管理
     * @adminMenu(
     *     'name'   => '标签管理',
     *     'parent' => 'cms/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '文章标签',
     *     'param'  => ''
     * )
     */
    public function index()
    {
        $t     = $this->request->param("t");

        if(empty($t)){
            $t='1';
        }

        $content = hook_one('cms_admin_tags_index_view');

        if (!empty($content)) {
            return $content;
        }

        $cmsTagModel = new CmsTagsModel();

        

   $data = $this->request->param();

     //分页条数
       if(isset($data['row']) &&  ($data['row']== 'diy_row')){
            
            $row = !empty($data['diy_row']) ? intval($data['diy_row']) : 10;
            
        }elseif(!empty($data['row'])){
            
            $row = intval($data['row']);
            
        }else{
            
            $row = 10;
            
        }
       
         if(!isset($data['px'])){$data['px']=0;}
   switch ($data['px']) {
       case '1':
           $pxstr='id DESC';
           break;
      case '2':
           $pxstr='id ASC';
           break;
      case '3':
           $pxstr='nums DESC';
           break;
      case '4':
           $pxstr='nums ASC';
           break;
       
       default:
            $pxstr='id ASC';
           break;
   }
   $tags = Db::name('CmsTags')
            ->where(function (Query $query) use ($data) {

                 if (!empty($data['t'])) {
                       $query->where('type', '=', $data['t']);
                  }
               

                if (!empty($data['keyword'])) {
                    $keyword = $data['keyword'];
                    $query->where('name|keywords', 'like', "%$keyword%");
                }
                

            })
            ->order($pxstr)
            ->paginate($row,false,['query' =>$this->request->param()]);

        // 获取分页显示
        $page = $tags->render();

        $this->assign("tags", $tags);
         $this->assign("t", $t);
        $this->assign('page',$page);
        return $this->fetch();
    }

     /**
     * 修改标签
     */
      public function edit()
    {
         $CmsTagsModel = new CmsTagsModel();
          $id = $this->request->param("id");
         $result=$CmsTagsModel->where(array('id'=>$id))->find();
         $this->assign('result', $result);
        return $this->fetch();
    }

        /**
     * 修改标签
     */
    public function editPost()
    {
   
        $arrData = $this->request->param();
        $CmsTagsModel = new CmsTagsModel();
        $CmsTagsModel->update($arrData['post']);
        //校准数量

        $name=$arrData['post']['name'];
         $type=$arrData['post']['type'];
         switch ($type) {
             case '2'://问答部分
             $CmsAsksModel = new \app\cms\model\CmsAsksModel;
              $ids_arr=$CmsAsksModel->where('keywords', 'like', "%$name%")->column('id');
                 break;
            case '3'://留学资讯部分
              $CmsLxzkModel = new \app\cms\model\CmsLxzkModel;
              $ids_arr=$CmsLxzkModel->where('keywords', 'like', "%$name%")->column('id');
                 break;
             
             default://文章部分
             $ids_arr = Db::name('CmsArchives')->where('keywords', 'like', "%$name%")->column('id');
           break;
         }
         $ids['nums']=count($ids_arr);
         $ids['archives']=implode(',',$ids_arr);
         $ids['id']=$arrData['post']['id'];
        $CmsTagsModel->update($ids);  

        $this->success(lang("SAVE_SUCCESS"));

    }

    /**
     * 删除文章标签
     * @adminMenu(
     *     'name'   => '删除文章标签',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除文章标签',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $intId = $this->request->param("id", 0, 'intval');
        if (empty($intId)) {
            $this->error(lang("NO_ID"));
        }
        $cmsTagsModel = new CmsTagsModel();
        //删除
        $cmsTagsModel->where('id' , $intId)->delete();
        $this->success(lang("DELETE_SUCCESS"));
    }




    /**
     * 批量修正数量
     * )
     */
    public function batch_edit()
    {
         $type = $this->request->param("id", 0, 'intval');
           $idsarrpost = $this->request->param('ids/a');
         $cmsTagsModel = new CmsTagsModel();
         if (!in_array($type,array('1','2','3'))){
            $this->error("非法参数");
            exit();
         }
 $list=$cmsTagsModel->where('type',$type)->where('id', 'in', $idsarrpost)->select();
 foreach ($list as $k => $v) {
      $name=$v['name'];

         switch ($type) {
             case '2'://问答部分
             $CmsAsksModel = new \app\cms\model\CmsAsksModel;
              $ids_arr=$CmsAsksModel->where('keywords', 'eq', "$name")->column('id');
                 break;
            case '3'://留学资讯部分
              $CmsLxzkModel = new \app\cms\model\CmsLxzkModel;
              $ids_arr=$CmsLxzkModel->where('keywords', 'eq', "$name")->column('id');
                 break;
             
             default://文章部分
             $ids_arr = Db::name('CmsArchives')->where('keywords', 'eq', "$name")->column('id');
           break;
         }
         $ids['nums']=count($ids_arr);
         $ids['archives']=implode(',',$ids_arr);
         $ids['id']=$v['id'];
        Db::name('CmsTags')->update($ids);


 }

            $this->success("操作成功！");
    }








    /**
     * 添加文章标签
     * @adminMenu(
     *     'name'   => '添加文章标签',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加文章标签',
     *     'param'  => ''
     * )
     */
    public function add()
    {
        $cmsTagsModel = new CmsTagsModel();
        return $this->fetch();
    }

    /**
     * 添加文章标签提交
     * @adminMenu(
     *     'name'   => '添加文章标签提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加文章标签提交',
     *     'param'  => ''
     * )
     */
    public function addPost()
    {

        $arrData = $this->request->param();

        $cmsTagsModel = new CmsTagsModel();
      $find=$cmsTagsModel->where(array('name'=>$arrData['post']['name'],'type'=>$arrData['post']['type']))->find();
      if(!empty($find)){
         $this->error("抱歉，该类别下已存在相同的标签记录，id为".$find['id']);
      }
      $cmsTagsModel->insertGetId($arrData['post']);
 

        $this->success(lang("SAVE_SUCCESS"));

    }

    /**
     * 动态获取下拉的标签列表select2
     */

    public function postlistjson(){
          $name = $this->request->param('search');
           $type = $this->request->param('type');
            $lists = Db::name('CmsTags')->where('name', 'like', "%$name%")->where('type', 'eq', "$type")->field('id,name,nums')->order('nums desc')->limit(12)->select()->toArray();
$listsnew=array();
if(!empty($lists)){
    foreach ($lists as $k => $v) {
       $listsnew[$k]['text']=$v['name'];
       $listsnew[$k]['id']=$v['id'];
    }




 $arr=json_encode(array('list'=>$listsnew,'status'=>'1'));
}else{
 $arr=json_encode(array('list'=>'','status'=>'0'));
}
echo $arr;
exit();

 


    }

   






















}
