<?php /*a:2:{s:87:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/cms/admin_activepush/index.html";i:1637739369;s:74:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/public/header.html";i:1627524563;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


    <link href="/themes/admin_simpleboot3/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/admin_simpleboot3/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <link href="/static/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        form .input-order {
            margin-bottom: 0px;
            padding: 0 2px;
            width: 42px;
            font-size: 12px;
        }

        form .input-order:focus {
            outline: none;
        }

        .table-actions {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0px;
        }

        .table-list {
            margin-bottom: 0px;
        }

        .form-required {
            color: red;
        }
    </style>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "/",
            WEB_ROOT: "/",
            JS_ROOT: "static/js/",
            APP: '<?php echo app('request')->module(); ?>'/*当前应用名*/
        };
    </script>
    <script src="/themes/admin_simpleboot3/public/assets/js/jquery-1.10.2.min.js"></script>
    <script src="/static/js/wind.js"></script>
    <script src="/themes/admin_simpleboot3/public/assets/js/bootstrap.min.js"></script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip({
                container:'body',
                html:true,
            });
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
</head>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?php echo url('AdminActivepush/add'); ?>">API推送首页</a></li>
    </ul>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('AdminActivepush/add'); ?>">
        引擎选择:
        <select class="form-control" name="category" style="width: 180px;">
            <option value='0'>百度普通提交</option>
            <option value='1'>百度快速提交(限10条)</option>
            <option value='2'>必应</option>
            <option value='3'>谷歌</option>
            <?php echo (isset($category_tree) && ($category_tree !== '')?$category_tree:'2'); ?>
        </select> &nbsp;&nbsp
        开始时间:
        <input type="text" class="form-control js-bootstrap-datetime" name="start_time"
               value="<?php echo (isset($start_time) && ($start_time !== '')?$start_time:''); ?>" style="width: 140px;" autocomplete="off"> &nbsp;&nbsp;
        结束时间:
        <input type="text" class="form-control js-bootstrap-datetime" name="end_time"
               value="<?php echo (isset($end_time) && ($end_time !== '')?$end_time:''); ?>" style="width: 140px;" autocomplete="off"> &nbsp; &nbsp;
            
        <input type="submit" class="btn btn-primary" value="推送"/>
        <a class="btn btn-danger" href="<?php echo url('AdminActivepush/addPost'); ?>" style="margin-left: 430px;">驳回数据提交</a>
        <span style="color: red;">只会提交修改时间不为空的链接</span>
    </form>

    <form class="js-ajax-form" action="" method="post">
        
        <table class="table table-hover table-bordered table-list">
            <thead>
            <tr>
                <?php if(!(empty($category) || (($category instanceof \think\Collection || $category instanceof \think\Paginator ) && $category->isEmpty()))): ?>
                    <th width="50"><?php echo lang('SORT'); ?></th>
                <?php endif; ?>
                <th width="50">ID</th>
                <th width="150">被驳回的URL</th>
                <th width="200">驳回原因</th>
                <th width="65">驳回时间</th>
                <th width="65">修改时间</th>
                <th width="65">操作</th>
            </tr>
            </thead>
            <?php if(is_array($activepush) || $activepush instanceof \think\Collection || $activepush instanceof \think\Paginator): if( count($activepush)==0 ) : echo "" ;else: foreach($activepush as $key=>$vo): ?>
                <tr>
                    <td><b><?php echo $vo['id']; ?></b></td>
                    <td><a href="<?php echo $vo['url']; ?>"><?php echo $vo['url']; ?></a></td>
                    <td><?php echo $vo['details']; ?></td>
                    <td>
                        <?php if(!(empty($vo['create_time']) || (($vo['create_time'] instanceof \think\Collection || $vo['create_time'] instanceof \think\Paginator ) && $vo['create_time']->isEmpty()))): ?>
                            <?php echo date('Y-m-d H:i',$vo['create_time']); ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if(!(empty($vo['update_time']) || (($vo['update_time'] instanceof \think\Collection || $vo['update_time'] instanceof \think\Paginator ) && $vo['update_time']->isEmpty()))): ?>
                            <?php echo date('Y-m-d H:i',$vo['update_time']); ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="<?php echo url('AdminActivepush/edit',array('id'=>$vo['id'])); ?>"><?php echo lang('EDIT'); ?></a>
                        <a class="btn btn-xs btn-danger js-ajax-delete" href="<?php echo url('AdminActivepush/delete',array('id'=>$vo['id'])); ?>"><?php echo lang('DELETE'); ?></a>
                    </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <ul class="pagination"><?php echo (isset($page) && ($page !== '')?$page:''); ?></ul>
    </form>
</div>
<script src="/static/js/admin.js"></script>

</body>
</html>