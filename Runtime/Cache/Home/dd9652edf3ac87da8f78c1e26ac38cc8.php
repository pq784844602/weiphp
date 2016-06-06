<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta content="遵循Apache2开源协议,免费提供使用,微信功能插件化开发,多公众号管理,配置简单" name="keywords"/>
<meta content="weiphp 简洁强大开源的微信公众平台开发框架微信功能插件化开发,多公众号管理,配置简单" name="description"/>
<link rel="shortcut icon" href="<?php echo SITE_URL;?>/favicon.ico">
<title><?php echo empty($page_title) ? C('WEB_SITE_TITLE') : $page_title; ?></title>
<link href="/weiphp/Public/static/font-awesome/css/font-awesome.min.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/weiphp/Public/Home/css/base.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/weiphp/Public/Home/css/module.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/weiphp/Public/Home/css/weiphp.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="/weiphp/Public/static/bootstrap/js/html5shiv.js?v=<?php echo SITE_VERSION;?>"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="/weiphp/Public/static/jquery-1.10.2.min.js"></script>
<![endif]-->
<!---蓝锂002适配修改 QQ:125682133--->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="/weiphp/Public/static/jquery-2.0.3.min.js"></script>
<!--<![endif]-->
<script type="text/javascript" src="/weiphp/Public/static/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/weiphp/Public/static/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/weiphp/Public/Home/js/dialog.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/weiphp/Public/Home/js/admin_common.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/weiphp/Public/Home/js/admin_image.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript">
var  STATIC = "/weiphp/Public/static";
var  ROOT = "/weiphp";
</script>
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>

<link type="text/css" rel="stylesheet" href="/weiphp/Public/Home/css/about.css?v=<?php echo SITE_VERSION;?>" />
</head>
<body>
	<div class="head">
    	<div class="wrap">
        	<h1 class="fl"><a class="logo" href="<?php echo SITE_URL;?>" title="返回首页">首家开源的微信公众平台开发框架微信功能插件化开发,多公众号管理,配置简单</a></h1>
            <div class="nav">
            	<a <?php if(ACTION_NAME == 'index' and CONTROLLER_NAME == 'Index'): ?>class="cur"<?php endif; ?> href="<?php echo U('home/index/index');?>">首页</a>
                <!--<a <?php if(ACTION_NAME == 'store' and CONTROLLER_NAME == 'Forum'): ?>class="cur"<?php endif; ?> href="<?php echo U('home/forum/store');?>">讨论区</a>-->
               
                <a <?php if(ACTION_NAME == 'help'): ?>class="cur"<?php endif; ?> href="<?php echo U('home/index/help');?>">帮助中心</a>
                <a href="<?php echo U('home/index/main');?>">管理中心</a>
                 <a <?php if(CONTROLLER_NAME == 'Developer'): ?>class="cur"<?php endif; ?> href="<?php echo U('home/Developer/myApps');?>">开发者中心</a>
                
                <a href="<?php echo U('home/index/cloud');?>" class="has_icon">专属云主机<em class="icon"><img src="/weiphp/Public/Home/images/new.gif" alt=""/></em></a>
                <a href="http://bbs.weiphp.cn" target="_blank">论坛</a>
            </div>
        </div>
    </div>
<!-- 提示 -->
<div id="top-alert" class="top-alert-tips alert-error" style="display: none;">
  <a class="close" href="javascript:;"><b class="fa fa-times-circle"></b></a>
  <div class="alert-content">这是内容</div>
</div>    

    <div class="wrap">
    	<div class="content" style="min-height:400px">
    		<h5>关于我们</h5>
			<p>weiphp是一个开源，高效，简洁的微信开发平台，它是基于oneThink这个简单而强大的内容管理框架实现的。</p>
            <p>旨在帮助开发者快速实现微信公众帐号的个性化功能。</p>
            <h5>联系我们</h5>
            <p>email:&nbsp;weiphp@weiphp.cn</p>
            <p>官方QQ群:&nbsp;8322255</p>
		</div>
    </div>
    <div class="footer">
    	<div class="wrap foot_wrap">
        	<div class="foot_div">
            	<h6>关于我们</h6>
                <a href="<?php echo U('about');?>">关于我们</a><br/>
                <a href="<?php echo U('about');?>">联系方式</a><br/>
				<!--<a href="#">友情链接</a><br/>-->
  				<a href="<?php echo U('license');?>">授权协议</a>
                
            </div>
        	<div class="foot_div">
            	<h6>帮助</h6>
                <a href="http://bbs.weiphp.cn" target="_blank">官方论坛</a><br/>
                <!--<a href="javasctipt:;" target="_blank">官方微博</a><br/>-->
                <a href="javascript:;">官方QQ交流群：8322255</a>
				
            </div>
            <div class="getqrcode">
            	<img src="/weiphp/Public/Home/images/getqrcode.jpg"/>
                <p>微信扫码左侧二维码<br/>并加关注WeiPHP官方微信公众号<br/>体验WeiPHP的最新功能</p>
            </div>
            <div class="foot_logo"></div>
        </div>
        <p class="copyright"><?php echo C('COPYRIGHT');?> <?php echo C('WEB_SITE_ICP');?></p>
    </div>
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>    
</body>
</html>