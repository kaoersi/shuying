<?php /*a:2:{s:82:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/cms/admin_channel/add.html";i:1627524527;s:74:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/public/header.html";i:1627524563;}*/ ?>
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
            <li><a href="<?php echo url('AdminChannel/index'); ?>">分类管理</a></li>
            <li class="active"><a href="<?php echo url('AdminChannel/add'); ?>">添加分类</a></li>
        </ul>
        <div style="padding: 10px 15px; background: #e8edf0;">用于管理网站的分类，可进行无限级分类，注意只有类型为列表的才可以添加文章</div>
        <div class="row">
            <!-- <div class="col-md-2">
            <div class="list-group">
                <a class="list-group-item" href="#A" data-toggle="tab">基本属性</a>
                <a class="list-group-item" href="#B" data-toggle="tab">SEO设置</a>
                <a class="list-group-item" href="#C" data-toggle="tab">模板设置</a>
            </div>
        </div> -->
            <div class="col-md-6">
			
			<?php 
				$type = request()->param('type');
				if(empty($type)){
					$type = 'list';
				}
			 ?>
			  
			
			<div class="row" style="">
                <div class="col-md-12" style="">
				
				<form class="js-ajax-form" action="<?php echo url('AdminChannel/addPost'); ?>" method="post">
				
                    <table class="table table-bordered" style="margin-bottom: -1px;">
                        <tbody style="">
						<tr>
                            <th width="150">栏目类型<span class="form-required">*</span></th>
                            <td>
								<select class="form-control valid" name="type" id="input-type" aria-invalid="false">
                                    <option value="list" <?php if($type == 'list'): ?>selected<?php endif; ?> >列表</option>
                                    <option value="channel" <?php if($type == 'channel'): ?>selected<?php endif; ?> >频道</option>
                                    <option value="link" <?php if($type == 'link'): ?>selected<?php endif; ?> >外部链接</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <th>所属模型<span class="form-required">*</span></th>
                            <td>
                                <select class="form-control" name="model_id" id="input-model_id">
                                    <?php if(is_array($modelxList) || $modelxList instanceof \think\Collection || $modelxList instanceof \think\Paginator): if( count($modelxList)==0 ) : echo "" ;else: foreach($modelxList as $key=>$vo): ?>
                                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </td>
                        </tr>						
						<tr>
                            <th>上级<span class="form-required">*</span></th>
                            <td>
                                <select class="form-control" name="parent_id" id="input-parent">
                                    <option value="0">作为一级分类</option>
                                    <?php echo $channel_tree; ?>
                                </select>
                            </td>
                        </tr>						
						<tr>
                            <th>栏目名称<span class="form-required">*</span></th>
                            <td>
                                <input type="text" class="form-control" id="input-name" name="name">
                            </td>
                        </tr> 
                          <tr>
                             <th>栏目副标题</th>
                            <td>
                                <input type="text" class="form-control" id="input-name2" name="name2">
                            </td>
                        </tr>   						
						<tr>
                            <th>别名(英文+数字)<span class="form-required">*</span></th>
                            <td>
                                <input type="text" class="form-control" id="input-alias" name="alias">
                            </td>
                        </tr>
							
						<tr>
                            <th>关键字</th>
                            <td>
                                <input type="text" class="form-control" id="input-keywords" name="keywords">
                            </td>
                        </tr>						
						<tr>
                            <th>描述</th>
                            <td>
                                <textarea class="form-control" name="description"
                                    id="input-description"></textarea>
                            </td>
                        </tr>
							
						<tr>
                            <th>PC端banner</th>
                            <td>
                                <input type="hidden" name="more[thumbnail]" class="form-control"
                                    id="js-thumbnail-input">
                                <div>
                                    <a href="javascript:uploadOneImage('图片上传','#js-thumbnail-input');">
                                        <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png"
                                            id="js-thumbnail-input-preview" width="60" style="cursor: pointer" />
                                    </a>
                                </div>
                            </td>
                        </tr>												
						<tr>
                            <th>移动banner</th>
                            <td>
                                <input type="hidden" name="more[mbanner]" class="form-control"
                                    id="js-mbanner-input">
                                <div>
                                    <a href="javascript:uploadOneImage('图片上传','#js-mbanner-input');">
                                        <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png"
                                            id="js-mbanner-input-preview" width="60" style="cursor: pointer" />
                                    </a>
                                </div>
                            </td>
                        </tr>	
					<?php if($type == 'channel'): ?>	
						<tr>
                            <th>频道页模板<span class="form-required">*</span></th>
                            <td>
                                <select class="form-control" name="channeltpl" id="input-channeltpl">
                                    <?php if(is_array($channel_theme_files) || $channel_theme_files instanceof \think\Collection || $channel_theme_files instanceof \think\Paginator): if( count($channel_theme_files)==0 ) : echo "" ;else: foreach($channel_theme_files as $key=>$vo): $value=preg_replace('/^cms\//','',$vo['file']); ?>
                                        <option value="<?php echo $value; ?>"><?php echo $vo['name']; ?> <?php echo $vo['file']; ?>.html</option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </td>
                        </tr>	
					<?php endif; if($type == 'list'): ?>	
						
						<tr>
                            <th>列表页模板<span class="form-required">*</span></th>
                            <td>
                                <select class="form-control" name="listtpl" id="input-listtpl">
                                    <?php if(is_array($list_theme_files) || $list_theme_files instanceof \think\Collection || $list_theme_files instanceof \think\Paginator): if( count($list_theme_files)==0 ) : echo "" ;else: foreach($list_theme_files as $key=>$vo): $value=preg_replace('/^cms\//','',$vo['file']); ?>
                                        <option value="<?php echo $value; ?>"><?php echo $vo['name']; ?> <?php echo $vo['file']; ?>.html</option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </td>
                        </tr>								
						<tr>
                            <th>详情页模板<span class="form-required">*</span></th>
                            <td>
                                <select class="form-control" name="showtpl" id="input-showtpl">
                                    <?php if(is_array($article_theme_files) || $article_theme_files instanceof \think\Collection || $article_theme_files instanceof \think\Paginator): if( count($article_theme_files)==0 ) : echo "" ;else: foreach($article_theme_files as $key=>$vo): $value=preg_replace('/^cms\//','',$vo['file']); ?>
                                        <option value="<?php echo $value; ?>"><?php echo $vo['name']; ?> <?php echo $vo['file']; ?>.html</option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </td>
                        </tr>	
					<?php endif; if($type == 'link'): ?>
						<tr>
                            <th>外部链接</th>
                            <td>
                                <input type="text" class="form-control" id="input-outlink" name="outlink">
                            </td>
                        </tr>
					<?php endif; ?>

						<tr>
                            <th>SEO标题</th>
                            <td>
                                <input type="text" class="form-control"  name="more[seotitle]">
                            </td>
                        </tr>	
						<tr>
                            <th>SEO关键字</th>
                            <td>
                                <input type="text" class="form-control" name="more[seokeyword]">
                            </td>
                        </tr>						
						<tr>
                            <th>SEO描述</th>
                            <td>
                                <textarea class="form-control" name="more[seodescription]"></textarea>
                            </td>
                        </tr>							
						
						</tbody>
					</table>
                    
					<div class="form-group" style="margin-top:15px;">
                        <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('ADD'); ?></button>
                        <a class="btn btn-default" href="<?php echo url('AdminChannel/index'); ?>"><?php echo lang('BACK'); ?></a>
                    </div>
					
					</form>
					

                </div>

            </div>
			
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/static/js/admin.js"></script>
</body>

<script type="text/javascript" >
var url = window.location.pathname;
$("#input-type").change(function(){
	
	window.location = url + '?type=' + $(this).val();

});

</script>

</html>