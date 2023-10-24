<?php
namespace app\cms\controller;

use app\admin\model\RouteModel;
use cmf\controller\AdminBaseController;
use app\cms\model\CmsArchivesModel;
use app\cms\service\PostService;
use app\admin\model\ThemeModel;

class AdminFeedbackController extends AdminBaseController
{

    /**
     * Page模型对象
     */
    protected $model = null;

    public function initialize()//TP5.1写法
    {
        parent::initialize();
        $this->model = new \app\cms\model\CmsFeedbackModel;
    }

    
	//前台反馈表单管理
	
    public function index()
    {
		
		$param = $this->request->param();
        $data  = $this->model->adminFeedbackList($param);

        $this->assign('pages', $data);
        $this->assign('page', $data->render());
		
        return $this->fetch();
    }

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
