<?php
namespace app\cms\api;

use app\cms\model\CmsChannelModel;
use think\db\Query;

class ChannelApi
{
    /**
     * 分类列表 用于模板设计
     * @param array $param
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index($param = [])
    {
        $cmsChannelModel = new CmsChannelModel();

        $where = ['delete_time' => 0];

        //返回的数据必须是数据集或数组,item里必须包括id,name,如果想表示层级关系请加上 parent_id
        return $cmsChannelModel->where($where)
            ->where(function (Query $query) use ($param) {
                if (!empty($param['keyword'])) {
                    $query->where('name', 'like', "%{$param['keyword']}%");
                }
            })->select();
    }

    /**
     * 分类列表 用于导航选择
     * @return array
     */
    public function nav()
    {
        $cmsChannelModel = new CmsChannelModel();

        $where = ['delete_time' => 0];

        $categories = $cmsChannelModel->where($where)->select();

        $return = [
            //'name'  => '文章分类',
            'rule'  => [
                'action' => 'cms/List/index',
                'param'  => [
                    'id' => 'id'
                ]
            ],//url规则
            'items' => $categories //每个子项item里必须包括id,name,如果想表示层级关系请加上 parent_id
        ];

        return $return;
    }

}