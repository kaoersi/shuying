<?php
namespace app\cms\model;

use app\admin\model\RouteModel;
use think\Model;
use think\Db;
use think\db\Query;

/**
 * @property mixed id
 */
class CmsAsksModel extends Model
{
     
    // 表名
    protected $name = 'cms_asks';

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
     * 增加标签
     * @param $keywords
     * @param $articleId
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function addTags($keywords, $articleId)
    {
        $cmsTagsModel = new CmsTagsModel();

           $tag_ids = [];

        $data = [];
         $len_my = [];
         $len_mynew = [];

        if (!empty($keywords)) {

            foreach ($keywords as $keyword) {
                $keyword = trim($keyword);

                if (!empty($keyword)) {
                    //判断是已存在
                    $findTag = $cmsTagsModel->where('name', $keyword)->where('type','2')->find();
                    if (empty($findTag)) {
                        $tagId = $cmsTagsModel->insertGetId([
                            'name'     => $keyword,
                            'archives' => $articleId,
                            'nums'     => 1,
                            'type'     => '2'
                        ]);
                        $tag_ids[]=$tagId;
                    } else {

                        //查找历史数据
                        $oldTagIdsa = $cmsTagsModel->where('name', $keyword)->where('type','2')->column('archives');
                        $id_newa = $cmsTagsModel->where('name', $keyword)->where('type','2')->column('id');

                        if(!empty($oldTagIdsa[0])){
//S
                                  $oldTagIds=explode(',',$oldTagIdsa[0]);
                                 if (!in_array($articleId, $oldTagIds)) {
                                    array_push($oldTagIds, $articleId);
                                    $archives_num=count($oldTagIds);
                                    //数组转换为字符串
                                    $result = implode(',', $oldTagIds);
                                     $cmsTagsModel->where('name', $keyword)->where('type','2')->update(['archives' => $result,'nums'=>$archives_num]);


                                }
                                 
                                 foreach ($id_newa as $k => $v) {
                                      $tag_ids[]=$v;
                                    }

                                




                        }else{
                            //如过关键词匹配到但是 值伟空
                              $cmsTagsModel->where('name', $keyword)->where('type','2')->update(['archives' => $articleId]);
                               $tag_ids[]=$findTag['id'];
                              
                        }
                       

                       

                    }
                }
            }

               $arrs = $cmsTagsModel->where('archives','like','%'.$articleId."%")->where('type','2')->select()->toArray();//含有当前文章的 tag IDS 





               foreach ($arrs as $k => $v) {
                if(!in_array($v['id'],$tag_ids)){
                   
                  $len_my=explode(",",$v['archives']);
                  if(count($len_my) == 1){
                    if($v['archives'] == $articleId){
                      $cmsTagsModel->where('id', $v['id'])->delete();  
                    }
                  }else{
             

                      foreach ($len_my as $k1 => $v1) {
                         if($v1 == $articleId){
                            unset($len_my[$k1]);
                            //新增
                   $oldnum=count($len_my);
                    $oldnum2=$oldnum-1;
                        $cmsTagsModel->where('id', $v['id'])->update(['archives' => implode(',',$len_my),'nums'=>$oldnum2]); 


                         } 
                      }
                       $archives_num2=count($len_my);
                       $result1 = implode(',', $len_my);

                            $cmsTagsModel->where('id', $v['id'])->update(['archives' => $result1,'nums'=>$archives_num2]);
                          


                  }
                }
               }
  //E


        } else {
//S 没有问题
               $arrs = $cmsTagsModel->where('archives','like','%'.$articleId."%")->where('type','2')->select()->toArray();//含有当前文章的 tag IDS 
   

               foreach ($arrs as $k => $v) {
       
                  $len_my=explode(",",$v['archives']);
                  if(count($len_my) == 1){
                    //防止删错
                    if($v['archives'] == $articleId){
                      $cmsTagsModel->where('id', $v['id'])->delete();  
                    }
                    
                  }else{
                      foreach ($len_my as $k1 => $v1) {
                         if($v1 != $articleId){
                            $len_mynew[]=$v1;
                         }else{

                         unset($len_my[$k1]);
                       //新增
                           $oldnum=count($len_my);
                    $oldnum2=$oldnum-1;
                        $cmsTagsModel->where('id', $v['id'])->update(['archives' => implode(',',$len_my),'nums'=>$oldnum2]); 


                         }
                      }
                    $archives_num2=count($len_mynew);
                       $result1 = implode(',', $len_mynew);
                        $cmsTagsModel->where('id', $v['id'])->update(['archives' => $result1,'nums'=>$archives_num2]);




                  }
              
               }
  //E


            $cmsTagsModel->where('archives', $articleId)->delete();
        }
    }



/**

* 获取Excel文件数据

*/

function do_execl_import($filename, $exts='xls',$currentRow=1){

    //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入

    require(WEB_ROOT."/vendor/PHPExcel/PHPExcel.php");

    //创建PHPExcel对象，注意，不能少了\

    $PHPExcel=new \PHPExcel();

    //如果excel文件后缀名为.xls，导入这个类

    if($exts == 'xls'){

       
         require(WEB_ROOT."/vendor/PHPExcel/PHPExcel/Reader/Excel5.php");

        $PHPReader=new \PHPExcel_Reader_Excel5();

    }else if($exts == 'xlsx'){
        require(WEB_ROOT."/vendor/PHPExcel/PHPExcel/Reader/Excel2007.php");

  
        $PHPReader=new \PHPExcel_Reader_Excel2007();

    }


    //载入文件

    $PHPExcel=$PHPReader->load($filename);

    //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推

    $currentSheet=$PHPExcel->getSheet(0);

    //获取总列数

    $allColumn=$currentSheet->getHighestColumn();

    //获取总行数

    $allRow=$currentSheet->getHighestRow();

    

    //由列名转为列数(字母转为数字 A -> 1)

    $Letter_To_Sum     = \PHPExcel_Cell::columnIndexFromString($allColumn);

    

    //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始

    for($currentRow;$currentRow<=$allRow;$currentRow++){

        //从哪列开始，A表示第一列

        for($currentColumn='0';$currentColumn<=$Letter_To_Sum;$currentColumn++){

            

            //由列数反转列名(0->'A')

            $Sum_To_Letter = \PHPExcel_Cell::stringFromColumnIndex($currentColumn);

            

            //数据坐标

            $address=$Sum_To_Letter.$currentRow;

            //读取到的数据，保存到数组$arr中

            $data[$currentRow][$Sum_To_Letter]=$currentSheet->getCell($address)->getValue();

            

        }



    }

    

    return $data;

   // $this->save_import($data);

}






}
