<?php
namespace app\cms\model;
use think\Model;

/**
 * 配置模型
 */
class ConfigModel extends Model
{
/**
     * 读取配置类型
     * @return array
     */
    public static function getTypeList()
    {
        $typeList = [
            'string'       => '字符',
            'text'         => '文本',
            'editor'       => '编辑器',
            'number'       => '数字',
            'date'         => '日期',
            'time'         => '时间',
            'datetime'     => '日期时间',
            'image'        => '图片',
            'images'       => '图片(多)',
            'file'         => '文件',
            'files'        => '文件(多)',
            //'select'       => '列表',
            //'selects'      => '列表(多选)',
            //'switch'       => '开关',
            'checkbox'     => '复选',
            'radio'        => '单选',
            'manyinfo'        => '带图多信息',
            'manyinput'        => '纯文字多信息',
            'manydesc'        => '带简介带图多信息',
            //'array'        => '数组',
        ];
        return $typeList;
    }

    public static function getRegexList()
    {
        $regexList = [
            'required' => '必选',
            'digits'   => '数字',
            'letters'  => '字母',
            'date'     => '日期',
            'time'     => '时间',
            'email'    => '邮箱',
            'url'      => '网址',
            'qq'       => 'QQ号',
            'IDcard'   => '身份证',
            'tel'      => '座机电话',
            'mobile'   => '手机号',
            'zipcode'  => '邮编',
            'chinese'  => '中文',
            'username' => '用户名',
            'password' => '密码'
        ];
        return $regexList;
    }

    /**
     * 读取分类分组列表
     * @return array
     */
    // public static function getGroupList()
    // {
    //     $groupList = config('site.configgroup');
    //     foreach ($groupList as $k => &$v) {
    //         $v = __($v);
    //     }
    //     return $groupList;
    // }

    public static function getArrayData($data)
    {
        $fieldarr = $valuearr = [];
        $field = isset($data['field']) ? $data['field'] : [];
        $value = isset($data['value']) ? $data['value'] : [];
        foreach ($field as $m => $n) {
            if ($n != '') {
                $fieldarr[] = $field[$m];
                $valuearr[] = $value[$m];
            }
        }
        return $fieldarr ? array_combine($fieldarr, $valuearr) : [];
    }

    /**
     * 将字符串解析成键值数组
     * @param string $text
     * @return array
     */
    public static function decode($text, $split = "\r\n")
    {
        $content = explode($split, $text);
        $arr = [];
        foreach ($content as $k => $v) {
            if (stripos($v, "|") !== false) {
                $item = explode('|', $v);
                $arr[$item[0]] = $item[1];
            }
        }
        return $arr;
    }

    /**
     * 将键值数组转换为字符串
     * @param array $array
     * @return string
     */
    public static function encode($array, $split = "\r\n")
    {
        $content = '';
        if ($array && is_array($array)) {
            $arr = [];
            foreach ($array as $k => $v) {
                $arr[] = "{$k}|{$v}";
            }
            $content = implode($split, $arr);
        }
        return $content;
    }

}