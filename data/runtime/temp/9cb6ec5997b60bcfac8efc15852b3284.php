<?php /*a:2:{s:81:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/cms/admin_tags/index.html";i:1627524733;s:74:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/public/header.html";i:1627524563;}*/ ?>
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
            <li class="active" ><a href="javascript:void(0);">文章标签管理</a></li>
        <li><a href="<?php echo url('AdminTags/add'); ?>">添加标签</a></li>
        </ul>
        <div style="padding: 10px 15px; background: #e8edf0;">用于管理文章关联的标签,标签的添加在添加文章时自动维护,无需手动添加标签



        </div>

                <form class="well form-inline margin-top-20" method="post" action="<?php echo url('AdminTags/index'); ?>" id="myform">
  排序方式
        <select class="form-control  select-list" name="px" style="width:250px;">
            <option value='1'  <?php if(input('request.px') == '1'): ?>selected="selected" <?php endif; ?>>按照时间-降序排序</option>
             <option value='2'  <?php if(input('request.px') == '2'): ?>selected="selected" <?php endif; ?>>按照时间-升序排序</option>
            <option value='3'  <?php if(input('request.px') == '3'): ?>selected="selected" <?php endif; ?>>按照文档数量-降序排序</option>
            <option value='4'  <?php if(input('request.px') == '4'): ?>selected="selected" <?php endif; ?>>按照文档数量-升排序</option>
        </select> &nbsp;&nbsp;

        <?php 
if(empty(input('request.row'))){
 $row='';
}else{
  $row=input('request.row');
}
if(empty(input('request.diy_row'))){
 $diy_row='';
}else{
  $diy_row=input('request.diy_row');
}
 ?>
       <select  class="form-control select-list" name="row" style="width: 120px;">
        <option value=''>每页条数</option>
        <option value='10' <?php if(input('request.row') == '10'): ?>selected="selected" <?php endif; ?>>10条</option>
        <option value='20' <?php if(input('request.row') == '20'): ?>selected="selected" <?php endif; ?>>20条</option>
        <option value='30' <?php if(input('request.row') == '30'): ?>selected="selected" <?php endif; ?>>30条</option>
        <option value='50' <?php if(input('request.row') == '50'): ?>selected="selected" <?php endif; ?>>50条</option>
        <option value='100' <?php if(input('request.row') == '100'): ?>selected="selected" <?php endif; ?>>100条</option>
        <option value='500' <?php if(input('request.row') == '500'): ?>selected="selected" <?php endif; ?>>500条</option>
        <option value='diy_row' <?php if($row == 'diy_row'): ?>selected<?php endif; ?>>自定义</option>
      </select> &nbsp;&nbsp;
  
      <?php if($row == 'diy_row'): ?>
      <input id="diy_row" type="text"  class="form-control"  name="diy_row" value="<?php echo $diy_row; ?>" placeholder="请输入条数">&nbsp;&nbsp;
      <?php endif; ?>

        <input type="text" class="form-control" name="keyword" style="width: 280px;"
               value="<?php echo input('request.keyword'); ?>"  placeholder="请输入标签名称或标签关键字">
        <input type="submit" class="btn btn-primary" value="搜索"/>
        <a class="btn btn-danger" href="<?php echo url('AdminTags/index'); ?>">清空</a>
    </form>


        <form method="post" class="js-ajax-form margin-top-20">
            <div class="table-actions">
               <button class="btn btn-sm btn-danger js-ajax-submit" type="submit"
                    data-action="/cms/admin_tags/batch_edit/id/1.html" data-subcheck="true">批量修正标签(不勾选默认修正所有)
            </button>
           


            </div>
            <table class="table table-hover table-bordered table-list">
                <thead>
                    <tr>
                       <th width="16"><label><input type="checkbox" class="js-check-all" data-direction="x"
                                             data-checklist="js-check-x"></label></th>
                        <th width="50">ID</th>
                         <th>标签所属类别</th>
                        <th>标签名称</th>
                        <th>文档数量</th>
                        <th width="250">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): if( count($tags)==0 ) : echo "" ;else: foreach($tags as $key=>$vo): ?>
                        <tr>
                           <td><input type="checkbox" class="js-check" data-yid="js-check-y" data-xid="js-check-x" name="ids[]"
                               value="<?php echo $vo['id']; ?>"></td>  
                            <td><?php echo $vo['id']; ?></td>
                             <td>
                                <?php if($vo['type'] == 3): ?>
                              留学资讯
                            <?php elseif($vo['type'] == 2): ?>
                           问答
                            <?php else: ?>
                            文章
                            <?php endif; ?>  

                             </td>
                            <td><?php echo $vo['name']; ?></td>
                            <td><?php echo $vo['nums']; ?></td>
                            <td>

                             <a class="btn btn-xs btn-primary" href="<?php echo url('AdminTags/edit',array('id'=>$vo['id'])); ?>">编辑校准</a>

                           <!--   <?php if($vo['type'] == 3): ?>
                             <a class="btn btn-xs btn-primary" href="/tag/<?php echo $vo['id']; ?>.html" target="_blank">预览</a>
                                                       <?php elseif($vo['type'] == 2): ?>
                                                       <a class="btn btn-xs btn-primary" href="/asktag/<?php echo $vo['id']; ?>.html" target="_blank">预览</a>
                                                       <?php else: ?>
                                                       
                                                       <?php endif; ?> -->
                                <a class="btn btn-xs btn-danger js-ajax-delete"
                                    href="<?php echo url('AdminTags/delete',['id'=>$vo['id']]); ?>">删除</a>

                            </td>
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
              <tfoot>
                    <tr>
                      <th width="16"><label><input type="checkbox" class="js-check-all" data-direction="x"
                                             data-checklist="js-check-x"></label></th>
                        <th width="50">ID</th>
                          <th>标签所属类别</th>
                        <th>标签名称</th>
                        <th>文档数量</th>
                        <th width="250">操作</th>
                    </tr>
                </tfoot>
            </table>
            <div class="table-actions">
                <!--<button type="submit" class="btn btn-primary btn-sm js-ajax-submit"><?php echo lang('SORT'); ?></button>-->
            </div>
        </form>
        <ul class="pagination"><?php echo (isset($page) && ($page !== '')?$page:''); ?></ul>
    </div>
    <script src="/static/js/admin.js"></script>
</body>

</html>
<script type="text/javascript">
$(function() {
$(".select-list").change(function() {
  $("#myform").submit();
});
});
</script>