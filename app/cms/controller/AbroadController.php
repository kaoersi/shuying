<?php
namespace app\cms\controller;

use cmf\controller\HomeBaseController;
use app\cms\model\CmsChannelModel;
use app\cms\service\PostService;
use app\cms\model\CmsLxzkModel;
use think\Db;

class AbroadController extends HomeBaseController
{
    /**
     * 文章详情
     * @return mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {

        $cmsArchivesModel = new CmsLxzkModel();
		$cmsChannelModel = new CmsChannelModel();


        $articleId  = $this->request->param('id', 0, 'intval');
        $article=  Db::name('CmsLxzk')->where(array('id'=>$articleId))->find();

        if (empty($article)) {
            abort(404, '文章不存在!');
        }

		
		$category = $cmsChannelModel->where('id', '6')->where('status', 1)->find();
		
		$category_parent = $cmsChannelModel->where('id', $category['parent_id'])->where('status', 1)->find();
		$this->assign('category_parent', $category_parent);
        $this->assign('category', $category);
	
        $tplName = 'show_case';



        Db::name('cms_lxzk')->where('id', $articleId)->setInc('hits');


        $this->assign('article', $article);

        //$tplName = empty($article['more']['template']) ? $tplName : $article['more']['template'];



        return $this->fetch("/".$tplName);
    }

//案例列表
     public function listnew()
    {

        $cmsArchivesModel = new CmsLxzkModel();
        $cmsChannelModel = new CmsChannelModel();
          $typeid  = $this->request->param('id', 0, 'intval');

       

        
        $category = $cmsChannelModel->where('id', '6')->where('status', 1)->find();
        
        $category_parent = $cmsChannelModel->where('id', $category['parent_id'])->where('status', 1)->find();
        $this->assign('category_parent', $category_parent);
        $this->assign('category', $category);
         $this->assign('typeid', $typeid);
    
        $tplName = 'list_mxalk_case';

        return $this->fetch("/".$tplName);
    }

}
