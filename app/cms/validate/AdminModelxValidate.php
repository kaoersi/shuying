<?php
namespace app\cms\validate;

use think\Validate;

class AdminModelxValidate extends Validate
{
    protected $rule = [
        'post.name'  => 'require',
        'post.table' => 'require',
        'post.listtpl' => 'require',
        'post.showtpl' => 'require'
    ];

    protected $message = [
        'post.name.require'      => '模型名称不能为空',
        'post.table.require'     => '表名不能为空',
        'post.listtpl.require'   => '列表页模板不能为空',
        'post.showtpl.require'   => '详情页模板不能为空'
    ];

}