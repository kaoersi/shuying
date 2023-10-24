<?php /*a:2:{s:84:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/cms/admin_channel/index.html";i:1627524528;s:74:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/public/header.html";i:1627524563;}*/ ?>
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
            <li class="active"><a href="<?php echo url('AdminChannel/index'); ?>">分类管理</a></li>
            <li><a href="<?php echo url('AdminChannel/add'); ?>">添加分类</a></li>
        </ul>
        <div style="padding: 10px 15px; background: #e8edf0;">用于管理网站的分类，可进行无限级分类，注意只有类型为列表的才可以添加文章</div>
        <form method="post" class="js-ajax-form" action="<?php echo url('AdminChannel/listOrder'); ?>">
            <div class="table-actions">
                <button type="submit" class="btn btn-primary btn-sm js-ajax-submit"><?php echo lang('SORT'); ?></button>
                <button class="btn btn-primary btn-sm js-ajax-submit" type="submit"
                    data-action="<?php echo url('AdminChannel/toggle',array('display'=>'1')); ?>" data-subcheck="true">
                    <?php echo lang('DISPLAY'); ?>
                </button>
                <button class="btn btn-primary btn-sm js-ajax-submit" type="submit"
                    data-action="<?php echo url('AdminChannel/toggle',array('hide'=>1)); ?>" data-subcheck="true"><?php echo lang('HIDE'); ?>
                </button>
            </div>
            <table class="table table-hover table-bordered table-list" id="menus-table">
                <thead>
                    <tr>
                        <th width="16" style="padding-left:20px;">
                            <label>
                                <input type="checkbox" class="js-check-all" data-direction="x"
                                    data-checklist="js-check-x">
                            </label>
                        </th>
                        <th width="50">排序</th>
                        <th width="50">ID</th>
                        <th>类型</th>
                        <th>模型名称</th>
                        <th>名称</th>
                        <th>状态</th>
                        <th width="210">操作</th>
                    </tr>
                </thead>
                <?php echo $category_tree; ?>
                <!-- <tfoot>
                    <tr>
                        <th width="16" style="padding-left:20px;">
                            <label>
                                <input type="checkbox" class="js-check-all" data-direction="x"
                                    data-checklist="js-check-x">
                            </label>
                        </th>
                        <th width="50">排序</th>
                        <th width="50">ID</th>
                        <th>类型</th>
                        <th>模型名称</th>
                        <th>名称</th>
                        <th>状态</th>
                        <th width="200">操作</th>
                    </tr>
                </tfoot> -->
            </table>

            <div class="table-actions">
                <button type="submit" class="btn btn-primary btn-sm js-ajax-submit"><?php echo lang('SORT'); ?></button>
                <button class="btn btn-primary btn-sm js-ajax-submit" type="submit"
                    data-action="<?php echo url('AdminChannel/toggle',array('display'=>'1')); ?>" data-subcheck="true">
                    <?php echo lang('DISPLAY'); ?>
                </button>
                <button class="btn btn-primary btn-sm js-ajax-submit" type="submit"
                    data-action="<?php echo url('AdminChannel/toggle',array('hide'=>1)); ?>" data-subcheck="true"><?php echo lang('HIDE'); ?>
                </button>
            </div>
        </form>
    </div>
    <script src="/static/js/admin.js"></script>
    <script>
        $(document).ready(function () {
            Wind.css('treeTable');
            Wind.use('treeTable', function () {
                $("#menus-table").treeTable({
                    indent: 20,
                    initialState: 'expanded'
                });
            });
        });
    </script>
</body>

</html>