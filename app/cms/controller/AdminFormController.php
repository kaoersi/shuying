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

use app\admin\model\RouteModel;
use cmf\controller\AdminBaseController;
use app\cms\model\CmsArchivesModel;
use app\cms\service\PostService;
use app\admin\model\ThemeModel;

class AdminFormController extends AdminBaseController
{

    /**
     * Page模型对象
     */
    protected $model = null;

    public function initialize()//TP5.1写法
    {
        parent::initialize();
        $this->model = new \app\cms\model\CmsFormModel;
    }

    
	//前台留言表单管理
	
    public function index()
    {
		
		$param = $this->request->param();
        $data  = $this->model->adminFormList($param);

        $this->assign('pages', $data);
        $this->assign('page', $data->render());
		
        return $this->fetch();
    }

    /**
     * 添加页面
     * @adminMenu(
     *     'name'   => '添加页面',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加页面',
     *     'param'  => ''
     * )
     */
    public function add()
    {
        $content = hook_one('cms_admin_page_add_view');

        if (!empty($content)) {
            return $content;
        }

        $themeModel     = new ThemeModel();
        $pageThemeFiles = $themeModel->getActionThemeFiles('cms/Page/index');
        $this->assign('page_theme_files', $pageThemeFiles);
        return $this->fetch();
    }

    /**
     * 删除页面
     * @author    iyting@foxmail.com
     * @adminMenu(
     *     'name'   => '删除页面',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除页面',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $data            = $this->request->param();

        $result = $this->model->adminDeletePage($data);
        if ($result) {
            $this->success(lang('DELETE_SUCCESS'));
        } else {
            $this->error(lang('DELETE_FAILED'));
        }

    }

}
