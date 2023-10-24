<?php
namespace app\cms\controller;

use cmf\controller\HomeBaseController;
use app\cms\model\CmsChannelModel;
use app\admin\model\RouteModel;
class ListController extends HomeBaseController
{
    /***
     * 文章列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {	
		 
		$routeModel = new RouteModel();
		$cname               = $this->request->param('cname', 0);
		$cname=str_replace("/",'',$cname);
        $cname .='/';
		
        $id                  = $this->request->param('id', 0, 'intval');

        $keyword = $this->request->param('keyword');
		
		if(empty($id)){
			$routedata = $routeModel->where(['url'=>$cname])->find();
			$arr = explode('=',$routedata['full_url']);
			$id = $arr[1];
		}
		
        $cmsChannelModel = new CmsChannelModel();

        $category = $cmsChannelModel->where('id', $id)->where('status', 1)->find();
        $category_parent = $cmsChannelModel->where('id', $category['parent_id'])->where('status', 1)->find();
	   
		
        $alias      = $routeModel->getUrl('cms/List/index', ['id' => $id]);

        $category['alias'] = $alias;
	   
	   
        $this->assign('category', $category);
        $this->assign('category_parent', $category_parent);
        $this->assign('keyword', $keyword);

        $listTpl = '';
        switch($category['type']){
            case 'channel':
                $listTpl = $category['channeltpl'];
            break;
            case 'list':
                $listTpl = $category['listtpl'];
            break;
            default:
                $listTpl = 'channel';//默认栏目页面
            break;
        }
		

        return $this->fetch('/' . $listTpl);
    }




    /***
     * 标签--列表页面
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */

     public function indextag()
    {  

        $id = $this->request->param('id', 0, 'intval');
       $this->assign('id', $id);
         return $this->fetch('/list_tag');


    }

     /***
     * 所有标签列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */

     public function tag()
    {   
           $cmsChannelModel = new CmsChannelModel();
        $catid=7;
          $category = $cmsChannelModel->where('id',$catid)->where('status', 1)->find();
        $category_parent = $cmsChannelModel->where('id', $category['parent_id'])->where('status', 1)->find();
         $this->assign('category', $category);
        $this->assign('category_parent', $category_parent);

         return $this->fetch('/list_tag_all');


    }
   



}
