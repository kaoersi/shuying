<?php /*a:1:{s:62:"/www/wwwroot/www.shuyingjp.com/themes/default/cms/channel.html";i:1627535107;}*/ ?>

<?php
$cms_sub_categories_data = \app\cms\service\ApiService::subCategories($category['id']);
 if(is_array($cms_sub_categories_data) || $cms_sub_categories_data instanceof \think\Collection || $cms_sub_categories_data instanceof \think\Paginator): $k = 0; $__LIST__ = $cms_sub_categories_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>

<script type="text/javascript">

  window.location.href="<?php echo cmf_url('cms/List/index',array('id'=>$vo['id'])); ?>";          

</script>


<?php endforeach; endif; else: echo "" ;endif; ?>