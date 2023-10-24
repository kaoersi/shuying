<?php /*a:6:{s:60:"/www/wwwroot/www.shuyingjp.com/themes/default/cms/index.html";i:1637910155;s:64:"/www/wwwroot/www.shuyingjp.com/themes/default/public/header.html";i:1638498801;s:68:"/www/wwwroot/www.shuyingjp.com/themes/default/public/header_mob.html";i:1635414385;s:70:"/www/wwwroot/www.shuyingjp.com/themes/default/public/teacher_list.html";i:1635497704;s:64:"/www/wwwroot/www.shuyingjp.com/themes/default/public/footer.html";i:1635492068;s:66:"/www/wwwroot/www.shuyingjp.com/themes/default/public/footerjs.html";i:1635491960;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	<title><?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:''); ?></title>
			<meta name="keywords" content="<?php echo (isset($site_info['site_seo_keywords']) && ($site_info['site_seo_keywords'] !== '')?$site_info['site_seo_keywords']:''); ?>"/>
		<meta name="description" content="<?php echo (isset($site_info['site_seo_description']) && ($site_info['site_seo_description'] !== '')?$site_info['site_seo_description']:''); ?>"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/public/css/common.css" />
		<link rel="stylesheet" href="/public/css/animate.min.css" />
		<link rel="stylesheet" href="/public/css/index.css" />
		<link rel="stylesheet" href="/public/css/swiper.min.css" />
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

			<div class="clearfix"></div>
<?php $slide_banner_list= Db::name('SlideItem')->where(array('slide_id'=>'1','status'=>'1'))->order('list_order asc,id desc')->select(); ?>
				<div class="banner" >
					 <div class="swiper-container">
						<div class="swiper-wrapper">
						 <?php if(is_array($slide_banner_list) || $slide_banner_list instanceof \think\Collection || $slide_banner_list instanceof \think\Paginator): if( count($slide_banner_list)==0 ) : echo "" ;else: foreach($slide_banner_list as $k=>$vo): ?>
							<div class="swiper-slide" style="background:url(<?php echo get_img_url($vo['image']); ?>) no-repeat; background-size: cover;"></div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						    <div class="swiper-button-prev swiper-bannerbtn-prev"></div>
                            <div class="swiper-button-next swiper-bannerbtn-next"></div>
					</div>
					<div class="ban-nav wrapper">
					<div class="swiper-pagination"></div>
						<ul>
							<li class="ban-nav-li1">
								<h3>攻读学位</h3>
								<div class="ban-nav-list"> 
								<?php if(is_array($slidelist3) || $slidelist3 instanceof \think\Collection || $slidelist3 instanceof \think\Paginator): if( count($slidelist3)==0 ) : echo "" ;else: foreach($slidelist3 as $key=>$vo): ?>
							    <a href="<?php echo $vo['url']; ?>" title="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></a>
								<?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</li>
							<li class="ban-nav-li2">
								<h3>留学申请</h3>
								<div class="ban-nav-list">
								<?php if(is_array($slidelist4) || $slidelist4 instanceof \think\Collection || $slidelist4 instanceof \think\Paginator): if( count($slidelist4)==0 ) : echo "" ;else: foreach($slidelist4 as $key=>$vo): ?>
								<a href="<?php echo $vo['url']; ?>" title="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></a>
								<?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</li>
							<li class="ban-nav-li3">
								<h3>日语学习</h3>
								<div class="ban-nav-list">
								<?php if(is_array($slidelist5) || $slidelist5 instanceof \think\Collection || $slidelist5 instanceof \think\Paginator): if( count($slidelist5)==0 ) : echo "" ;else: foreach($slidelist5 as $key=>$vo): ?>
								<a href="<?php echo $vo['url']; ?>" title="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></a>
								<?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</li>
							<li class="ban-nav-li4">
								<h3>升学辅导</h3>
								<div class="ban-nav-list">
								<?php if(is_array($slidelist6) || $slidelist6 instanceof \think\Collection || $slidelist6 instanceof \think\Paginator): if( count($slidelist6)==0 ) : echo "" ;else: foreach($slidelist6 as $key=>$vo): ?>
								<a href="<?php echo $vo['url']; ?>" title="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></a>
								<?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</li>
						</ul>
					</div>
				</div>
	                <div class="section-com section-lxtj clearfix wrapper">
					<h5 class="section_tit"><label>留学申请</label><span>塾樱设计出属于你的留学方案</span></h5>
					<ul class="section_list clearfix">
 <?php
$cms_sub_categories_data = \app\cms\service\ApiService::subCategories(1);
 if(is_array($cms_sub_categories_data) || $cms_sub_categories_data instanceof \think\Collection || $cms_sub_categories_data instanceof \think\Paginator): $k = 0; $__LIST__ = $cms_sub_categories_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
<li>
							<a href="<?php echo cmf_url('cms/List/index',array('id'=>$vo['id'])); ?>" title="<?php echo $vo['name']; ?>">
							<dl><dt><?php echo $vo['name']; ?></dt>
								<dd><p><?php $des=str_replace('|','</p>
								<p>',$vo['description']); ?><?php echo $des; ?></p></dd>
							</dl></a></li>
<?php endforeach; endif; else: echo "" ;endif; ?></ul>
						</div>
						<div class="section-com section-rypx clearfix">
						   <div class="wrapper">
							<h5 class="section_tit section_tit_rypx"><label>日语培训</label><span>课程可满足各阶段群体，等级考试不再是难题！</span></h5>
							<ul class="section_list_rypx clearfix">
							<?php
$cms_sub_categories_data = \app\cms\service\ApiService::subCategories(2);
 if(is_array($cms_sub_categories_data) || $cms_sub_categories_data instanceof \think\Collection || $cms_sub_categories_data instanceof \think\Paginator): $k = 0; $__LIST__ = $cms_sub_categories_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
<li>
									<a href="<?php echo cmf_url('cms/List/index',array('id'=>$vo['id'])); ?>" title="<?php echo $vo['name']; ?>">
							<div class="rypx_top">
									<img src="/public/images/rypx_img<?php echo $k; ?>.png" alt="<?php echo $vo['name2']; ?>">
									<h3>日本語レッスン</h3>
									<strong><?php echo $vo['name']; ?></strong>
							</div>
							<div class="rypx_bot">
									 <p><?php echo $vo['name2']; ?></p>
										<span><?php $des2=str_replace('|','</span>
										<span>',$vo['description']); ?><?php echo $des2; ?></span>
							</div>
							<div class="rypx_more"><label>查看更多</label></div></a></li>
<?php endforeach; endif; else: echo "" ;endif; ?></ul></div></div>
						 <div class="section-com section-tskc clearfix wrapper">
							<h5 class="section_tit section_tit_tskc"><label>升学考试辅导</label><span>海外导师在线辅导，何时何地都可进行升学辅导！VIP个性化课程设计，最短的时间实现最好的效果！</span></h5>
							<ul class="section_list_tskc clearfix">
							<?php
$cms_sub_categories_data = \app\cms\service\ApiService::subCategories(3);
 if(is_array($cms_sub_categories_data) || $cms_sub_categories_data instanceof \think\Collection || $cms_sub_categories_data instanceof \think\Paginator): $k = 0; $__LIST__ = $cms_sub_categories_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
<li>
									<div class="tskc_txt">
									<img src="/public/images/tskc_img<?php echo $k; ?>.png" alt="<?php echo $vo['name']; ?>">
									<i></i>
									<strong><?php echo $vo['name']; ?></strong>
						</div>
									<div class="tskc_txt_hover">
									<h5><?php echo $vo['name']; ?></h5>
									<p><span><?php $des3=str_replace('|','</span><span>',$vo['description']);
									 ?><?php echo $des3; ?></span></p>
									<a href="<?php echo cmf_url('cms/List/index',array('id'=>$vo['id'])); ?>" title="<?php echo $vo['name']; ?>">了解更多</a>
									</div></li>
<?php endforeach; endif; else: echo "" ;endif; ?>	
							</ul>
						</div>
						 <div class="section-com section-fwys clearfix">
						    <div class="wrapper">
							<h5 class="section_tit section_tit_fwys"><label>服务优势</label><span>一站式服务</span></h5>
							<dl class="fuyw_nav">
							<dt><img src="/public/images/fwys_logo.png" alt="塾樱教育"></dt>
							<dd>一站式服务</dd>
							<dd>留学申请</dd>
							<dd>日语培训</dd>
							<dd>特色课程</dd>
							</dl>
							<div class="fwyw_con">
							<dl><dt></dt>
							<dd>
								<p>谁负责申请工作？</p>
								<p>教授研究看不懂？</p>
								<p>计划书不会写？</p>
								<p>面试总失败？</p>
								<p>哑巴日语不会说？</p>
								<p>是否提供升学考试辅导？</p>
								<p>专业冷门能否辅导？</p>
							</dd></dl>
							<dl>
							<div class="VS">VS</div>
							<dt><label>塾樱</label></dt>
							<dd>
								<p>六位一体教学系统,专业的人做专业的事</p>
								<p>研究指导顾问帮你<strong>分析教授</strong>方向</p>
								<p>海外导师提供<strong>计划书指导</strong>系列课</p>
								<p>面试辅导顾问提供<strong>视频面试</strong>系列课</p>
								<p>免费增加<strong>口语课</strong>为之后面试打基础</p>
								<p><strong>200</strong>+海外导师提供升学考试专业辅导</p>
								<p>可匹配<strong>93.7%</strong>细分方向的导师</p>
							</dd></dl>
							<dl>
							<dt><label>传统机构</label></dt>
							<dd>
								<p>文书老师，仅负责翻译及申请</p>
								<p>需学员独自完成阅读并理解</p>
								<p>不提供任何专业知识辅导</p>
								<p>提供一次电话模拟训练</p>
								<p>口语强化课另收费</p>
								<p>没有导师，很难辅导升学考试</p>
								<p>导师少很难匹配冷门专业</p>
							</dd></dl>
							</div></div>
						</div>
						 <div class="section-com section-team clearfix">
						    <div class="wrapper">
							<h5 class="section_tit section_tit_team"><label>六位一体一站式教学团队</label></h5>
							<ul class="section_list_team clearfix">
<?php $slide_list2= Db::name('SlideItem')->where(array('slide_id'=>'2','status'=>'1'))->order('list_order asc,id desc')->select(); if(is_array($slide_list2) || $slide_list2 instanceof \think\Collection || $slide_list2 instanceof \think\Paginator): if( count($slide_list2)==0 ) : echo "" ;else: foreach($slide_list2 as $k=>$vo): ?>
								<li>
									<div class="team_txt">
									<i></i><strong><?php echo $vo['title']; ?></strong>
									<p><span><?php $content=str_replace('|','</span><span>',$vo['content']); ?><?php echo $content; ?></span></p></div>
									<div class="team_txt_hover">
									<em></em><h5><?php echo $vo['title']; ?></h5>
									<p><span><?php echo $content; ?></span></p>
									</div></li>
								<?php endforeach; endif; else: echo "" ;endif; ?></ul>
						</div>
						</div>
						<div class="section-com section-teacher clearfix">
						    <div class="wrapper">
							<h5 class="section_tit section_tit_teacher" ><label>海外导师库</label><a href="https://www.shuyingjp.com/tutor/" class="more" title="海外导师库">全部 ></a></h5>
<div class="section_list_teacher">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php
$articles_data = \app\cms\service\ApiService::articles([
    'field'   => '',
    'where'   => "",
    'limit'   => '10',
    'order'   => 'a.list_order asc,a.published_time DESC',
    'page'    => '',
    'relation'=> 'true',
    'category_ids'=>'5'
]);

$__PAGE_VAR_NAME__ = isset($articles_data['page'])?$articles_data['page']:'';

 if(is_array($articles_data['articles']) || $articles_data['articles'] instanceof \think\Collection || $articles_data['articles'] instanceof \think\Paginator): $i = 0; $__LIST__ = $articles_data['articles'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

            <div class="swiper-slide">
        	    <div class="teacher_txt">
					<img src="<?php echo get_img_url($vo['more']['thumbnail']); ?>" alt="<?php echo $vo['title']; ?>">
					<div class="teach_info">
				    <span><?php echo $vo['title']; ?></span><?php $str=explode("|",$vo['beijing']);$str_bj=str_replace(',','</label><label>',$str[0]); ?><p><label><?php echo $str_bj; ?></label></p>
					</div>
				</div>
				<div class="teacher_txt_hover">
					<span><?php echo $vo['title']; ?></span> 
					<div class="teach_info_h">
					<?php $beijing=str_replace('|','</p><p>',$vo['beijing']);$beijing2=str_replace(',','</label><label>',$beijing); ?><p><label><?php echo $beijing2; ?></label></p></div>
				</div></div>
<?php endforeach; endif; else: echo "" ;endif; ?>   </div>
    <div class="prev_btn_teacher" style="display: none;"></div>
    <div class="next_btn_teacher"></div>
    </div>
</div> </div></div>
						<div class="section-news clearfix">
						<div class="wrapper">
						<div class="section-news-nav">
						<?php $news_bot_case= Db::name('CmsLxzk')->alias('a')->limit(7)->order('create_time desc')->select()->toArray(); ?>
						<div class="news_item">
						<div style="display:flex;align-items: flex-end;justify-content: space-between;">
						    <h5>名校案例库 <span>/ オファー</span></h5>   
						    <a href="https://www.shuyingjp.com/mxalk/" class="more" style="padding-bottom:18px;color:#d5417b;" title="名校案例库">查看更多</a>
						</div>
						    <div class="news_top" style="overflow:hidden;border-radius:10px;">
						    <a href="<?php echo cmf_url('cms/Archives/index',array('id'=>$vo['id'],'cid'=>$vo['channel_id'])); ?>" title="">  
						    <a class="top_img_a" title="名校案例库" style="position: relative;"><img src="/public/images/indexnews1.png" alt="名校案例库"><span class="news_time"><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></span></a>
						    <?php if(is_array($news_bot_case) || $news_bot_case instanceof \think\Collection || $news_bot_case instanceof \think\Paginator): if( count($news_bot_case)==0 ) : echo "" ;else: foreach($news_bot_case as $k=>$vo): if($k < 1): ?>
						    <p><?php echo $vo['title']; ?><?php echo $vo['mbyx']; ?><?php echo $vo['sqzy']; ?></p>
						    <span><?php echo $vo['description']; ?></span>
						    <?php endif; ?>
						    <?php endforeach; endif; else: echo "" ;endif; ?>
						    </a>
						    </div>
						
						<div class="news_bot">
						<?php if(is_array($news_bot_case) || $news_bot_case instanceof \think\Collection || $news_bot_case instanceof \think\Paginator): if( count($news_bot_case)==0 ) : echo "" ;else: foreach($news_bot_case as $k=>$vo): if($k > 0): ?>
						<p><a href="<?php echo cmf_url('cms/Abroad/index',array('id'=>$vo['id'])); ?>" title="<?php echo $vo['title']; ?><?php echo $vo['mbyx']; ?><?php echo $vo['sqzy']; ?>"><?php echo $vo['title']; ?><?php echo $vo['mbyx']; ?><?php echo $vo['sqzy']; ?></a><span style="position: absolute;top:-5px;left:0;display:none;"><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></span></p>
						<?php endif; ?>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						</div>
						<?php 
                            $whereArr['channel_id'] = array(37,38,41,49,52,53,54,55,56,57,58,59,61,63,64,65,66,67,68,69,70); // 其他条件
                            $whereArr['status'] = 1;
                            $whereArr['delete_time'] = 0;
                            $news_bot2= Db::name('CmsArchives')->alias('a')->join('ls_cms_appnews b','a.id = b.id')->where($whereArr)->order('create_time desc')->limit(7)->select()->toArray();
                         ?>
		                <div class="news_item">
    						<div style="display:flex;align-items: flex-end;justify-content: space-between;">
    						    <h5>留学资讯 <span>/ お問い合わせ</span></h5>  
    						    <a href="https://www.shuyingjp.com/news/" class="more" style="padding-bottom:18px;color:#d5417b;" title="留学资讯">查看更多</a>
    						</div>
                            <?php if(is_array($news_bot2) || $news_bot2 instanceof \think\Collection || $news_bot2 instanceof \think\Paginator): if( count($news_bot2)==0 ) : echo "" ;else: foreach($news_bot2 as $k=>$vo): if($k == 0): 
                                     $more=json_decode($vo['more'],true);
                                      ?>
            						    <a href="<?php echo cmf_url('cms/Archives/index',array('id'=>$vo['id'],'cid'=>$vo['channel_id'])); ?>" title="<?php echo $vo['title']; ?>" >
            						    <span style="position: absolute;top:-5px;left:0;display:none;"><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></span>
                						<div class="news_top" style="position: relative;overflow:hidden;border-radius:10px;">
                    						<img src="<?php echo get_img_url($more['thumbnail']); ?>" alt=""class="top_img_a" title="<?php echo $vo['title']; ?>">
                    						<span class="news_time" style="top:0px;"><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></span>
                    						<p><?php echo $vo['title']; ?></p>
                    						<span><?php echo $vo['description']; ?></span>
                						</div>
            						</a>
        						<?php endif; ?>
    						<?php endforeach; endif; else: echo "" ;endif; ?>
    						<div class="news_bot">
        						<?php if(is_array($news_bot2) || $news_bot2 instanceof \think\Collection || $news_bot2 instanceof \think\Paginator): if( count($news_bot2)==0 ) : echo "" ;else: foreach($news_bot2 as $k1=>$vo): if($k1 > 0): ?>
            						    <p><a href="<?php echo cmf_url('cms/Archives/index',array('id'=>$vo['id'],'cid'=>$vo['channel_id'])); ?>" title="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></a></p>
            						    <span style="position: absolute;top:-5px;left:0;display:none;"><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></span>
            						<?php endif; ?>
        						<?php endforeach; endif; else: echo "" ;endif; ?>
    						</div>
						</div>
						<div class="news_item">
						<div style="display:flex;align-items: flex-end;justify-content: space-between;">
						    <h5>留学问答 <span>/ FAQs</span></h5>
						    <a href="https://www.shuyingjp.com/faqs/" class="more" style="padding-bottom:18px;color:#d5417b;" title="留学问答">查看更多</a>
						</div>
                        <?php 
                        $news_bot= Db::name('CmsArchives')->alias('a')->join('ls_cms_appask b','a.id = b.id')->
                        where(array('channel_id'=>'25'))->order('create_time desc')->limit(7)->select()->toArray(); if(is_array($news_bot) || $news_bot instanceof \think\Collection || $news_bot instanceof \think\Paginator): if( count($news_bot)==0 ) : echo "" ;else: foreach($news_bot as $k=>$vo): if($k == 0): 
                         $more=json_decode($vo['more'],true);
                          ?>
						<a href="<?php echo cmf_url('cms/Archives/index',array('id'=>$vo['id'],'cid'=>$vo['channel_id'])); ?>" title="<?php echo $vo['title']; ?>">
						<div class="news_top" style="position: relative;overflow:hidden;border-radius:10px;">
						<img src="<?php echo get_img_url($more['thumbnail']); ?>" alt="<?php echo $vo['title']; ?>" class="top_img_a" title="<?php echo $vo['title']; ?>">
						<span class="news_time" style="top:0px;"><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></span>
						<p><?php echo $vo['title']; ?></p>
						<span><?php echo $vo['description']; ?></span>
						</div>
						</a>
						<?php endif; ?>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						<div class="news_bot">
						<?php if(is_array($news_bot) || $news_bot instanceof \think\Collection || $news_bot instanceof \think\Paginator): if( count($news_bot)==0 ) : echo "" ;else: foreach($news_bot as $k=>$vo): if($k > 0): ?>
						<p><a href="<?php echo cmf_url('cms/Archives/index',array('id'=>$vo['id'],'cid'=>$vo['channel_id'])); ?>" title="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></a><span style="position: absolute;top:-5px;left:0;display:none;"><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></span></p>
						
						<?php endif; ?>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						</div>
						</div>
						<div class="section-news-vedio" >
						<h5>视频区 <span>/ 動画リスト</span><a href="<?php echo cmf_url('cms/List/index',array('id'=>42)); ?>" class="more_tit" title="视频区">查看更多>></a></h5>
						<ul>
<?php 
$vediolist=Db::query("select * from ls_cms_archives as a left join ls_cms_appvedio as b on a.id = b.id where a.status=1 and a.delete_time = 0 and a.channel_id ='42' and is_top =1 order by a.create_time desc limit 0,4");
 if(is_array($vediolist) || $vediolist instanceof \think\Collection || $vediolist instanceof \think\Paginator): if( count($vediolist)==0 ) : echo "" ;else: foreach($vediolist as $k=>$vo): 
 $more=json_decode($vo['more'],true);
  ?>
						<li class="video-list-li">
							<div class="vedio_box"><i class="btn_on"  data-id="react-video<?php echo $vo['id']; ?>" vpath="<?php echo get_img_url($more['thumbnail']); ?>" ipath="<?php echo get_img_url($vo['vediourl']); ?>"></i>
							<img src="<?php echo get_img_url($more['thumbnail']); ?>" class="imgvediobz" alt="<?php echo $vo['title']; ?>"></div><p><a style="cursor: default;"><?php echo $vo['title']; ?></a></p>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>		
						</ul> </div>
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
		<span class="close-bottom-fixed"></span>
			<div class="bottom-fixed">
				<?php $slideitem21= Db::name('SlideItem')->where(array('slide_id'=>'21'))->select(); ?>
				<div class="wrapper">
 <?php if(is_array($slideitem21) || $slideitem21 instanceof \think\Collection || $slideitem21 instanceof \think\Paginator): $_61a982802276d = is_array($slideitem21) ? array_slice($slideitem21,0,1, true) : $slideitem21->slice(0,1, true); if( count($_61a982802276d)==0 ) : echo "" ;else: foreach($_61a982802276d as $k1=>$vo): ?>
					<a href="/" class="bottom-logo"><img src="<?php echo get_img_url($vo['image']); ?>" alt="<?php echo $vo['title']; ?>"></a>
					<h5 class=""><?php echo $vo['title']; ?></h5>
					<a rel="nofollow" href="<?php echo (isset($vo['url']) && ($vo['url'] !== '')?$vo['url']:''); ?>" target="_blank" class="bottom-zixun">立即咨询</a>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div> 
			</div>
			<a class="botClose"></a>
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
	</body>
</html>