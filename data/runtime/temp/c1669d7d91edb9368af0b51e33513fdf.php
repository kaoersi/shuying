<?php /*a:2:{s:83:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/cms/admin_archives/add.html";i:1637739333;s:74:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/public/header.html";i:1627524563;}*/ ?>
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
   <link href="/themes/admin_simpleboot3/public/assets/js/select2.min.css" rel="stylesheet">
<script src="/themes/admin_simpleboot3/public/assets/js/select2.min.js"></script>
<style type="text/css">
    .pic-list li {
        margin-bottom: 5px;
    }
.table>tbody>tr>th{width:100px;}
</style>

<!-- <script type="text/html" id="photos-item-tpl">
    <li id="saved-image{id}">
        <input id="photo-{id}" type="hidden" name="photo_urls[]" value="{filepath}">
        <input class="form-control" id="photo-{id}-name" type="text" name="photo_names[]" value="{name}"
               style="width: 200px;" title="图片名称">
        <img id="photo-{id}-preview" src="{url}" style="height:36px;width: 36px;"
             onclick="imagePreviewDialog(this.src);">
        <a href="javascript:uploadOneImage('图片上传','#photo-{id}');">替换</a>
        <a href="javascript:(function(){$('#saved-image{id}').remove();})();">移除</a>
    </li>
</script>
<script type="text/html" id="files-item-tpl">
    <li id="saved-file{id}">
        <input id="file-{id}" type="hidden" name="file_urls[]" value="{filepath}">
        <input class="form-control" id="file-{id}-name" type="text" name="file_names[]" value="{name}"
               style="width: 200px;" title="文件名称">
        <a id="file-{id}-preview" href="{preview_url}" target="_blank">下载</a>
        <a href="javascript:uploadOne('文件上传','#file-{id}','file');">替换</a>
        <a href="javascript:(function(){$('#saved-file{id}').remove();})();">移除</a>
    </li>
</script> -->





</head>

<body>
    <div class="wrap js-check-wrap">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo url('AdminArchives/index',array('category'=>$cid)); ?>">文章管理</a></li>
            <li class="active"><a href="<?php echo url('AdminArchives/add'); ?>">添加文章</a></li>
            <li><a href="<?php echo url('AdminArchives/recyclebin'); ?>">回收站</a></li>
        </ul>
        <form action="<?php echo url('AdminArchives/addPost'); ?>" method="post" class="form-horizontal margin-top-20">
            <div class="row">
                <div class="col-md-9">
                    <table class="table table-bordered" style="margin-bottom: -1px;">
                        <tr>
                            <th width="100">分类<span class="form-required">*</span></th>
                            <td>
                                <select class="form-control" name="post[channel_id]" id="c-channel_id">
                                    <?php echo (isset($category_tree) && ($category_tree !== '')?$category_tree:''); ?>
                                </select>
                                <!-- <input class="form-control" type="text" style="width:400px;" required value=""
                                   placeholder="请选择分类" onclick="doSelectCategory();" id="js-categories-name-input"
                                   readonly/>
                            <input class="form-control" type="hidden" value="" name="post[channel_id]"
                                   id="js-categories-id-input"/> -->
                            </td>
                        </tr>
                        <tr>
                            <th>标题<span class="form-required">*</span></th>
                            <td>
                                <input class="form-control" type="text" name="post[title]" id="title" required value=""
                                    placeholder="请输入标题" />
                            </td>
                        </tr>

                        <tr>
                            <th>别名<span class="form-required"></span></th>
                            <td>
                                <input class="form-control" type="text" name="post[rw_title]" id="rw_title" required value=""
                                    placeholder="请输入标题" />
                            </td>
                        </tr>

                        <tr>
                            <th>SEO标题</th>
                            <td>
                                <input class="form-control" type="text" name="post[seotitle]" id="seotitle" value=""
                                    placeholder="请输入SEO标题">
                            </td>
                        </tr>
                        <tr>
                            <th>关键字</th>
                            <td>
                                <select class="form-control" id="id_select2_demo1" multiple="multiple" name="post_new[keywords][]">
                                    <option value="">-----单选-----</option>
                                </select>
                            </td>
                        </tr>
                        <!-- <tr>
                        <th>文章来源</th>
                        <td><input class="form-control" type="text" name="post[post_source]" id="source" value=""
                                   placeholder="请输入文章来源"></td>
                    </tr> -->
                        <tr>
                            <th>描述</th>
                            <td>
                                <textarea class="form-control" name="post[description]" style="height: 50px;"
                                    placeholder="请填写描述"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>内容<span class="form-required">*</span></th>
                            <td>
                                <script type="text/plain" id="content" name="post[content]"></script>
                            </td>
                        </tr>

                        <?php if($cid == 25 || $cid == 37 || $cid == 38 || $cid == 56 || $cid == 57 || $cid == 58 || $cid == 59 || $cid == 60 || $cid == 61 || $cid == 41 || $cid == 52 || $cid == 53 || $cid == 54 || $cid == 55): ?>
                            <tr>
                                <th width="100">百度API推送<span class="form-required">*</span></th>
                                <td>
                                    <select class="form-control" name="post[baidu_id]">
                                        <option value="2">不推送</option>
                                        <option value="1">百度普通推送</option>
                                        <!--<option value="1">百度快速推送</option>-->
                                    </select>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                    <div id="extend">
                        <table class="table table-bordered">
                        </table>
                    </div>
                    <div id="extend_upload">
                    </div>
                    <?php 
    \think\facade\Hook::listen('cms_admin_article_edit_view_main',null,false);
 ?>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('ADD'); ?></button>
                            <a class="btn btn-default" href="<?php echo url('AdminArchives/index'); ?>"><?php echo lang('BACK'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <table class="table table-bordered">
                        <tr>
                            <th><b>缩略图</b></th>
                        </tr>
                        <tr>
                            <td>
                                <div style="text-align: center;">
                                    <input type="hidden" name="post[more][thumbnail]" id="thumbnail" value="">
                                    <a href="javascript:uploadOneImage('图片上传','#thumbnail');">
                                        <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png"
                                            id="thumbnail-preview" width="135" style="cursor: pointer" />
                                    </a>
                                    <input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片">
                                </div>
                            </td>
                        </tr>
						
						<tr>
                             <th>推荐</th>
						</tr>

						<tr>
                            <td>
                                <input type="radio" name="post[is_top]" value="1"  >
                                是                                        &nbsp;&nbsp;
                                <input type="radio" name="post[is_top]" value="0" checked="" >
                                否                                    
                            </td>
                        </tr>
						
                        <tr>
                            <th><b>发布时间</b></th>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control js-bootstrap-datetime" type="text" name="post[published_time]" value="<?php echo date('Y-m-d H:i:s',time()); ?>">
                            </td>
                        </tr>
                    </table>
                    <?php 
    \think\facade\Hook::listen('cms_admin_archives_edit_view_right_sidebar',null,false);
 ?>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="/static/js/admin.js"></script>
    <script type="text/javascript">
        //编辑器路径定义
        var editorURL = GV.WEB_ROOT;
    </script>
    <script type="text/javascript" src="/static/js/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/static/js/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript">
        $(function () {

            editorcontent = new baidu.editor.ui.Editor();
            editorcontent.render('content');
            try {
                editorcontent.sync();
            } catch (err) {
            }

            $('.btn-cancel-thumbnail').click(function () {
                $('#thumbnail-preview').attr('src', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png');
                $('#thumbnail').val('');
            });

            //初始值
            init($('#c-channel_id').val());
		
		})
    </script>
	
	    <script>

        $(function () {
            //赋值
            $('#c-channel_id').val("<?php echo $cid; ?>");
            init("<?php echo $cid; ?>");
        })
   
    $('#id_select2_demo1').select2({
      placeholder: '请选择，最多选择10个',
    allowClear: true,
    maximumSelectionLength:10,
    maximumInputLength: 40,    
    tags:true,
    ajax: {
      url: "/cms/admin_tags/postlistjson",
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          search: params.term,
           type:'1',
        };
      },
      processResults: function (data) {
        return {
          results: data.list
        };
      },
      cache: true
    },
    minimumInputLength: 2




});

        
    </script>
	
    <script type="text/javascript" src="/themes/admin_simpleboot3/cms/js/admin_archives_add.js?v=1.0.3"></script>
</body>

</html>