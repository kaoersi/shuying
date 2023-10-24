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

use app\cms\model\CmsActivepushModel;
use app\cms\model\AdminArchivesController;
use app\cms\model\AdminAsksController;
use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;

/**
 * Class AdminTagsController 问答管理控制器
 * @package app\cms\controller
 */
class AdminActivepushController extends AdminBaseController
{
    /**
     * 问答列表
     */
    public function index()
    {

        $activepush = Db::name('CmsActivepush')->order("create_time DESC")->paginate(10,false);

        // 获取分页显示
        $page = $activepush->render();
        $this->assign('activepush', $activepush);
        $this->assign('page', $page);

        return $this->fetch();

    }

    /**
     * 添加问答
     */
    public function add()
    {
        //搜索引擎类型 0 百度 1百度快速提交 2必应 3谷歌
        $categarr = array(
            '0' => 'http://data.zz.baidu.com/urls?site=https://www.shuyingjp.com&token=yyV0QggIjY7Ouifj', 
            '1' => 'http://data.zz.baidu.com/urls?site=https://www.shuyingjp.com&token=yyV0QggIjY7Ouifj',
        );

        $arrData = $this->request->param();
        //获取选择的搜索引擎
        $category = $arrData['category'];

        //print_r($arrData['start_time']);
        if (!empty($arrData['start_time']) && !empty($arrData['start_time'])) {
            //开始时间
            $statime = strtotime($arrData['start_time']);
            //结束时间
            $endtime = strtotime($arrData['end_time']);
        }else{
            echo "<script>alert('请选择时间！');window.history.back();</script>";
        }
        

        $lxzkid = Db::query("select id,channel_id from ls_cms_archives where create_time between $statime and $endtime");


        foreach ($lxzkid as $key => $value) {
            $channel_id = $value['channel_id'];
            if ($channel_id == 37) {
                $url = 'zx';
            }elseif ($channel_id == 25) {
                $url = 'faqs';
            }elseif ($channel_id == 38) {
                $url = 'rm';
            }elseif ($channel_id == 56) {
                $url = 'gz';
            }elseif ($channel_id == 57) {
                $url = 'bk';
            }elseif ($channel_id == 58) {
                $url = 'yjs';
            }elseif ($channel_id == 59) {
                $url = 'dxy';
            }elseif ($channel_id == 60) {
                $url = 'sgusq';
            }elseif ($channel_id == 61) {
                $url = 'yysq';
            }elseif ($channel_id == 41) {
                $url = 'life';
            }elseif ($channel_id == 52) {
                $url = 'ws';
            }elseif ($channel_id == 53) {
                $url = 'lg';
            }elseif ($channel_id == 54) {
                $url = 'yy';
            }elseif ($channel_id == 55) {
                $url = 'ys';
            }
            if (!empty($url)) {
                $urlss .= "https://www.shuyingjp.com/".$url."-".$value[id].".html,";
            }
              
        }

        //百度提交开始
        $urls = explode(',',$urlss);
        $api = $categarr[$category];
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        //百度提交结束
        
        $newres = json_decode($result,true);
        //print_r($newres);

        //有不合法的url
        if (!empty($newres['not_valid'])) {
            //如果有不合法的url存到CmsActivepush表中
            foreach ($newres['not_valid'] as $k => $v) {
                $arrnew[$k][url] = $v;
                $arrnew[$k][details] = "不合法的url列表";
                $arrnew[$k][create_time] = time();
            }
            $active = Db::name('CmsActivepush')->insertAll($arrnew);

            if (count($active) > 0) {
                echo "
                    <script>
                        alert('提交的列表中有不合法的URL，其中".$active." 条已加入数据库！');
                        window.history.back();
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert('提交的列表中有不合法的URL，尝试加入数据库但没有成功，请联系网站管理人员');
                        window.history.back();
                    </script>
                ";
            }
            
        }
        //不是本站url而未处理的url列表
        if (!empty($newres['not_same_site'])) {
            //如果有不合法的url存到CmsActivepush表中
            foreach ($newres['not_same_site'] as $k => $v) {
                $arrnew[$k][url] = $v;
                $arrnew[$k][details] = "不合法的url列表";
                $arrnew[$k][create_time] = time();
            }
            $active = Db::name('CmsActivepush')->insertAll($arrnew);

            if (count($active) > 0) {
                echo "
                    <script>
                        alert('提交的列表中有不是本站的URL，其中".$active." 条已加入数据库！');
                        window.history.back();
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert('提交的列表中有不是本站的URL，尝试加入数据库但没有成功，请联系网站管理人员');
                        window.history.back();
                    </script>
                ";
            }
            
        }
        //提交成功
        if (!empty($newres['success'])) {
            echo "
                <script>
                    alert('成功提交 ".$newres['success'].' 条数据,今日配额还有 '.$newres['remain']." 条!');
                    window.history.back();
                </script>
            ";
        }
        //提交失败
        if (!empty($newres['error'])) {
            echo "
                <script>
                    alert('错误码".$newres['error'].','.$newres['message']."');
                    window.history.back();
                </script>
            ";
        }
    }

    /**
     * CmsActivepush表中数据提价
     */
    public function addPost()
    {
        $activepush = Db::name('CmsActivepush')->where('update_time','neq','')->select()->toarray();


        $urls = array();
        $id = array();
        foreach ($activepush as $key => $value) {
            $urls[$key] = $value[url];
            $id[$key][id] = $value[id]; 

        }

        //搜索引擎类型 0 百度 1搜狗 2必应 3谷歌
        $categarr = array(
            '0' => 'http://data.zz.baidu.com/urls?site=https://www.shuyingjp.com&token=yyV0QggIjY7Ouifj', 
            '1' => 'http://data.zz.baidu.com/urls?site=https://www.shuyingjp.com&token=yyV0QggIjY7Ouifj', 
        );

        //百度提交开始
        $api = $categarr[0];
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        //百度提交结束
        foreach ($id as $k => $v) {
            $del = Db::name('CmsActivepush')->where('id',$v[id])->delete();
        }
        
        $newres = json_decode($result,true);

        //有不合法的url
        if (!empty($newres['not_valid'])) {

            //如果有不合法的url存到CmsActivepush表中
            foreach ($newres['not_valid'] as $k => $v) {
                $arrnew[$k][url] = $v;
                $arrnew[$k][details] = "不合法的url列表";
                $arrnew[$k][create_time] = time();
            }
            $active = Db::name('CmsActivepush')->insertAll($arrnew);

            if (count($active) > 0) {
                echo "
                    <script>
                        alert('提交的列表中有不合法的URL，其中".$active." 条已加入数据库！');
                        window.history.back();
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert('提交的列表中有不合法的URL，尝试加入数据库但没有成功，请联系网站管理人员');
                        window.history.back();
                    </script>
                ";
            }
            
        }
        //不是本站url而未处理的url列表
        if (!empty($newres['not_same_site'])) {
            //如果有不合法的url存到CmsActivepush表中
            foreach ($newres['not_same_site'] as $k => $v) {
                $arrnew[$k][url] = $v;
                $arrnew[$k][details] = "本站的url";
                $arrnew[$k][create_time] = time();
            }
            $active = Db::name('CmsActivepush')->insertAll($arrnew);

            if (count($active) > 0) {
                echo "
                    <script>
                        alert('提交的列表中有不是本站的URL，其中".$active." 条已加入数据库！');
                        window.history.back();
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert('提交的列表中有不是本站的URL，尝试加入数据库但没有成功，请联系网站管理人员');
                        window.history.back();
                    </script>
                ";
            }
            
        }
        //提交成功
        if (!empty($newres['success'])) {
            echo "
                <script>
                    alert('成功提交 ".$newres['success'].' 条数据,今日配额还有 '.$newres['remain']." 条!');
                    window.history.back();
                </script>
            ";
        }
        //提交失败
        if (!empty($newres['error'])) {
            echo "
                <script>
                    alert('错误码".$newres['error'].','.$newres['message']."');
                    window.history.back();
                </script>
            ";
        }
    }
    /**
     * 修改操作
     */
      public function edit()
    {
        $CmsActivepushModel = new CmsActivepushModel();
        $id = $this->request->param("id");
        $result=$CmsActivepushModel->where(array('id'=>$id))->find();
        $this->assign('result', $result);
        return $this->fetch();
    }

    /**
     * 更新问答
     */
    public function editPost()
    {
   
        $arrData = $this->request->param();

        $avaid=$arrData['post']['id'];

        $arrData['post']['url']=$arrData['post']['url'];

        $arrData['post']['details']=$arrData['post']['details'];

        $arrData['post']['update_time'] = time();

        $CmsActivepushModel = new CmsActivepushModel();
        

        $CmsActivepushModel->update($arrData['post'])->where('id','eq',$avaid);


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
        $CmsActivepushModel = new CmsActivepushModel();
        $CmsActivepushModel->where('id' , $intId)->delete();
        $this->success(lang("DELETE_SUCCESS"));
    }

}
