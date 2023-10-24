<?php
namespace app\cms\model;

use app\admin\model\RouteModel;
use think\Model;
use think\Db;
use think\db\Query;

/**
 * @property mixed id
 */
class CmsFeedbackModel extends Model
{
    // 表名
    protected $name = 'cms_feedback';

    protected $type = [
        'more' => 'array',
    ];

    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    // 追加属性
    protected $append = [
        //'status_text',
        //'url'
    ];

    protected static function init()
    {
        /**
         * 新增后操作
         */
        self::afterInsert(function ($row) {

        });

        /**
         * 修改后操作
         */
        self::afterUpdate(function ($row) {

        });

        /**
         * 删除后操作
         */
        self::afterDelete(function ($row) {

        });
    }


    /**
     * content 自动转化
     * @param $value
     * @return string
     */
    public function getContentAttr($value)
    {
        return cmf_replace_content_file_url(htmlspecialchars_decode($value));
    }

    /**
     * content 自动转化
     * @param $value
     * @return string
     */
    public function setContentAttr($value)
    {
        return htmlspecialchars(cmf_replace_content_file_url(htmlspecialchars_decode($value), true));
    }

    /**
     * publishedtime 自动完成
     * @param $value
     * @return false|int
     */
    public function setPublishedTimeAttr($value)
    {
        return strtotime($value);
    }


    /**
     * 文章查询
     * @param      $filter
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function adminFeedbackList($filter)
    {

        $articles    = $this->alias('a')
            ->where('create_time', '>=', 0)

            ->order('create_time', 'DESC')
            ->paginate(10);
        return $articles;

    }



    /**
     * @param $data
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function adminDeletePage($data)
    {
        if (isset($data['id'])) {
            $this->destroy($data['id']);
            return true;
        } elseif (isset($data['ids'])) {
            $res = $this->destroy($data['ids']);
            return true;
        } else {
            return false;
        }
    }

}
