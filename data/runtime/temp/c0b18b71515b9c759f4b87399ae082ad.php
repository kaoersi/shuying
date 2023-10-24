<?php /*a:7:{s:70:"/www/wwwroot/www.shuyingjp.com/themes/default/cms/list_mxalk_case.html";i:1635142486;s:67:"/www/wwwroot/www.shuyingjp.com/themes/default/public/headertop.html";i:1635475802;s:64:"/www/wwwroot/www.shuyingjp.com/themes/default/public/header.html";i:1638498801;s:68:"/www/wwwroot/www.shuyingjp.com/themes/default/public/header_mob.html";i:1635414385;s:76:"/www/wwwroot/www.shuyingjp.com/themes/default/public/banner_search_item.html";i:1634730291;s:64:"/www/wwwroot/www.shuyingjp.com/themes/default/public/footer.html";i:1635492068;s:66:"/www/wwwroot/www.shuyingjp.com/themes/default/public/footerjs.html";i:1635491960;}*/ ?>
<!DOCTYPE html>
<html>
	   <head>
        <meta charset="UTF-8">
        <title><?php if(empty($category['more']['seotitle']) || (($category['more']['seotitle'] instanceof \think\Collection || $category['more']['seotitle'] instanceof \think\Paginator ) && $category['more']['seotitle']->isEmpty())): ?><?php echo $category['name']; else: ?><?php echo $category['more']['seotitle']; ?><?php endif; ?>_<?php if(empty($site_info['site_seo_title']) || (($site_info['site_seo_title'] instanceof \think\Collection || $site_info['site_seo_title'] instanceof \think\Paginator ) && $site_info['site_seo_title']->isEmpty())): ?><?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:''); else: ?><?php echo (isset($site_info['site_seo_title']) && ($site_info['site_seo_title'] !== '')?$site_info['site_seo_title']:''); ?><?php endif; ?></title>
        <meta name="keywords" content="<?php echo $category['more']['seokeyword']; ?>"/>
        <meta name="description" content="<?php echo $category['more']['seodescription']; ?>"/>
    		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/public/css/common.css" />
		<link rel="stylesheet" href="/public/css/animate.min.css" />
		<link rel="stylesheet" href="/public/css/style.css" />
		<link rel="stylesheet" href="/public/css/swiper.min.css" />
		<link rel="stylesheet" href="/public/css/jsmodern-1.1.1.min.css" />
		<script type="text/javascript" src="/public/js/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="/public/js/swiper.min.js"></script>
		<script type="text/javascript" src="/public/js/swiper.animate1.0.3.min.js"></script>
		<!--[if lt IE 9]>
		    <script src="/public/js/html5shiv.min.js"></script>
		    <script src="/public/js/respond.min.js"></script>
		<![endif]-->				
		<link type="text/css" rel="stylesheet" href="/public//css/jquery.mmenu.css" />
		<script type="text/javascript" src="/public//js/jquery.mmenu.js"></script>	
    </head>
	<body>
    	
	<header class="header hidden-xs hidden-sm">
		<div class="wrapper"><a href="https://www.shuyingjp.com/" class="logo" title="塾樱教育"><img src="/public/images/logo.png" alt="塾樱教育"></a>
			<?php if($category_parent['id'] != ''): $topid=$category_parent['id']; elseif($category['id'] != ''): $topid=$category['id']; else: $topid=0; ?>
			<?php endif; ?>
			<nav>
				<ul class="nav">
					<li <?php if($topid == 0): ?> class='active'<?php endif; ?>><a href="/" title="">首页</a></li>
					<?php
$cms_categories_data = \app\cms\service\ApiService::categories([
    'where'   => "",
    'order'   => 'list_order asc,id asc',
    'ids'     => [1,2,3,4,5,6,7,8]
]);

 if(is_array($cms_categories_data) || $cms_categories_data instanceof \think\Collection || $cms_categories_data instanceof \think\Paginator): $i = 0; $__LIST__ = $cms_categories_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

						<li <?php if($topid == $vo['id']): ?> class='active'<?php endif; ?>>
							
							<?php if($vo['type'] == 'page'): ?>
						    	<a href="<?php echo cmf_url('cms/Page/index',array('id'=>$vo['id'])); ?>" title="" target="_self" id="a_li_<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></a>
							<?php else: if($vo['id'] == '1' || $vo['id'] == '2' || $vo['id'] == '3'): ?>
									<a title="" target="_self" id="a_li_<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></a>
								<?php elseif($vo['id'] == '7'): ?>
									<a href="/news/" title="" target="_self" id="a_li_<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></a>
								<?php else: ?>
									<a href="<?php echo cmf_url('cms/List/index',array('id'=>$vo['id'])); ?>" title="" target="_self" id="a_li_<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></a>
								<?php endif; ?>
							<?php endif; 
								$toparr_submenu= Db::name('CmsChannel')->where(array('parent_id'=>$vo['id'],'status'=>'1'))->order('list_order asc,id asc')->select()->toArray();
								$second_count=count($toparr_submenu);
							 if($second_count > 0): ?>
								<dl>
									<?php if(is_array($toparr_submenu) || $toparr_submenu instanceof \think\Collection || $toparr_submenu instanceof \think\Paginator): if( count($toparr_submenu)==0 ) : echo "" ;else: foreach($toparr_submenu as $k1=>$vo2): if($vo2['id'] == 24): ?>
											<dd><a href="/zuixin/" title="最新资讯">最新资讯</a></dd>
										<?php elseif($vo2['id'] != 71): ?>
									 		<dd><a href="<?php echo cmf_url('cms/List/index',array('id'=>$vo2['id'])); ?>" title=""><?php echo $vo2['name']; ?></a></dd>
									 	<?php endif; ?>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</dl>
							<?php endif; ?>
						</li>
					
<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</nav>
			<span class="header_search search_top"></span>
			<span class="header-tel"></span>
		</div>
		<base target="-blank">
	</header>
	<?php 
		$slidelist3= Db::name('SlideItem')->where(array('slide_id'=>'3'))->select();
		$slidelist4= Db::name('SlideItem')->where(array('slide_id'=>'4'))->select();
		$slidelist5= Db::name('SlideItem')->where(array('slide_id'=>'5'))->select();
		$slidelist6= Db::name('SlideItem')->where(array('slide_id'=>'6'))->select();
	 ?>
	<div class="soso-show rel">
		<a href="javascript:void(0);" class="soso-close" title="">关闭</a>
		<div class="soso-con">
			<span>
				<form action="/cms/search/index" method="post"  name="site-search" id="site-search" >
					<input name="keyword" id="keyword_header" type="text" class="soso-text" placeholder="请输入要搜索的内容">
					<a class="soso-btn" href="javascript:void(0);" id="header-search-submit">search</a>
				</form>
			</span>
		</div>
	</div>
	<?php 
$ismobile2=cmf_is_mobile();
 if($ismobile2 != ''): ?>
	<div class="mobi-topNav visible-xs visible-sm clearfix">
        <div class="mobi-logo"><a href="/"><img src="/public/images/logo.png" alt="<?php echo $site_info['site_name']; ?>"></a></div>
        <div class="mobi_nav_default">
            <div class="mobi_navBar">
            	<a href="#menu_mob_nav">
                <div id="hamburger" class="protip">
                    <span></span>
                </div> 
                </a>
            </div>
        </div>
    </div>
    <div id="menu_mob_nav" class="hidden-xs">
		<ul>
			<li><a href="/">首页</a></li>
            <?php
$cms_categories_data = \app\cms\service\ApiService::categories([
    'where'   => "",
    'order'   => 'list_order asc,id asc',
    'ids'     => [1,2,3,4,5,6,7,8]
]);

 if(is_array($cms_categories_data) || $cms_categories_data instanceof \think\Collection || $cms_categories_data instanceof \think\Paginator): $i = 0; $__LIST__ = $cms_categories_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['type'] == 'page'): $typeurl=cmf_url('cms/Page/index',array('id'=>$vo['id']));  else: $typeurl=cmf_url('cms/List/index',array('id'=>$vo['id']));  ?>
	            <?php endif; ?>

				<li>
					<?php if($vo['id'] == '1' || $vo['id'] == '2' || $vo['id'] == '3' || $vo['id'] == '8'): ?>
						<a href="javascript:void(0);"><?php echo $vo['name']; ?></a>
					<?php else: ?>
						<a href="<?php echo $typeurl; ?>"><?php echo $vo['name']; ?></a>
					<?php endif; if(in_array($vo['id'],array('1','2','3','7','8'))): ?>
						<ul>
							<?php 
								$toparr_submenu= Db::name('CmsChannel')->where(array('parent_id'=>$vo['id'],'status'=>'1'))->order('id asc')->select()->toArray();
							 if(is_array($toparr_submenu) || $toparr_submenu instanceof \think\Collection || $toparr_submenu instanceof \think\Paginator): if( count($toparr_submenu)==0 ) : echo "" ;else: foreach($toparr_submenu as $k1=>$vo1): if($vo1['type'] == 'page'): $typeurl_two=cmf_url('cms/Page/index',array('id'=>$vo1['id']));  else: $typeurl_two=cmf_url('cms/List/index',array('id'=>$vo1['id']));  ?>
					            <?php endif; ?>

								<li>
									<a href="<?php echo $typeurl_two; ?>"><?php echo $vo1['name']; ?></a>

									<?php 
										$threearr_submenu= Db::name('CmsChannel')->where(array('parent_id'=>$vo1['id'],'status'=>'1'))->order('id asc')->select()->toArray();
									 if(count($threearr_submenu) != 0): ?>
										<ul>
											 <?php if(is_array($threearr_submenu) || $threearr_submenu instanceof \think\Collection || $threearr_submenu instanceof \think\Paginator): if( count($threearr_submenu)==0 ) : echo "" ;else: foreach($threearr_submenu as $k2=>$vo2): if($vo2['type'] == 'page'): $typeurl_three=cmf_url('cms/Page/index',array('id'=>$vo2['id']));  else: $typeurl_three=cmf_url('cms/List/index',array('id'=>$vo2['id']));  ?>
									            <?php endif; ?>
												<li><a href="<?php echo $typeurl_three; ?>"><?php echo $vo2['name']; ?></a>

											 <?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					<?php endif; ?>
				</li>
			
<?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
	</div>
<?php endif; ?>

<div class="banner banner_mxalk">
  
 <img src="/public/images/banner/banner_mxal_txt.png" class="banner_mxal_txt">
 <form action="/cms/search/index" method="post"  name="site-search-banner" id="site-search-banner" >
<div class="banner_mxal_box">
<div class="mxal_Bform">
<input type="text" name="keywordb" id="keyword_banner" value="" placeholder="请输入您要搜索的关键词">
<a href="javascript:void(0);" class="banner_btn_search" id="banner_btn_search">搜索</a>
</div>
   <div class="mxal_B_hot">
<?php 
$banner_search_arr= Db::name('CmsChannel')->where(array('parent_id'=>'1','status'=>'1'))->order('list_order asc,id asc')->select()->toArray();
 ?>
<p>阶段：
<?php if(is_array($banner_search_arr) || $banner_search_arr instanceof \think\Collection || $banner_search_arr instanceof \think\Paginator): if( count($banner_search_arr)==0 ) : echo "" ;else: foreach($banner_search_arr as $k1=>$vo1): ?>
<a href="<?php echo cmf_url('cms/List/index',array('id'=>$vo1['id'])); ?>" title="<?php echo $vo1['name']; ?>"><?php echo $vo1['name']; ?></a>
<?php endforeach; endif; else: echo "" ;endif; ?>
</p>
<p>专业：
 <?php
$cms_sub_categories_data = \app\cms\service\ApiService::subCategories(49);
 if(is_array($cms_sub_categories_data) || $cms_sub_categories_data instanceof \think\Collection || $cms_sub_categories_data instanceof \think\Paginator): $k = 0; $__LIST__ = $cms_sub_categories_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>

<a href="<?php echo cmf_url('cms/List/index',array('id'=>$vo['id'])); ?>" title="<?php echo $vo['name']; ?>"><?php echo $vo['name']; ?></a>
<?php endforeach; endif; else: echo "" ;endif; ?>
</p>
</div>
</div>
</form>
</div>
<div class="section_analyse bgf2f3f5 clearfix">
<div class="wrapper">
<div class="school_tit school_tit_analyse">案例分析<span> / ケース分析</span>
<div class="starcase_nav">
<a href="<?php echo cmf_url('cms/Abroad/listnew',array('id'=>1)); ?>" title="本科" <?php if($typeid == 1): ?>class="hover" <?php endif; ?>>本科</a>
<a href="<?php echo cmf_url('cms/Abroad/listnew',array('id'=>2)); ?>" title="研究生"<?php if($typeid == 2): ?>class="hover" <?php endif; ?>>研究生</a>
<a href="<?php echo cmf_url('cms/Abroad/listnew',array('id'=>3)); ?>" title="大学院"<?php if($typeid == 3): ?>class="hover" <?php endif; ?>>大学院 </a>
<a href="<?php echo cmf_url('cms/Abroad/listnew',array('id'=>4)); ?>" title="语言学校"<?php if($typeid == 4): ?>class="hover" <?php endif; ?>>语言学校 </a>
<a href="<?php echo cmf_url('cms/Abroad/listnew',array('id'=>5)); ?>" title="JLPT"<?php if($typeid == 5): ?>class="hover" <?php endif; ?>>JLPT</a>
</div>
</div>
 <div class="list-analyse-con clearfix">
                  <?php 
                   $case_fenxi= Db::name('CmsLxzk')->alias('a')
                                    ->where(function($query)use($typeid){
                  
                  if($typeid !=''){
                  $query->where('type_id','=',$typeid);
                  }else{
                  $query->where('type_id','=',1);
                  }

                  })->order('create_time desc')->paginate(25);


                      if(is_array($case_fenxi) || $case_fenxi instanceof \think\Collection || $case_fenxi instanceof \think\Paginator): if( count($case_fenxi)==0 ) : echo "" ;else: foreach($case_fenxi as $key=>$vo): ?>
                    <div class="analyse-slide">
                         <div class="progress-msg">
                         <a href="<?php echo cmf_url('cms/Abroad/index',array('id'=>$vo['id'])); ?>"> <img src="<?php echo get_img_url($vo['litpic']); ?>" class="self-pic" alt="<?php echo $vo['title']; ?>"></a>
                        <div  class="star_case_flower"><img src="/public/images/star_case_flower.png" alt="<?php echo $vo['title']; ?>"></div>
                          <div class="nikname"><?php echo $vo['title']; ?></div>
                        <div class="School-name"><?php echo $vo['mbyx']; ?></div>
                        </div>
                        <div class="progress-msg-hover">
                            <div class="S_name"><?php echo $vo['title']; ?></div>
                            <div class="S_brief"><?php echo $vo['description']; ?></div>
                           <a href="<?php echo cmf_url('cms/Abroad/index',array('id'=>$vo['id'])); ?>" class="more" title="点击查看">
                                点击查看 >
                            </a>
                        </div>
                    </div>
<?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="listpage clearfix">
       <?php 
           $pagestr=$case_fenxi->render();
           $pagestr=str_replace('?','/?',$pagestr);
           ?>
          <?php echo $pagestr; ?>  
                
    </div>
</div>
</div>
<?php
    $request_index = Request::instance();
    $model_cur=$request_index->module();
    $action_cur=$request_index->controller();
    $action_cur2=$request_index->action();
    $part=$request_index->param();
    if(isset($part['t'])){
    	$flagt=intval($part['t']);
    }else{
    	$flagt='1';
    }
  
    //print_r($model_cur."<br/>");
    //print_r($action_cur."<br/>");
       
    $hz = str_replace('/','',$_SERVER["REQUEST_URI"]);
    
?>
<!-- footer start -->
<div class="footer">
    <div class="wrapper">
        <a class="return" title="返回按钮"></a>
        <?php 
            $request_index = Request::instance();
            $model_cur=$request_index->module();
            $action_cur=$request_index->controller();
         if($model_cur == 'cms' && $action_cur == 'Index'): ?>
            <div class="link_tit">友情链接</div>
            <div class="link_con">
                <?php 
                    $linklist= Db::name('Link')->where('status','=','1')->select();
                 if(is_array($linklist) || $linklist instanceof \think\Collection || $linklist instanceof \think\Paginator): if( count($linklist)==0 ) : echo "" ;else: foreach($linklist as $key=>$k1): ?>
                	<a href="<?php echo $k1['url']; ?>" target="_blank" title=""><?php echo $k1['name']; ?></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        <?php else: ?>
            <div  style="height: 30px;"></div>
        <?php endif; if($hz == 'jpschool'): ?>
			<div class="link_tit">友情链接</div>
            <div class="link_con">
                <?php 
                	$catlist= Db::name('Link_category')->where('catname','=','列表页_日本大学')->select()->toArray();

                    $linklist1= Db::name('Link')->where('type='.$catlist[0][id].' and status=1')->select();
                 if(is_array($linklist1) || $linklist1 instanceof \think\Collection || $linklist1 instanceof \think\Paginator): if( count($linklist1)==0 ) : echo "" ;else: foreach($linklist1 as $key=>$k1): ?>
                	<a href="<?php echo $k1['url']; ?>" target="_blank" title=""><?php echo $k1['name']; ?></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        <?php endif; if($hz == 'jlschool'): ?>
			<div class="link_tit">友情链接</div>
            <div class="link_con">
                <?php 
                	$catlist= Db::name('Link_category')->where('catname','=','列表页_日本语言学校')->select()->toArray();
					
                    $linklist2= Db::name('Link')->where('type='.$catlist[0][id].' and status=1')->select();
                 if(is_array($linklist2) || $linklist2 instanceof \think\Collection || $linklist2 instanceof \think\Paginator): if( count($linklist2)==0 ) : echo "" ;else: foreach($linklist2 as $key=>$k1): ?>
                	<a href="<?php echo $k1['url']; ?>" target="_blank" title=""><?php echo $k1['name']; ?></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        <?php endif; $title = $article[title]; ?>
        <div class="foot_menu">
            <dl class="dl2">
                <dt>留学申请</dt>
                <div class="dlleft">
                    <?php if(is_array($slidelist4) || $slidelist4 instanceof \think\Collection || $slidelist4 instanceof \think\Paginator): if( count($slidelist4)==0 ) : echo "" ;else: foreach($slidelist4 as $k=>$vo): if($k < 4): ?><dd><a href="<?php echo $vo['url']; ?>" title="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></a></dd>
                    <?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?></div>
                <div class="dlright">
                    <?php if(is_array($slidelist4) || $slidelist4 instanceof \think\Collection || $slidelist4 instanceof \think\Paginator): if( count($slidelist4)==0 ) : echo "" ;else: foreach($slidelist4 as $k=>$vo): if($k > 3): ?><dd><a href="<?php echo $vo['url']; ?>" title="<?php echo $vo['title']; ?>"><?php echo str_replace('英文授课','',$vo['title']); ?></a></dd>
                    <?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?></div>
            </dl>
            <dl class="dl3">
                <dt>日语学习</dt>
                <div class="dlleft">
                    <?php if(is_array($slidelist5) || $slidelist5 instanceof \think\Collection || $slidelist5 instanceof \think\Paginator): if( count($slidelist5)==0 ) : echo "" ;else: foreach($slidelist5 as $k=>$vo): if($k < 4): ?><dd><a href="<?php echo $vo['url']; ?>" title="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></a></dd>
                    <?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?></div>
                <div class="dlright">
                    <?php if(is_array($slidelist5) || $slidelist5 instanceof \think\Collection || $slidelist5 instanceof \think\Paginator): if( count($slidelist5)==0 ) : echo "" ;else: foreach($slidelist5 as $k=>$vo): if($k > 3): ?><dd><a href="<?php echo $vo['url']; ?>" title="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></a></dd>
                    <?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?></div>
            </dl>
            <dl class="dl4">
                <dt>升学辅导</dt>
                <div class="dlleft">
                    <?php if(is_array($slidelist6) || $slidelist6 instanceof \think\Collection || $slidelist6 instanceof \think\Paginator): if( count($slidelist6)==0 ) : echo "" ;else: foreach($slidelist6 as $k=>$vo): if($k < 4): ?><dd><a href="<?php echo $vo['url']; ?>" title="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></a></dd>
                    <?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?></div>
                <div class="dlright">
                    <?php if(is_array($slidelist6) || $slidelist6 instanceof \think\Collection || $slidelist6 instanceof \think\Paginator): if( count($slidelist6)==0 ) : echo "" ;else: foreach($slidelist6 as $k=>$vo): if($k > 3): ?><dd><a  href="<?php echo $vo['url']; ?>" title="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></a></dd>
                    <?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?></div>
            </dl>
            <dl class="dl5">
                <dt>知识库</dt>
                <dd><a  href="<?php echo cmf_url('cms/List/index',array('id'=>6)); ?>" title="名校案例">名校案例</a></dd>
                <dd><a  href="<?php echo cmf_url('cms/List/index',array('id'=>5)); ?>" title="海外导师">海外导师</a></dd>
                <dd><a  href="<?php echo cmf_url('cms/List/index',array('id'=>24)); ?>" title="专业知识">专业知识</a></dd>
            </dl>
            <dl class="dl6">
                <dt>关于我们</dt>
                <dd><a  href="<?php echo cmf_url('cms/List/index',array('id'=>26)); ?>" title="公司介绍">公司介绍</a></dd>
            </dl>
        </div>
        <div class="foot_wx">
            <div class="foot_wx_fl">
                <span>塾樱教育</span>
                <span>公众号</span>
                <img src="<?php echo get_img_url($site_info['wxqrcode']); ?>" alt="塾樱教育公众号">
            </div>
            <div class="foot_wx_fr">
                <span>塾樱教育</span>
                <span>客服微信</span>
                <img src="<?php echo get_img_url($site_info['wbqrcode']); ?>" alt="塾樱教育客服微信">
            </div>
        </div>
    </div>
</div>
<div class="foot_copyright">
    <div class="wrapper">
	    <?php echo $site_info['site_copyright']; ?><a  rel="nofollow" href="http://beian.miit.gov.cn" target="_blank" title="备案信息查询"><?php echo $site_info['site_icp']; ?></a>  <a href="https://www.shuyingjp.com/tag/" title="网站标签">网站标签</a>
	</div>
</div>
<?php echo $site_info['site_analytics']; ?>
<!-- footer end -->
<?php if($site_info['online_enabled'] == 1): ?>
    <div class="fixed_side">
        <div class="side_left_box" id="aFloatTools_Hide">
            <label>在线客服</label>
        </div>
        <div class="side_left_box" id="aFloatTools_Show">
            <label>在线客服</label>
        </div>
        <ul id="divFloatToolsView">
            <li id="qqonline"><i class="bgs1"></i>400-613-1880</li>
            <li class="shangqiao">
                <a>
                	<div><i class="bgs2"></i>客服微信</div>
                	<div class="ewBox son"><img src="<?php echo get_img_url($site_info['wbqrcode']); ?>" alt="塾樱教育客服微信" style="width: 80px;height: 80px;"></div>
                </a>
            </li>
            <li class="sideewm"><a><i class="bgs2"></i><?php echo (isset($site_info['site_weixinhao']) && ($site_info['site_weixinhao'] !== '')?$site_info['site_weixinhao']:''); ?></a></li>
            <li class="sideetel"><i class="bgs1"></i>13260166070</li>
            <li class="btn_zx"><a rel="nofollow" target="_blank" href="<?php echo (isset($site_info['online_url']) && ($site_info['online_url'] !== '')?$site_info['online_url']:''); ?>" title="塾樱教育咨询">点击咨询</a></li>
        </ul>            
    </div>
<?php endif; ?>
		<script type="text/javascript" src="/public/js/jquery.waypoints.min.js"></script>
		<script type="text/javascript" src="/public/js/jquery.countup.min.js"></script>
		<!--上面两行是从头部移动过来的-->
		<script type="text/javascript" src="/public/js/layer/layer.js"></script>
		<script type="text/javascript" src="/public/js/common.js"></script>
		<script type="text/javascript" src="/public/js/TweenMax.min.js"></script>
		<script type="text/javascript" src="/public/js/wow.min.js"></script>
		<script type="text/javascript" src="/public/js/video.js"></script>
		<script type="text/javascript">
	        if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
	            new WOW().init();
	        };
	    </script>
		<script type="text/javascript">
			kao.common();	
		</script>
	</body>
</html>