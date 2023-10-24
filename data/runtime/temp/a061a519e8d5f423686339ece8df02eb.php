<?php /*a:9:{s:64:"/www/wwwroot/www.shuyingjp.com/themes/default/cms/list_rypx.html";i:1635506901;s:67:"/www/wwwroot/www.shuyingjp.com/themes/default/public/headertop.html";i:1635475802;s:64:"/www/wwwroot/www.shuyingjp.com/themes/default/public/header.html";i:1638498801;s:68:"/www/wwwroot/www.shuyingjp.com/themes/default/public/header_mob.html";i:1635414385;s:70:"/www/wwwroot/www.shuyingjp.com/themes/default/public/teacher_list.html";i:1635497704;s:67:"/www/wwwroot/www.shuyingjp.com/themes/default/public/news_list.html";i:1635755136;s:65:"/www/wwwroot/www.shuyingjp.com/themes/default/public/qa_list.html";i:1635498054;s:64:"/www/wwwroot/www.shuyingjp.com/themes/default/public/footer.html";i:1635492068;s:66:"/www/wwwroot/www.shuyingjp.com/themes/default/public/footerjs.html";i:1635491960;}*/ ?>
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

<div class="banner banner_glpt"></div>
<div class="section_apply section_apply_glpt">
<div class="wrapper">
<div class="school_tit school_tit_apply" >为什么考JLPT？<span>/ 受験理由</span></div>
<ul class="apply_reason clearfix">
<?php 
$info=Db::query("select * from ls_cms_archives as a left join ls_cms_apprypx as b on a.id = b.id where a.status=1 and a.delete_time = 0 and a.channel_id ='".$category->id."' order by a.id asc limit 0,1");
if(isset($info[0])){
$post=$info[0];
$more=json_decode($info[0]['more'],true);
$image=get_img_url($more['thumbnail']);
}else{
$post='';
$image='';
}
if(!empty($post['reason'])){
	$reason=json_decode($post['reason'],true);
}else{
	$reason=array();
}
 if(is_array($reason) || $reason instanceof \think\Collection || $reason instanceof \think\Paginator): if( count($reason)==0 ) : echo "" ;else: foreach($reason as $k=>$vo): ?>	        
<li><i><?php echo $k+1; ?></i><h5><?php echo str_replace('|','<em></em>',$vo['title']); ?></h5><p><label><?php echo str_replace('|','</label><label>',$vo['desc']); ?></label></p></li>
<?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
</div>
<div class="section_base bgf2f3f5">
<div class="wrapper">
<div class="school_tit school_tit_base">基本信息<span>/ 基本情報 </span></div>
<ul class="base_con_glpt">
<?php 
if(!empty($post['basic'])){
	$basic=json_decode($post['basic'],true);
}else{
	$basic=array();
}
 if(is_array($basic) || $basic instanceof \think\Collection || $basic instanceof \think\Paginator): if( count($basic)==0 ) : echo "" ;else: foreach($basic as $k=>$vo): ?>	    
<li class="trs">
<div class="base_txt_glpt trs">
   <i></i><em></em><p><?php echo $vo['title']; ?></p>
</div>
<div class="base_txtglpt_hover trs">
   <p><?php echo $vo['title']; ?></p><span><?php echo str_replace('|','<div clear="clearfix"></div>',$vo['desc']); ?>
</span>
</div>
</li>
<?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
</div>
<div class="section_glpt_kc">
<div class="wrapper">
<div class="school_tit">塾樱日语课程<span> / 塾桜日本語コース</span></div>
<div class="glpt_kc_list clearfix">
  <?php $slide_list10= Db::name('SlideItem')->where(array('slide_id'=>'10'))->order('list_order asc,id desc')->select(); if(is_array($slide_list10) || $slide_list10 instanceof \think\Collection || $slide_list10 instanceof \think\Paginator): if( count($slide_list10)==0 ) : echo "" ;else: foreach($slide_list10 as $key=>$vo): ?>
<dl class="trs">
<dt><?php echo $vo['title']; ?></dt>
<dd>
<div class="dd_box">
<p><?php echo str_replace('|','</p><p>',$vo['content']); ?></p></div></dd></dl>
<?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</div>
</div>
<div class="section_glpt_rank bgf2f3f5 clearfix">
<div class="wrapper">
<div class="school_tit school_tit_glptrank">JLPT你要达到什么级别？<span> / どのレベルまで</span></div>
<div class="glpt_rank_con">
  <?php $slide_list11= Db::name('SlideItem')->where(array('slide_id'=>'11'))->order('list_order asc,id desc')->select(); ?>
<div class="glpt_rank_tips">JLPT能力进阶等级</div>
<img src="/public/images/rankline2.png" alt="">
  <?php if(is_array($slide_list11) || $slide_list11 instanceof \think\Collection || $slide_list11 instanceof \think\Paginator): if( count($slide_list11)==0 ) : echo "" ;else: foreach($slide_list11 as $key=>$vo): ?>
  <div class="rank_txt rank_txt<?php echo $key+1; ?>"><strong><?php echo $vo['title']; ?></strong><p><span><?php echo str_replace('|','</span><span>',$vo['content']); ?></span></p></div>
<?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</div>
</div>
<div class="section_feature_zpj2  clearfix" id="glpt_feature_glpt">
<div class="wrapper">
<div class="school_tit school_tit_feature2">塾樱课程特色<span>/ 塾桜コースの特徴</span></div>
<div class="zpj_feature_con2" id="glpt_feature_con">
<div class="zpj_featureleft2">
<img src="/public/images/glpt_feature_left.jpg" alt="">
</div>
  <?php 
    $slide_list12= Db::name('SlideItem')->where(array('slide_id'=>'12'))->order('list_order asc,id desc')->select();
 ?>
<div class="zpj_zpj_featureright2">
<h5>塾桜には</h5>
  <?php if(is_array($slide_list12) || $slide_list12 instanceof \think\Collection || $slide_list12 instanceof \think\Paginator): if( count($slide_list12)==0 ) : echo "" ;else: foreach($slide_list12 as $key=>$vo): ?>
<p><strong><?php echo $vo['title']; ?></strong><span><?php echo $vo['content']; ?></span></p>
<?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</div>
</div>
</div>
<div class="section_glpt_system clearfix">
<div class="wrapper">
<div class="school_tit school_tit_glptsystem">塾樱教学体系<span>  / 塾桜教育システム</span></div>
<img src="/public/images/glpt_system.jpg" class="glpt_sysytem_img" alt="">
</div>
</div>
<div class="section_glpt_flow clearfix bgf2f3f5">
<div class="wrapper">
<div class="school_tit school_tit_glptrank">日语培训流程<span>   / 流れ</span></div>
<?php if($ismobile2 != ''): ?>
<div class="history history-list wrapper">
<ul class="history-ul">
                       <li class="animated time-line-lishow ">
                      <div class="dotted-line"></div>
                      <div class="fz-txt">
                        <div style="width:100%;">
                                 <span>01 联系客服</span></div></div>
                                <div class="his-dot">
                                    <div class="c1"></div>
                          <div class="c2"></div>
                          <div class="c3"></div>
                                  </div>
                                  <div class="clearfix"></div></li>
                      <li class="animated time-line-lishow ">
                      <div class="dotted-line"></div>
                      <div class="fz-txt">
                        <div style="width:100%;">
                                      <span>02  安排试听</span>
                                  </div>
                                </div>
                                <div class="his-dot">
                                    <div class="c1"></div>
                          <div class="c2"></div>
                          <div class="c3"></div>
                                  </div>
                                  <div class="clearfix"></div>
                    </li>
                     <li class="animated time-line-lishow ">
                      <div class="dotted-line"></div>
                      <div class="fz-txt">
                        <div style="width:100%;">
                                      <span>03 报名</span>
                                  </div>
                                </div>
                                <div class="his-dot">
                                    <div class="c1"></div>
                          <div class="c2"></div>
                          <div class="c3"></div>
                                  </div>
                                  <div class="clearfix"></div>
                    </li>
                     <li class="animated time-line-lishow ">
                      <div class="dotted-line"></div>
                      <div class="fz-txt">
                        <div style="width:100%;">
                                      <span>04 分配老师</span>
                                  </div>
                                </div>
                                <div class="his-dot">
                                    <div class="c1"></div>
                          <div class="c2"></div>
                          <div class="c3"></div>
                                  </div>
                                  <div class="clearfix"></div>
                    </li>
                     <li class="animated time-line-lishow ">
                      <div class="dotted-line"></div>
                      <div class="fz-txt">
                        <div style="width:100%;">
                                      <span>05 上课</span>
                                  </div>
                                </div>
                                <div class="his-dot">
                                    <div class="c1"></div>
                          <div class="c2"></div>
                          <div class="c3"></div>
                                  </div>
                                  <div class="clearfix"></div>
                    </li>
                    <li class="animated time-line-lishow ">
                      <div class="dotted-line"></div>
                      <div class="fz-txt">
                        <div style="width:100%;">
                                      <span>06 完成作业</span>
                                  </div>
                                </div>
                                <div class="his-dot">
                                    <div class="c1"></div>
                          <div class="c2"></div>
                          <div class="c3"></div>
                                  </div>
                                  <div class="clearfix"></div>
                    </li>
                    <li class="animated time-line-lishow ">
                      <div class="dotted-line"></div>
                      <div class="fz-txt">
                        <div style="width:100%;">
                                      <span>07 作业批改</span>
                                  </div>
                                </div>
                                <div class="his-dot">
                                    <div class="c1"></div>
                          <div class="c2"></div>
                          <div class="c3"></div>
                                  </div>
                                  <div class="clearfix"></div>
                    </li>
                     <li class="animated time-line-lishow ">
                      <div class="dotted-line"></div>
                      <div class="fz-txt">
                        <div style="width:100%;">
                                      <span>08 线下跟盯</span>
                                  </div>
                                </div>
                                <div class="his-dot">
                                    <div class="c1"></div>
                          <div class="c2"></div>
                          <div class="c3"></div>
                                  </div>
                                  <div class="clearfix"></div>
                    </li>
 </ul>
</div>
<?php else: ?>
<ul class="list_glpt_flow">
<li class="sjright">
<div class="flow_box">
<strong>01</strong>
<p>联系客服</p>
</div>
</li>
<li class="sjright">
<div class="flow_box">
<strong>02</strong>
<p>安排试听</p>
</div>
</li>
<li class="sjright">
<div class="flow_box">
<strong>03</strong>
<p>报名</p>
</div>
</li>
<li class="sjright">
<div class="flow_box">
<strong>04</strong>
<p>分配老师</p>
</div>
</li>
<li>
<div class="flow_box">
<strong>08</strong>
<p>线下跟盯</p>
</div>
</li>
<li class="sjleft">
<div class="flow_box">
<strong>07</strong>
<p>作业批改 </p>
</div>
</li>
<li class="sjleft">
<div class="flow_box">
<strong>06</strong>
<p>完成作业 </p>
</div>
</li>
<li class="sjleft">
<div class="flow_box">
<strong>05</strong>
<p>上课</p>
</div>
</li>
</ul>
<?php endif; ?>
</div>
</div>
	<div class="section-teacher clearfix">
						    <div class="wrapper">
							<div class="school_tit school_tit_teacher ">师资介绍<span>/ 指導教師 </span></div>
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
</div>
						    </div>
						 </div>
	<div class="section-news clearfix">
						<div class="wrapper">
<div class="school_tit school_tit_news">相关资讯<span>/ 関連情報 </span></div>
						<div class="section-news-con">
    <?php 
        if(!empty($post['keywords'])){
            $post['keywords'] = str_replace('，', ',', $post['keywords']);
            $keywords_arr = explode(',', $post['keywords']);
        }else{
            $keywords_arr ='';
        }
     if($keywords_arr != ''): 
            $wherenews['channel_id'] = array(37,38,41,49,52,53,54,55,56,57,58,59,60,61);// 其他条件
            $wherenews['status'] = 1;
            $wherenews['delete_time'] = 0;
            $tags_arc= Db::name('CmsTags')->where("type = 1")->where('name','in',$keywords_arr)->order('nums desc')->select()->toArray();
            $fields_archivesarc = array_column($tags_arc,'archives');

            $fields_archivesarca=explode(',',implode(',',$fields_archivesarc));
            
            $fields_archivesarca=array_unique($fields_archivesarca);
            
            $relation_list_news= Db::name('CmsArchives')->where('id','in',$fields_archivesarca)->where($wherenews)->order('create_time desc')->limit(0,4)->select()->toArray();
         ?>
    <?php endif; if(is_array($relation_list_news) || $relation_list_news instanceof \think\Collection || $relation_list_news instanceof \think\Paginator): if( count($relation_list_news)==0 ) : echo "" ;else: foreach($relation_list_news as $k=>$vo): 
            $more=json_decode($vo['more'],true);
         ?>
        <div class="news_item">      
        	<a href="<?php echo cmf_url('cms/Archives/index',array('id'=>$vo['id'],'cid'=>$vo['channel_id'])); ?>" class="more" title="<?php echo $vo['title']; ?>">
              <div class="news_top">
                  <div class="top_img_a" title="<?php echo $vo['title']; ?>"><img src="<?php echo get_img_url($more['thumbnail']); ?>" alt="<?php echo $vo['title']; ?>"></div>
                  <p><?php echo $vo['title']; ?></p>
                  <span><?php echo $vo['description']; ?></span>
                  <span class="more">查看更多>></span>
              </div>
            </a>
        	<?php 
                if($k == 0) $k1=4;
                if($k ==1)  $k1=10;
                if($k ==2)  $k1=16;
                if($k ==3)  $k1=22;
                $relation_list_news_bot= Db::name('CmsArchives')->where('id','in',$fields_archivesarca)->where('status', '=','1')->where('delete_time', '=','0')->order('hits desc')->limit($k1,6)->select()->toArray();
             ?>
        	<div class="news_bot">
            	<?php if(is_array($relation_list_news_bot) || $relation_list_news_bot instanceof \think\Collection || $relation_list_news_bot instanceof \think\Paginator): if( count($relation_list_news_bot)==0 ) : echo "" ;else: foreach($relation_list_news_bot as $k2=>$vo2): ?>
            	    <p><a href="<?php echo cmf_url('cms/Archives/index',array('id'=>$vo2['id'],'cid'=>$vo2['channel_id'])); ?>" title="<?php echo $vo2['title']; ?>"><?php echo $vo2['title']; ?></a></p>
            	<?php endforeach; endif; else: echo "" ;endif; ?>
        	</div>
    	</div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>
						</div>
</div>
<div class="section_QA">
<div class="wrapper">
<div class="school_tit school_tit_QA">相关问答<span>/ Q&A </span></div>
<div class="QA_con clearfix">
<?php if($keywords_arr != ''): 
$whereask['channel_id'] = 25; // 其他条件
$whereask['status'] = 1;
$whereask['delete_time'] = 0;
  $tags_arc_wd= Db::name('CmsTags')->where("type = 1")->where('name','in',$keywords_arr)->order('nums desc')->select()->toArray();
 $fields_archivesarc_wd = array_column($tags_arc_wd,'archives');
 $fields_archivesarc_wda=explode(',',implode(',',$fields_archivesarc_wd));
 $fields_archivesarc_wda=array_unique($fields_archivesarc_wda);
  $relation_list_wd= Db::name('CmsArchives')->where('id','in',$fields_archivesarc_wda)->where($whereask)->order('create_time desc')->limit(0,8)->select()->toArray();
   ?>
  <?php endif; if(is_array($relation_list_wd) || $relation_list_wd instanceof \think\Collection || $relation_list_wd instanceof \think\Paginator): if( count($relation_list_wd)==0 ) : echo "" ;else: foreach($relation_list_wd as $k=>$vo): ?><a href="<?php echo cmf_url('cms/Archives/index',array('id'=>$vo['id'],'cid'=>$vo['channel_id'])); ?>" title="<?php echo $vo['title']; ?>"><dl><dt><?php echo $vo['title']; ?></dt><dd><?php echo mb_substr($vo['description'],0,30,'utf-8'); ?>...</dd></dl></a>
<?php endforeach; endif; else: echo "" ;endif; ?>
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