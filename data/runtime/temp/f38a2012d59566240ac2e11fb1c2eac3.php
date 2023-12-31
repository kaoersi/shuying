<?php /*a:2:{s:75:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/admin/link/add.html";i:1635415744;s:74:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/public/header.html";i:1627524563;}*/ ?>
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
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo url('link/index'); ?>"><?php echo lang('ADMIN_LINK_INDEX'); ?></a></li>
			<li class="active"><a href="<?php echo url('link/add'); ?>"><?php echo lang('ADMIN_LINK_ADD'); ?></a></li>
	        <li><a href="<?php echo url('link/category_index'); ?>">友情链接类别管理</a></li>
	        <li><a href="<?php echo url('link/category_add'); ?>">添加类别</a></li>
		</ul>

		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('link/addPost'); ?>">
			
			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label">所在位置<span class="form-required">*</span></label>
				<div class="col-md-6 col-sm-10">
					<select class="form-control" name="type">
			            <?php if(is_array($link_arr) || $link_arr instanceof \think\Collection || $link_arr instanceof \think\Paginator): if( count($link_arr)==0 ) : echo "" ;else: foreach($link_arr as $k=>$vo): ?>
			             	<option value='<?php echo $k; ?>'><?php echo $vo; ?></option>
			            <?php endforeach; endif; else: echo "" ;endif; ?>
			        </select>
				</div>
			</div>

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label">名称<span class="form-required">*</span></label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-name" name="name">
				</div>
			</div>
			<div class="form-group">
				<label for="input-url" class="col-sm-2 control-label">链接地址<span class="form-required">*</span></label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-url" name="url">
				</div>
			</div>
			<div class="form-group">
				<label for="input-image" class="col-sm-2 control-label">图标</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-image" name="image"> 
					<a href="javascript:uploadOneImage('图片上传','#input-image');">上传图片</a>
				</div>
			</div>
			<div class="form-group">
				<label for="input-target" class="col-sm-2 control-label">打开方式</label>
				<div class="col-md-6 col-sm-10">
					<select class="form-control" name="target" id="input-target">
						<?php if(is_array($targets) || $targets instanceof \think\Collection || $targets instanceof \think\Paginator): if( count($targets)==0 ) : echo "" ;else: foreach($targets as $key=>$vo): ?>
						<option value="<?php echo $key; ?>"><?php echo $vo; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="input-description" class="col-sm-2 control-label">描述</label>
				<div class="col-md-6 col-sm-10">
					<textarea class="form-control" name="description" id="input-description" ></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('ADD'); ?></button>
					<a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
				</div>
			</div>
		</form>
	</div>
	<script src="/static/js/admin.js"></script>
</body>
</html>