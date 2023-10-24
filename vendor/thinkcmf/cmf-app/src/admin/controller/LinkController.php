<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use app\admin\model\LinkModel;
use app\admin\model\Link_categoryModel;
use think\Db;
use think\db\Query;

class LinkController extends AdminBaseController
{
    protected $targets = ["_blank" => "新标签页打开", "_self" => "本窗口打开"];

    /**
     * 友情链接管理
     * @adminMenu(
     *     'name'   => '友情链接',
     *     'parent' => 'admin/Setting/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 50,
     *     'icon'   => '',
     *     'remark' => '友情链接管理',
     *     'param'  => ''
     * )
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $content = hook_one('admin_link_index_view');
        if (!empty($content)) {
            return $content;
        }
        $linkModel = new LinkModel();
        $data = $this->request->param();
        $links = $linkModel->where(function (Query $query) use ($data) {
            if (!empty($data['keyword'])) {
                $keyword = $data['keyword'];
               $query->where('name|url', 'like', "%$keyword%");
            }
             if (!empty($data['type'])) {
                   $query->where('type', '=', $data['type']);
              }

            })->order("list_order asc,id desc")->paginate(20,false,['query' =>$this->request->param()]);

        // 获取分页显示
        $page = $links->render();

        $category_model = new Link_categoryModel();
        $data = $category_model->order("id desc")->select()->toArray(); 
        $link_arr = array_column($data,'catname','id');
        //print_r($links);die;
        $this->assign('link_arr',$link_arr);
        $this->assign('links', $links);
        $this->assign('page', $page);
        return $this->fetch();
    }

    /**
     * [category_index 友情链接的类别管理首页]
     * @return [type] [description]
     */
    public function category_index(){

        $data_one = $this->request->param();
        $data_two = !empty($data_one)?$data_one['keyword']:'0';
        
        $category_model = new Link_categoryModel();

        if ($data_two == '0') {
            $data = $category_model->order("id desc")->paginate(20,false,['query' =>$this->request->param()]);
        }else{
            $data = $category_model->where("catname",'like',"%$data_two%")->order("id desc")->paginate(20,false,['query' =>$this->request->param()]);
        }
       

        $page = $data->render();
        $this->assign('data', $data);
        $this->assign('page', $page);

        return $this->fetch();

        //print_r(array_column($data,'catname','id'));
    }

    /**
     * [category_add 友情链接的添加转跳]
     * @return [type] [description]
     */
    public function category_add(){

        $this->assign('gargets',$this->targets);
        return $this->fetch();
    }

    /**
     * [category_addpost 友情链接的添加处理]
     * @return [type] [description]
     */
    public function category_addpost(){

        $category_model = new Link_categoryModel();
        $data = $this->request->param();

        $no = $category_model->where($data)->select()->toArray();

        if ($no) {
            $this->success('已经添加过相同类别',url("Link/add"));
        }else{
            $one = $category_model->insert($data);

            if ($one) {
                $this->success('添加成功',url("Link/add"));
            }else{
                $this->success('添加失败',url("Link/category_index"));
            }
        }
   
    }

    /**
     * [category_edit 友情链接的修改转跳页面]
     * @return [type] [description]
     */
    public function category_edit(){

        $data = $this->request->param();
        $category_model = new Link_categoryModel();

        $new_data = $category_model->where($data)->limit(1)->select()->toArray();

        $this->assign('data', $new_data);

        $this->assign('gargets',$this->targets);
        return $this->fetch();
    }

    /**
     * [category_editpost 友情链接的修改提交]
     * @return [type] [description]
     */
    public function category_editpost(){
        $data = $this->request->param();
        $category_model = new Link_categoryModel();
        $yes = $category_model->where('id='.$data['id'])->select()->toArray();

        if ($data['catname'] == $yes[0]['catname']) {
            $this->success('未修改成功,内容与修改前一致',url("Link/category_index"));
        }

        $succ = $category_model->where('id',$data['id'])->update(['catname'=>$data['catname']]);

        if ($succ) {
            $this->success('修改成功',url("Link/category_index"));
        }else{
            $this->success('修改失败',url("Link/category_index"));
        }
    }

    /**
     * [category_del 友情链接的删除处理]
     * @return [type] [description]
     */
    public function category_del(){

        $category_model = new Link_categoryModel();
        $linkModel = new LinkModel();
        $data = $this->request->param();

        $link_data = $linkModel->where('type','=',$data['id'])->select()->toArray();
        //print_r($link_data);die;
        if ($link_data) {
            $del_link = $linkModel->where('type','=',$data['id'])->delete();
            if ($del_link) {
                $rs = $category_model->where($data)->delete();
                if ($rs) {
                    $this->success('删除成功',url("Link/category_index"));
                }else{
                    $this->success('友情链接删除成功,类别删除失败',url("Link/category_index"));
                }
                
            }else{
                $this->success('友情链接删除失败');
            }
        }else{
            $rs = $category_model->where($data)->delete();
            if ($rs) {
                $this->success('友情链接类别删除成功',url("Link/category_index"));
            }else{
                $this->success('友情链接删除成功,类别删除失败',url("Link/category_index"));
            }
        }

        
    }

    /**
     * 添加友情链接
     * @adminMenu(
     *     'name'   => '添加友情链接',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加友情链接',
     *     'param'  => ''
     * )
     */
    public function add()
    {

        $category_model = new Link_categoryModel();
        $data = $category_model->order("id desc")->select()->toArray();
        $link_arr = array_column($data,'catname','id');
        $this->assign('link_arr',$link_arr);

        $this->assign('targets', $this->targets);
        return $this->fetch();
    }

    /**
     * 添加友情链接提交保存
     * @adminMenu(
     *     'name'   => '添加友情链接提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加友情链接提交保存',
     *     'param'  => ''
     * )
     */
    public function addPost()
    {
        $data      = $this->request->param();
        $linkModel = new LinkModel();
        $result    = $this->validate($data, 'Link');
        if ($result !== true) {
            $this->error($result);
        }
        $linkModel->allowField(true)->save($data);

        $this->success("添加成功！", url("Link/index"));
    }

    /**
     * 编辑友情链接
     * @adminMenu(
     *     'name'   => '编辑友情链接',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑友情链接',
     *     'param'  => ''
     * )
     * @return mixed
     * @throws \think\Exception\DbException
     */
    public function edit()
    {
        $id        = $this->request->param('id', 0, 'intval');
        $linkModel = new LinkModel();
        $link      = $linkModel->get($id);

        $category_model = new Link_categoryModel();
        $data = $category_model->order("id desc")->select()->toArray();
        $link_arr = array_column($data,'catname','id');
        $this->assign('link_arr',$link_arr);
        $this->assign('targets', $this->targets);
        $this->assign('link', $link);
        return $this->fetch();
    }

    /**
     * 编辑友情链接提交保存
     * @adminMenu(
     *     'name'   => '编辑友情链接提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑友情链接提交保存',
     *     'param'  => ''
     * )
     */
    public function editPost()
    {
        $data      = $this->request->param();
        $linkModel = new LinkModel();
        $result    = $this->validate($data, 'Link');
        if ($result !== true) {
            $this->error($result);
        }
        $linkModel->allowField(true)->isUpdate(true)->save($data);

        $this->success("保存成功！", url("Link/index"));
    }

    /**
     * 删除友情链接
     * @adminMenu(
     *     'name'   => '删除友情链接',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除友情链接',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        LinkModel::destroy($id);
        $this->success("删除成功！", url("link/index"));
    }

    /**
     * 友情链接排序
     * @adminMenu(
     *     'name'   => '友情链接排序',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '友情链接排序',
     *     'param'  => ''
     * )
     */
    public function listOrder()
    {
        $linkModel = new  LinkModel();
        parent::listOrders($linkModel);
        $this->success("排序更新成功！");
    }

    /**
     * 友情链接显示隐藏
     * @adminMenu(
     *     'name'   => '友情链接显示隐藏',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '友情链接显示隐藏',
     *     'param'  => ''
     * )
     */
    public function toggle()
    {
        $data      = $this->request->param();
        $linkModel = new LinkModel();

        if (isset($data['ids']) && !empty($data["display"])) {
            $ids = $this->request->param('ids/a');
            $linkModel->where('id', 'in', $ids)->update(['status' => 1]);
            $this->success("更新成功！");
        }

        if (isset($data['ids']) && !empty($data["hide"])) {
            $ids = $this->request->param('ids/a');
            $linkModel->where('id', 'in', $ids)->update(['status' => 0]);
            $this->success("更新成功！");
        }


    }

}