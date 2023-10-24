<?php /*a:2:{s:84:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/cms/admin_archives/edit.html";i:1637740031;s:74:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/public/header.html";i:1627524563;}*/ ?>
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
.upload_img{
width: 60px;
    height: 60px;
    display: inline-block;
    background: url(/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png);
    background-size: contain;
}
</style>
<script type="text/html" id="photos-item-tpl">
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
</script>
</head>

<body>
    <div class="wrap js-check-wrap">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo url('AdminArchives/index',array('category'=>$post['channel_id'])); ?>">文章管理</a></li>
            <li>
                <a href="<?php echo url('AdminArchives/add',array('cid'=>$post['channel_id'])); ?>">添加文章</a>
            </li>
            <li class="active"><a href="#">编辑文章</a></li>
            <li><a href="<?php echo url('AdminArchives/recyclebin'); ?>">回收站</a></li>
        </ul>
        <form action="<?php echo url('AdminArchives/editPost'); ?>" method="post"
            class="form-horizontal margin-top-20">
            <div class="row">
                <div class="col-md-9">
                    <table class="table table-bordered" style="margin-bottom: -1px;">
                        <tr>
                            <th width="100">分类<span class="form-required">*</span></th>
                            <td>
                                <select class="form-control" name="post[channel_id]" id="c-channel_id">
                                    <?php echo (isset($category_tree) && ($category_tree !== '')?$category_tree:''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>标题<span class="form-required">*</span></th>
                            <td>
                                <input id="post-id" type="hidden" name="post[id]" value="<?php echo $post['id']; ?>">
                                <input class="form-control" type="text" name="post[title]" required
                                    value="<?php echo $post['title']; ?>" placeholder="请输入标题" />
                            </td>
                        </tr>
                        <tr>
                            <th>别名<span class="form-required"></span></th>
                            <td>
                                <input id="post-id" type="hidden" name="post[id]" value="<?php echo $post['id']; ?>">
                                <input class="form-control" type="text" name="post[rw_title]" required
                                    value="<?php echo $post['rw_title']; ?>" placeholder="请输入别名" />
                            </td>
                        </tr>
                        <tr>
                            <th>SEO标题</th>
                            <td>
                                <input class="form-control" type="text" name="post[seotitle]" id="seotitle" value="<?php echo $post['seotitle']; ?>"
                                    placeholder="请输入SEO标题">
                            </td>
                        </tr>
                        <tr>
                            <th>关键字</th>
                            <td>

                            <select class="form-control" id="id_select2_demo1" multiple="multiple" name="post_new[keywords][]">
                                <option value="">-----单选-----</option>
                                <?php echo $option_str; ?>
                            </select>

                            </td>
                        </tr>
                        <tr>
                            <th>描述</th>
                            <td>
                                <textarea class="form-control" name="post[description]" style="height: 50px;"
                                    placeholder="请填写摘要"><?php echo $post['description']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>内容<span class="form-required">*</span></th>
                            <td>
                                <script type="text/plain" id="content" name="post[content]"><?php echo $post['content']; ?></script>
                            </td>
                        </tr>
                        <?php if($post['channel_id'] == 25 || $post['channel_id'] == 37 || $post['channel_id'] == 38 || $post['channel_id'] == 56 || $post['channel_id'] == 57 || $post['channel_id'] == 58 || $post['channel_id'] == 59 || $post['channel_id'] == 60 || $post['channel_id'] == 61 || $post['channel_id'] == 41 || $post['channel_id'] == 52 || $post['channel_id'] == 53 || $post['channel_id'] == 54 || $post['channel_id'] == 55): ?>
                            <tr>
                                <th width="100">百度API推送<span class="form-required">*</span></th>
                                <td>
                                    <select class="form-control" name="post[baidu_id]" <?php if($post['baidu_id'] == 0 || $post['baidu_id']==1): ?> disabled="disabled"<?php endif; ?>>
                                        <option value="2" <?php if($post['baidu_id'] == 2): ?>selected='selected'<?php endif; ?>>不推送</option>
                                        <option value="0" <?php if($post['baidu_id'] == 0): ?>selected='selected'<?php endif; ?>>百度普通推送</option>
                                        <!--<option value="1" <?php if($post['baidu_id'] == 1): ?>selected='selected'<?php endif; ?>>百度快速推送</option>-->
                                    </select>
                                    <!-- <input class="form-control" type="text" style="width:400px;" required value=""
                                       placeholder="请选择分类" onclick="doSelectCategory();" id="js-categories-name-input"
                                       readonly/>
                                        <input class="form-control" type="hidden" value="" name="post[channel_id]"
                                       id="js-categories-id-input"/> -->
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
    \think\facade\Hook::listen('cms_admin_archives_edit_view_main',null,false);
 ?>
                </div>
                <div class="col-md-3">
                    <table class="table table-bordered">
                        <tr>
                            <th>缩略图</th>
                        </tr>
                        <tr>
                            <td>
                                <div style="text-align: center;">
                                    <input type="hidden" name="post[more][thumbnail]" id="thumbnail"
                                        value="<?php echo (isset($post['more']['thumbnail']) && ($post['more']['thumbnail'] !== '')?$post['more']['thumbnail']:''); ?>">
                                    <a href="javascript:uploadOneImage('图片上传','#thumbnail');">
                                        <?php if(empty($post['more']['thumbnail'])): ?>
                                            <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png"
                                                id="thumbnail-preview" width="135" style="cursor: pointer" />
                                            <?php else: ?>
                                            <img src="<?php echo cmf_get_image_preview_url($post['more']['thumbnail']); ?>"
                                                id="thumbnail-preview" width="135" style="cursor: pointer" />
                                        <?php endif; ?>
                                    </a>
                                    <input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>发布时间</th>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control js-bootstrap-datetime" type="text" name="post[published_time]"
                                    value="<?php echo date('Y-m-d H:i',$post['published_time']); ?>">
                            </td>
                        </tr>
						
						<?php 
                                $status_yes=$post['status']=='1'?"checked":"";

								$istop_yes=$post['is_top']=='1'?"checked":"";
                                $istop_no=$post['is_top']=='0'?"checked":"";
                         ?>
						
						<tr>
                                    <th>推荐</th>
						</tr>
						<tr>
                        <td>
                            <input type="radio" name="post[is_top]" value="1" <?php echo $istop_yes; ?> >是&nbsp;&nbsp;
                            <input type="radio" name="post[is_top]" value="0" <?php echo $istop_no; ?> >否</td>
                        </tr>
						
                        <!--
                    <tr>
                        <th>评论</th>
                    </tr>
                    <tr>
                        <td>
                            <label style="width: 88px"><a
                                    href="javascript:openIframeDialog('<?php echo url('comment/commentadmin/index',array('post_id'=>$post['id'])); ?>','评论列表')">查看评论</a></label>
                        </td>
                    </tr>
                    -->
                        <tr>
                            <th>状态</th>
                            
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="post-status-checkbox" name="post[status]"
                                            value="1" <?php echo $status_yes; ?>>发布
                                        <span id="post-status-error" style="color: red;display: none"></span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <?php 
    \think\facade\Hook::listen('cms_admin_archives_edit_view_right_sidebar',null,false);
 ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('SAVE'); ?></button>
                    <a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
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

            $('#more-template-select').val("<?php echo (isset($post['more']['template']) && ($post['more']['template'] !== '')?$post['more']['template']:''); ?>");
        });

        // function doSelectCategory() {
        //     var selectedCategoriesId = $('#js-categories-id-input').val();
        //     openIframeLayer("<?php echo url('AdminChannel/select'); ?>?ids=" + selectedCategoriesId, '请选择分类', {
        //         area: ['700px', '400px'],
        //         btn: ['确定', '取消'],
        //         yes: function (index, layero) {
        //             //do something

        //             var iframeWin = window[layero.find('iframe')[0]['name']];
        //             var selectedCategories = iframeWin.confirm();
        //             if (selectedCategories.selectedCategoriesId.length == 0) {
        //                 layer.msg('请选择分类');
        //                 return;
        //             }
        //             $('#js-categories-id-input').val(selectedCategories.selectedCategoriesId.join(','));
        //             $('#js-categories-name-input').val(selectedCategories.selectedCategoriesName.join(' '));
        //             //console.log(layer.getFrameIndex(index));
        //             layer.close(index); //如果设定了yes回调，需进行手工关闭
        //         }
        //     });
        // }
    </script>

    <script>

        var publishYesUrl = "<?php echo url('AdminArchives/publish',array('yes'=>1)); ?>";
        var publishNoUrl = "<?php echo url('AdminArchives/publish',array('no'=>1)); ?>";
        // var topYesUrl = "<?php echo url('AdminArchives/top',array('yes'=>1)); ?>";
        // var topNoUrl = "<?php echo url('AdminArchives/top',array('no'=>1)); ?>";
        // var recommendYesUrl = "<?php echo url('AdminArchives/recommend',array('yes'=>1)); ?>";
        // var recommendNoUrl = "<?php echo url('AdminArchives/recommend',array('no'=>1)); ?>";

        var postId = $('#post-id').val();

        //发布操作
        $("#post-status-checkbox").change(function () {
            if ($('#post-status-checkbox').is(':checked')) {
                //发布
                $.ajax({
                    url: publishYesUrl, type: "post", dataType: "json", data: { ids: postId }, success: function (data) {
                        if (data.code != 1) {
                            $('#post-status-checkbox').removeAttr("checked");
                            $('#post-status-error').html(data.msg).show();

                        } else {
                            $('#post-status-error').hide();
                        }
                    }
                });
            } else {
                //取消发布
                $.ajax({
                    url: publishNoUrl, type: "post", dataType: "json", data: { ids: postId }, success: function (data) {
                        if (data.code != 1) {
                            $('#post-status-checkbox').prop("checked", 'true');
                            $('#post-status-error').html(data.msg).show();
                        } else {
                            $('#post-status-error').hide();
                        }
                    }
                });
            }
        });

        // //置顶操作
        // $("#is-top-checkbox").change(function () {
        //     if ($('#is-top-checkbox').is(':checked')) {
        //         //置顶
        //         $.ajax({
        //             url: topYesUrl, type: "post", dataType: "json", data: { ids: postId }, success: function (data) {
        //                 if (data.code != 1) {
        //                     $('#is-top-checkbox').removeAttr("checked");
        //                     $('#is-top-error').html(data.msg).show();

        //                 } else {
        //                     $('#is-top-error').hide();
        //                 }
        //             }
        //         });
        //     } else {
        //         //取消置顶
        //         $.ajax({
        //             url: topNoUrl, type: "post", dataType: "json", data: { ids: postId }, success: function (data) {
        //                 if (data.code != 1) {
        //                     $('#is-top-checkbox').prop("checked", 'true');
        //                     $('#is-top-error').html(data.msg).show();
        //                 } else {
        //                     $('#is-top-error').hide();
        //                 }
        //             }
        //         });
        //     }
        // });
        // //推荐操作
        // $("#recommended-checkbox").change(function () {
        //     if ($('#recommended-checkbox').is(':checked')) {
        //         //推荐
        //         $.ajax({
        //             url: recommendYesUrl, type: "post", dataType: "json", data: { ids: postId }, success: function (data) {
        //                 if (data.code != 1) {
        //                     $('#recommended-checkbox').removeAttr("checked");
        //                     $('#recommended-error').html(data.msg).show();

        //                 } else {
        //                     $('#recommended-error').hide();
        //                 }
        //             }
        //         });
        //     } else {
        //         //取消推荐
        //         $.ajax({
        //             url: recommendNoUrl, type: "post", dataType: "json", data: { ids: postId }, success: function (data) {
        //                 if (data.code != 1) {
        //                     $('#recommended-checkbox').prop("checked", 'true');
        //                     $('#recommended-error').html(data.msg).show();
        //                 } else {
        //                     $('#recommended-error').hide();
        //                 }
        //             }
        //         });
        //     }
        // });
    </script>
    <script type="text/javascript" src="/themes/admin_simpleboot3/cms/js/admin_archives_edit.js?v=1.0.3"></script>
    <script>

        $(function () {
            //赋值
            $('#c-channel_id').val("<?php echo $post['channel_id']; ?>");
            init("<?php echo $post['channel_id']; ?>");
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
 
    $("#id_select2_demo1").val([<?php echo $keyword_idstr;?>]).trigger("change");

    </script>
</body>

</html>