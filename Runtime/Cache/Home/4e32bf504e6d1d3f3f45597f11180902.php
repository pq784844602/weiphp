<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/weiphp/Public/Home/css/font-awesome.css?v=<?php echo SITE_VERSION;?>" media="all">
	<link rel="stylesheet" type="text/css" href="/weiphp/Public/Home/css/mobile_module.css?v=<?php echo SITE_VERSION;?>" media="all">
    <script type="text/javascript" src="/weiphp/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/weiphp/Public/Home/js/prefixfree.min.js"></script>
    <script type="text/javascript" src="/weiphp/Public/Home/js/m/dialog.js?v=<?php echo SITE_VERSION;?>"></script>
    <script type="text/javascript" src="/weiphp/Public/Home/js/m/flipsnap.min.js"></script>
    <script type="text/javascript" src="/weiphp/Public/Home/js/m/mobile_module.js?v=<?php echo SITE_VERSION;?>"></script>
    <script type="text/javascript" src="/weiphp/Public/Home/js/admin_common.js?v=<?php echo SITE_VERSION;?>"></script>
	<title><?php echo empty($page_title) ? C('WEB_SITE_TITLE') : $page_title; ?></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
    <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
    <meta content="no-cache" http-equiv="pragma">
    <meta content="0" http-equiv="expires">
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="shortcut icon" href="<?php echo SITE_URL;?>/favicon.ico">
</head>
<link href="<?php echo ADDON_PUBLIC_PATH;?>/css/diy.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
<script src="<?php echo ADDON_PUBLIC_PATH;?>/js/diy.js?v=<?php echo SITE_VERSION;?>" type="text/javascript"></script> 
<body id="diyPreviewBody">
	<div id="main-container" style="min-height: 402px;">
  
        <section id="contents"> 
            <div class="iphone">
            	<div class="i_top"></div>
                <div class="i_mid">
                	<div class="area" style="<?php if(!empty($background)): ?>background-image:url(<?php echo ($background); ?>);<?php endif; ?>background-size:100% 100%;">
                    	<div class="mobile_show preview_show" id="phoneArea">
                        	<?php if(is_array($layouts)): $i = 0; $__LIST__ = $layouts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$layout): $mod = ($i % 2 );++$i;?><!-- 每行的布局处理 -->
                                
                                <div class="layout_row" data-type="<?php echo ($layout["type"]); ?>">
                                   <?php if(is_array($layout["widgets"])): $i = 0; $__LIST__ = $layout["widgets"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$widget): $mod = ($i % 2 );++$i;?><!-- 每个布局里的模块处理 -->  
                                    <div class="layout_item" <?php if(!empty($widget["widget_height"])): ?>style="height:<?php echo ($widget["widget_height"]); ?>px"<?php endif; ?>><?php echo ($widget["html"]); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    
                </div>
                <div class="i_bottom"></div>
            </div>
        </section>
  </div>
</body>
<script type="text/javascript">
  	$(function(){
		$('.layout_row').each(function(index, element) {
            initItemLayoutAndAction($(this),$(this).data('type'));
        });;
		})
</script>
</html>