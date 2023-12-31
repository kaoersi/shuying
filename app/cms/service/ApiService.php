<?php
namespace app\cms\service;

use app\cms\model\CmsArchivesModel;
use app\cms\model\CmsChannelModel;
use app\cms\model\CmsPageModel;
use app\cms\model\CmsModelxModel;
use app\admin\model\SlideModel;
use think\Db;
use think\db\Query;

class ApiService
{

    /**
     * 功能:查询文章列表,支持分页;<br>
     * 注:此方法查询时关联两个表portal_category_post(category_post),portal_post(post);在指定排序(order),指定查询条件(where)最好指定一下表别名
     * @param array $param 查询参数<pre>
     *                     array(
     *                     'category_ids'=>'',
     *                     'where'=>'',
     *                     'limit'=>'',
     *                     'order'=>'',
     *                     'page'=>'',
     *                     'fkFields'=>''
     *                     )
     *                     字段说明:
     *                     category_ids:文章所在分类,可指定一个或多个分类id,以英文逗号分隔,如1或1,2,3 默认值为全部
     *                     field:调用指定的字段@todo
     *                     如只调用posts表里的id和post_title字段可以是post.id,post.post_title; 默认全部,
     *                     此方法查询时关联两个表portal_category_post(category_post),portal_post(post);
     *                     所以最好指定一下表名,以防字段冲突
     *                     limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)
     *                     order:排序方式,如按posts表里的published_time字段倒序排列：post.published_time desc
     *                     where:查询条件,字符串形式,和sql语句一样,请在事先做好安全过滤,最好使用第二个参数$where的数组形式进行过滤,此方法查询时关联多个表,所以最好指定一下表名,以防字段冲突,查询条件(只支持数组),格式和thinkPHP的where方法一样,此方法查询时关联多个表,所以最好指定一下表名,以防字段冲突;
     *                     </pre>
     * @return array 包括分页的文章列表<pre>
     *                     格式:
     *                     array(
     *                     "articles"=>array(),//文章列表,array
     *                     "page"=>"",//生成的分页html,不分页则没有此项
     *                     "total"=>100, //符合条件的文章总数,不分页则没有此项
     *                     "total_pages"=>5 // 总页数,不分页则没有此项
     *                     )</pre>
     */
    public static function articles($param)
    {
        $cmsArchivesModel = new CmsArchivesModel();

        $where = [
            'a.status' => 1,
            //'post.post_type'   => 1,
            'a.delete_time' => 0
        ];

        $paramWhere = empty($param['where']) ? '' : $param['where'];
        
        $limit       = empty($param['limit']) ? 10 : $param['limit'];
        $order       = empty($param['order']) ? 'a.list_order asc' : $param['order'];
        $page        = isset($param['page']) ? $param['page'] : false;
        $relation    = empty($param['relation']) ? '' : $param['relation'];
        $categoryIds = empty($param['category_ids']) ? '' : $param['category_ids'];

        $join = [
            //['__USER__ user', 'post.user_id = user.id'],
        ];

        $whereCategoryId = null;

         if (!empty($categoryIds)) {

            $field = !empty($param['field']) ? $param['field'] : 'a.*,c.name as c_name';
            array_push($join, ['__CMS_CHANNEL__ c', 'a.channel_id = c.id']);

            if (!is_array($categoryIds)) {
                $categoryIds = explode(',', $categoryIds);
            }

            if (count($categoryIds) == 1) {
                $whereCategoryId = function (Query $query) use ($categoryIds) {
                    $query->where('a.channel_id', $categoryIds[0]);
                };
            } else {
                $whereCategoryId = function (Query $query) use ($categoryIds) {
                    $query->where('a.channel_id', 'in', $categoryIds);
                };
            }
         } else {
            $field = !empty($param['field']) ? $param['field'] : 'a.*,c.name as c_name';
            array_push($join, ['__CMS_CHANNEL__ c', 'a.channel_id = c.id']);
        }

        /* 外表，方便外表字段搜索 beigin*/
        $leftJoin = [];
        $cmsModelxModel = new CmsModelxModel();//模型表
        $modelList = $cmsModelxModel->column('table');
        foreach($modelList as $v){
            $vUpper = strtoupper($v);
            array_push($leftJoin, ['__'.$vUpper.'__ '.$v, $v.'.id = a.id']);

        }
        /* end */

        $articles = $cmsArchivesModel
            ->alias('a')
            ->field($field)
            ->join($join)
            ->leftJoin($leftJoin)//左链接外表
            ->where($where)
            ->where($paramWhere)
            ->where($whereCategoryId)
            ->where('a.published_time', ['> time', 0], ['<', time()], 'and')
            ->order($order)
            ->group('a.id');

	

        $return = [];

        if (empty($page)) {
            $articles = $articles->limit($limit)->select();

            if (!empty($relation) && count($articles)>0 ) {
                // $articles->load($relation);
                $articles = $articles->each(function($item, $key){

                    $id = $item["id"]; //获取数据集中的id
                    $model_id = $item['model_id'];//模型id
                    $table = Db::name('cms_model')->where('id', $model_id)->value('table');//外表

                    //追加
                    // $subitem = Db::name($table)->where('id', $id)->column('*');
                    // foreach($subitem as $k1 => $v1){
                    //     $item[$k1] = $v1;
                    // }
                    //转换
                    //$fields = Db::name('cms_fields')->where('model_id', $model_id)->field('name,type')->select();//获取所有字段名称、字段类型
                    $values = [];
                    $values = db($table)->where('id', $id)->find();
                    //赋值
                    $item['content'] = cmf_replace_content_file_url(htmlspecialchars_decode($values['content']));//转码
                    $cmsFieldsModel = new \app\cms\model\CmsFieldsModel();
                    $fields = $cmsFieldsModel::where('model_id', $model_id)
                    ->order('list_order asc,id desc')
                    ->select();
                    foreach ($fields as $k => $v) {
                        switch($v->type){
                            case "editor"://编辑器
                                $item[$v->name] = cmf_replace_content_file_url(htmlspecialchars_decode($values[$v->name]));//转码
                                //$item[$v->name] = strip_tags($item[$v->name]);//剥去字符串中的 HTML 标签
                            break;
							
							case "images":
                            case "manyinfo":
                            case "manydesc":
                            case "manyinput":
								$item[$v->name] = json_decode($values[$v->name],true);
							break;
							
                            default:
                                $item[$v->name] = $values[$v->name];
                            break;
                        }
                    }
                    return $item;
                });
            }
			

            
            $return['articles'] = $articles;
        } else {

            if (is_array($page)) {
                if (empty($page['list_rows'])) {
                    $page['list_rows'] = 10;
                }
                $articles = $articles->paginate($page);
            } else {
                $articles = $articles->paginate(intval($page));
            }


            if (!empty($relation) && count($articles)>0) {
                //$articles->load($relation);
                $articles = $articles->each(function($item, $key){
                    $id = $item["id"]; //获取数据集中的id
                    $model_id = $item['model_id'];//模型id
                    $table = Db::name('cms_model')->where('id', $model_id)->value('table');

                    //追加
                    // $subitem = Db::name($table)->where('id', $id)->column('*');
                    // foreach($subitem as $k1 => $v1){
                    //     $item[$k1] = $v1;
                    // }
                    //转换
                    //$fields = Db::name('cms_fields')->where('model_id', $model_id)->field('name,type')->select();//获取所有字段名称、字段类型
                    $values = [];
                    $values = db($table)->where('id', $id)->find();
                    //赋值
                    $item['content'] = cmf_replace_content_file_url(htmlspecialchars_decode($values['content']));//转码
                    $cmsFieldsModel = new \app\cms\model\CmsFieldsModel();
                    $fields = $cmsFieldsModel::where('model_id', $model_id)
                    ->order('list_order asc,id desc')
                    ->select();
                    foreach ($fields as $k => $v) {
                        switch($v->type){
                            case "editor"://编辑器
                                $item[$v->name] = cmf_replace_content_file_url(htmlspecialchars_decode($values[$v->name]));//转码
                                //$item[$v->name] = strip_tags($item[$v->name]);//剥去字符串中的 HTML 标签
                            break;
							
                            case "images":
                            case "manyinfo":
                            case "manydesc":
                            case "manyinput":
								$item[$v->name] = json_decode($values[$v->name],true);
							break;
							
                            default:
                                $item[$v->name] = $values[$v->name];
                            break;
                        }
                    }
                    return $item;
                });
            }

            $articles->appends(request()->get());
            $articles->appends(request()->post());

            $return['articles']    = $articles->items();
            $return['page']        = $articles->render();
            $return['total']       = $articles->total();
            $return['total_pages'] = $articles->lastPage();
        }

        return $return;

    }

    /**
     * 功能:查询标签文章列表,支持分页;<br>
     * 注:此方法查询时关联两个表portal_tag_post(tag_post),portal_post(post);在指定排序(order),指定查询条件(where)最好指定一下表别名
     * @param array $param 查询参数<pre>
     *                     array(
     *                     'tag_id'=>'',
     *                     'where'=>'',
     *                     'limit'=>'',
     *                     'order'=>'',
     *                     'page'=>'',
     *                     'relation'=>''
     *                     )
     *                     字段说明:
     *                     field:调用指定的字段@todo
     *                     如只调用posts表里的id和post_title字段可以是post.id,post.post_title; 默认全部,
     *                     此方法查询时关联两个表portal_tag_post(category_post),portal_post(post);
     *                     所以最好指定一下表名,以防字段冲突
     *                     limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)
     *                     order:排序方式,如按posts表里的published_time字段倒序排列：post.published_time desc
     *                     where:查询条件,字符串形式,和sql语句一样,请在事先做好安全过滤,最好使用第二个参数$where的数组形式进行过滤,此方法查询时关联多个表,所以最好指定一下表名,以防字段冲突,查询条件(只支持数组),格式和thinkPHP的where方法一样,此方法查询时关联多个表,所以最好指定一下表名,以防字段冲突;
     *                     </pre>
     * @return array 包括分页的文章列表<pre>
     *                     格式:
     *                     array(
     *                     "articles"=>array(),//文章列表,array
     *                     "page"=>"",//生成的分页html,不分页则没有此项
     *                     "total"=>100, //符合条件的文章总数,不分页则没有此项
     *                     "total_pages"=>5 // 总页数,不分页则没有此项
     *                     )</pre>
     */
    public static function tagArticles($param)
    {
        $portalPostModel = new PortalPostModel();

        $where = [
            'a.status' => 1,
            //'post.post_type'   => 1,
            'a.delete_time' => 0
        ];

        $paramWhere = empty($param['where']) ? '' : $param['where'];

        $limit    = empty($param['limit']) ? 10 : $param['limit'];
        $order    = empty($param['order']) ? '' : $param['order'];
        $page     = isset($param['page']) ? $param['page'] : false;
        //$relation = empty($param['relation']) ? '' : $param['relation'];
        $tagId    = empty($param['tag_id']) ? '' : $param['tag_id'];

        $join = [
            //['__USER__ user', 'post.user_id = user.id'],
        ];

        if (empty($tagId)) {
            return null;

        } else {
            $field = !empty($param['field']) ? $param['field'] : 'post.*';
            array_push($join, ['__PORTAL_TAG_POST__ tag_post', 'post.id = tag_post.post_id']);

            $where['tag_post.tag_id'] = $tagId;
        }

        $articles = $portalPostModel->alias('a')->field($field)
            ->join($join)
            ->where($where)
            ->where($paramWhere)
            ->where('a.published_time', ['> time', 0], ['<', time()], 'and')
            ->order($order);

        $return = [];

        if (empty($page)) {
            $articles = $articles->limit($limit)->select();

            // if (!empty($relation) && !empty($articles['items'])) {
            //     $articles->load($relation);
            // }

            $return['articles'] = $articles;
        } else {

            if (is_array($page)) {
                if (empty($page['list_rows'])) {
                    $page['list_rows'] = 10;
                }

                $articles = $articles->paginate($page);
            } else {
                $articles = $articles->paginate(intval($page));
            }

            // if (!empty($relation) && !empty($articles['items'])) {
            //     $articles->load($relation);
            // }

            $articles->appends(request()->get());
            $articles->appends(request()->post());

            $return['articles']    = $articles->items();
            $return['page']        = $articles->render();
            $return['total']       = $articles->total();
            $return['total_pages'] = $articles->lastPage();
        }

        return $return;
    }

    /**
     * 获取指定id的文章
     * @param int $id
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public static function article($id)
    {
        $portalPostModel = new PortalPostModel();

        $where = [
            'status' => 1,
            //'post_type'   => 1,
            'id'          => $id,
            'delete_time' => 0
        ];

        return $portalPostModel->where($where)
            ->where('published_time', ['> time', 0], ['<', time()], 'and')
            ->find();
    }

    /**
     * 获取指定条件的页面列表
     * @param array $param 查询参数<pre>
     *                     array(
     *                     'where'=>'',
     *                     'order'=>'',
     *                     )</pre>
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function pages($param)
    {
        $paramWhere = empty($param['where']) ? '' : $param['where'];

        $cmsPageModel = new CmsPageModel();

        $where = [
            'status' => 1,
        ];

        return $cmsPageModel
            ->where($where)
            ->where($paramWhere)
            //->where('published_time', [['> time', 0], ['<', time()]], 'and')
            ->order($order)
            ->select();
    }

    /**
     * 获取指定id的页面
     * @param int $id 页面的id
     * @return array|false|\PDOStatement|string|\think\Model 返回符合条件的页面
     */
    public static function page($id)
    {
        $cmsPageModel = new CmsPageModel();

        $where = [
            'status' => 1,
            'id'          => $id,
        ];

        $data =$cmsPageModel->where($where)
        ->where('published_time', ['> time', 0], ['<', time()], 'and')
        ->find();

        return $data;

        // return $cmsPageModel->where($where)
        //     ->where('published_time', ['> time', 0], ['<', time()], 'and')
        //     ->find();
    }

    /**
     * 返回指定分类
     * @param int $id 分类id
     * @return array 返回符合条件的分类
     */
    public static function category($id)
    {
        $portalCategoryModel = new PortalCategoryModel();

        $where = [
            'status'      => 1,
            'delete_time' => 0,
            'id'          => $id
        ];

        return $portalCategoryModel->where($where)->find();
    }

    /**
     * 返回指定分类下的子分类
     * @param int $categoryId 分类id
     * @param     $field      string  指定查询字段
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @return false|\PDOStatement|string|\think\Collection 返回指定分类下的子分类
     */
    public static function subCategories($categoryId, $field = '*')
    {
        $cmsChannelModel = new CmsChannelModel();

        $where = [
            'status'      => 1,
            'delete_time' => 0,
            'parent_id'   => $categoryId
        ];
		return $cmsChannelModel->field($field)->where($where)->order('list_order ASC')->select();
	}

    /**
     * 返回指定分类下的所有子分类
     * @param int $categoryId 分类id
     * @return array 返回指定分类下的所有子分类
     */
    public static function allSubCategories($categoryId)
    {
        $cmsChannelModel = new CmsChannelModel();

        $categoryId = intval($categoryId);

        if ($categoryId !== 0) {
            $category = $cmsChannelModel->field('path')->where('id', $categoryId)->find();

            if (empty($category)) {
                return [];
            }

            $categoryPath = $category['path'];
        } else {
            $categoryPath = 0;
        }

        $where = [
            'status'      => 1,
            'delete_time' => 0,
            'path'        => ['like', "$categoryPath-%"]
        ];

        return $portalCategoryModel->where($where)->select();
    }

    /**
     * 返回符合条件的所有分类
     * @param array $param 查询参数<pre>
     *                     array(
     *                     'where'=>'',
     *                     'order'=>'',
     *                     )</pre>
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function categories($param)
    {
        $paramWhere = empty($param['where']) ? '' : $param['where'];

        $order = empty($param['order']) ? '' : $param['order'];

        $cmsChannelModel = new CmsChannelModel();

        $where = [
            'status'      => 1,
            'delete_time' => 0,
        ];

        $temp = $cmsChannelModel
            ->where($where)
            ->where($paramWhere)
            ->order($order);

        if (!empty($param['ids'])) {
            $temp->whereIn('id', $param['ids']);
        }
        return $temp->select();
    }

    /**
     * 获取面包屑数据
     * @param int     $categoryId  当前文章所在分类,或者当前分类的id
     * @param boolean $withCurrent 是否获取当前分类
     * @return array 面包屑数据
     */
    public static function breadcrumb($categoryId, $withCurrent = false)
    {
        $data                = [];
        $cmsChannelModel = new CmsChannelModel();

        $path = $cmsChannelModel->where(['id' => $categoryId])->value('path');

        if (!empty($path)) {
            $parents = explode('-', $path);
            if (!$withCurrent) {
                array_pop($parents);
            }

            if (!empty($parents)) {
                $data = $cmsChannelModel->where('id', 'in', $parents)->order('path ASC')->select();
            }
        }
        return $data;
    }

    // /**
    //  * 追加_text属性值
    //  * @param $fieldsContentList
    //  * @param $addon
    //  */
    // public static function appendTextAttr(&$fieldsContentList, &$addon)
    // {
    //     //附加列表字段
    //     array_walk($fieldsContentList, function ($content, $field) use (&$addon) {
    //         if (isset($addon[$field])) {
    //             if (isset($content[$addon[$field]])) {
    //                 $value = $content[$addon[$field]];
    //             } else {
    //                 $arr = explode(',', $addon[$field]);
    //                 foreach ($arr as $index => &$item) {
    //                     $item = isset($content[$item]) ? $content[$item] : $item;
    //                 }
    //                 $value = implode(',', $arr);
    //             }
    //         } else {
    //             $value = '';
    //         }
    //         $addon[$field . '_text'] = $value;
    //     });
    // }

    //获取幻灯片名称
    public static function getslideinfo($id){
        $slidePostModel = new SlideModel();
        $slide         = $slidePostModel->where(['id'=>$id])->select();
        return $slide;
    }


}