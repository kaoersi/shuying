<?php /*a:1:{s:72:"/www/wwwroot/www.shuyingjp.com/themes/admin_simpleboot3/admin/login.html";i:1627524523;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>蓝杉互动后台管理系统</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!-- CSS Files -->
    <link href="/themes/admin_simpleboot3/public/assets/login/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/themes/admin_simpleboot3/public/assets/login/css/now-ui-kit.css" rel="stylesheet" />

    
</head>

<body class="login-page sidebar-collapse">

    <div class="page-header" filter-color="orange">
        <div class="page-header-image" style="background-image:url(/themes/admin_simpleboot3/public/assets/login/images/login.jpg)"></div>
        <div class="container">
            <div class="col-md-4 content-center">
                <div class="card card-login card-plain">
                    <form class="form js-ajax-form" method="post" action="<?php echo url('public/doLogin'); ?>">
                        <div class="header header-primary text-center">
                            <div class="logo-container">
                                <img src="/themes/admin_simpleboot3/public/assets/login/images/logo.png" alt="">
                            </div>
                        </div>
                        <div class="content">
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons users_circle-08"></i>
                                </span>
                                <input type="text" id="input_username" name="username" class="form-control" placeholder="用户名" title="<?php echo lang('USERNAME_OR_EMAIL'); ?>"
                               value="<?php echo cookie('admin_username'); ?>" data-rule-required="true" data-msg-required="">
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons objects_key-25"></i>
                                </span>
                                <input type="password" placeholder="密码" class="form-control" name="password"
                               placeholder="<?php echo lang('PASSWORD'); ?>" title="<?php echo lang('PASSWORD'); ?>" data-rule-required="true"
                               data-msg-required=""/>
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons text_caps-small"></i>
                                </span>
                                <input type="text" name="captcha" placeholder="验证码" class="form-control" />
								<?php $__CAPTCHA_SRC=url('/new_captcha').'?height=46&width=120&font_size=18'; ?>
<img src="<?php echo $__CAPTCHA_SRC; ?>" onclick="this.src='<?php echo $__CAPTCHA_SRC; ?>&time='+Math.random();" title="换一张" class="captcha captcha-img verify_img" style="cursor: pointer;position:absolute;right:0;top:0;z-index:999;border-radius: 0 30px 30px 0;"/>
<input type="hidden" name="_captcha_id" value="">
                            </div>
                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block js-ajax-submit" data-loadingmsg="<?php echo lang('LOADING'); ?>">登录</button>
                        </div>
                        <div class="text-center">
                            <h6> 
                                <a href="javascript:;" class="link" id="forget-password">忘记密码？</a>
                            </h6>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
          
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>蓝杉北京网站建设公司
                </div>
            </div>
        </footer>
    </div>
</body>
<script type="text/javascript">
    //全局变量
    var GV = {
        ROOT: "/",
        WEB_ROOT: "/",
        JS_ROOT: "static/js/",
        APP: ''/*当前应用名*/
    };
</script>
<script src="/themes/admin_simpleboot3/public/assets/js/jquery-1.10.2.min.js"></script>
<script src="/themes/admin_simpleboot3/public/assets/login/layer/layer.js"></script>
<script src="/static/js/wind.js"></script>
<script src="/static/js/admin.js"></script>
<script type="text/javascript">
$("input").focus(function(){
	$(this).parent().addClass("input-group-focus");
});
$("input").blur(function(){
	$(this).parent().removeClass("input-group-focus");
});

$('#forget-password').click(function(){
layer.alert('忘记密码请致电xxxxxxxxx,蓝杉互动售后人员将为您解决', {icon: 6});

})

</script>
</html>