<?php /*a:2:{s:81:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/cms/admin_form/index.html";i:1627524530;s:74:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/public/header.html";i:1627524563;}*/ ?>
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
            <li class="active"><a href="<?php echo url('AdminForm/index'); ?>">留言列表</a></li>

        </ul>
		<div style="padding: 10px 15px; background: #e8edf0;">收集客户前台留言信息</div>
        <form class="js-ajax-form" method="post">
           
            <table class="table table-hover table-bordered table-list">
                <thead>
                    <tr>
                        <th width="16">
                            <label>
                                <input type="checkbox" class="js-check-all" data-direction="x"
                                    data-checklist="js-check-x">
                            </label>
                        </th>
                        <th width="100">ID</th>
                        <th>姓名</th>
                        <th width="200">电话</th>
                       
						<th>辅导内容</th>
                        <th>备注内容</th>
                       
                        <th width="160">发布时间</th>
                        
                        <th width="120">操作</th>
                    </tr>
                </thead>
          
                <?php if(is_array($pages) || $pages instanceof \think\Collection || $pages instanceof \think\Paginator): if( count($pages)==0 ) : echo "" ;else: foreach($pages as $key=>$vo): ?>
                    <tr>
						<td>
                            <input type="checkbox" class="js-check" data-yid="js-check-y" data-xid="js-check-x"
                                name="ids[]" value="<?php echo $vo['id']; ?>">
                        </td>
                        <td><?php echo $vo['id']; ?></td>
                        <td><?php echo $vo['name']; ?></td>
                        <td><?php echo $vo['phone']; ?></td>
                      
                        <td><?php echo $vo['content']; ?></td>
                          <td><?php echo $vo['mark']; ?></td>
						<td>
                            <?php if(!(empty($vo['create_time']) || (($vo['create_time'] instanceof \think\Collection || $vo['create_time'] instanceof \think\Paginator ) && $vo['create_time']->isEmpty()))): ?>
                                <?php echo date('Y-m-d H:i',$vo['create_time']); ?>
                            <?php endif; ?>

                        </td>
						<td>

                            <a class="btn btn-xs btn-danger js-ajax-delete"
                                href="<?php echo url('AdminFrom/delete',array('id'=>$vo['id'])); ?>"><?php echo lang('DELETE'); ?></a>
                        </td>
						
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
      
            </table>
            <div class="table-actions">
                <button class="btn btn-danger btn-sm js-ajax-submit" type="submit"
                    data-action="<?php echo url('AdminForm/delete'); ?>" data-subcheck="true" data-msg="你确定删除吗？"><?php echo lang('DELETE'); ?>
                </button>
            </div>
            <div class="pagination"><?php echo $page; ?></div>
        </form>
    </div>
    <script src="/static/js/admin.js"></script>
</body>

</html>