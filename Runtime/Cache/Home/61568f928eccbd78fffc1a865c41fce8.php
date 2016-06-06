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
<link href="<?php echo ADDON_PUBLIC_PATH;?>/leaflets.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
<body id="leaflets">
	<div class="container body">
    	<h1><?php echo ($config["title"]); ?></h1>
        <div class="qrcode">
        	<img src="<?php echo ($config["img"]); ?>"/>
        </div>
        <div class="qr_tips">请使用微信扫描二维码关注此公众号</div>
        <div class="desc">
        	<?php echo ($config["info"]); ?>
        </div>
        <p class="copyright"><?php echo ($config["copyright"]); ?></p>
    </div>
	
</body>
<script type="text/javascript">
$('#shape').click(function(event){
	if(event.target.tagName == "SPAN"){
		$(event.target).addClass('on');
		$(this).unbind("click");
		var audio = new Audio();
		//audio.src = "<?php echo ADDON_PUBLIC_PATH;?>/hit.mp3";
		//audio.play();
		setTimeout(function(){openSuccessDialog();},2000);//测试代码
		$.ajax({
			url:"url",
			data:{},
			dataType:"json",
			success:function(data){
				if(data.result=="sucess"){
						$(event.target).addClass('luck');
						setTimeout(function(){
							openSuccessDialog();
						},2000)
					
					}else{
						setTimeout(function(){
							openErrorDialog();
						},2000)
					}
				}
			});
	}
})
function openSuccessDialog(){
	var successHtml = "<div class='common_dialog lqcg'>"
		+"<h6>你的运气太好了！</h6><p class='p_10'>你获得了精美礼物一份，请联系客服领取。</p>"
		+"<div class='tb'><a class='btn m_15 flex_1' href='#'>去领取</a></div>"
		+"</div>"
		$.Dialog.open(successHtml);
	}
function openErrorDialog(){
	var successHtml = "<div class='common_dialog lqcg'>"
		+"<h6>很抱歉！没有砸中，还需继续努力</h6><p class='p_10'>你还有10次机会。</p>"
		+"<div class='tb'><a class='btn m_15 flex_1' href='#'>在砸一次</a></div>"
		+"</div>"
		$.Dialog.open(successHtml);
	}
</script>
</html>