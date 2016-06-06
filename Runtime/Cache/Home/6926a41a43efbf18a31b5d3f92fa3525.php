<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
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

<script type="text/javascript">
var WeiPHPMid = '<?php echo ($mid); ?>';
var DiyPageId = <?php echo I('get.id');?>;
</script>
</head>
<body id="actionLayoutBody">
<!-- 提示 -->
<div id="top-alert" class="top-alert-tips alert-error" style="display: none;">
  <a class="close" href="javascript:;"><b class="fa fa-times-circle"></b></a>
  <div class="alert-content">这是内容</div>
</div>
<!-- 导航条
================================================== -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
       <a class="brand" title="<?php echo C('WEB_SITE_TITLE');?>" href="<?php echo U('index/index');?>"><img height="45" src="<?php if(C('SYSTEM_LOGO')) { echo C('SYSTEM_LOGO'); }else{ ?>/weiphp/Public/Home/images/top_logo.png?v=<?php echo SITE_VERSION;?> <?php } ?>" title="<?php echo C('WEB_SITE_TITLE');?>"/></a>
            
            
            <div class="top_nav">
                <?php if(is_login()): ?><ul class="nav" style="margin-right:0">
                    	<li class="dropdown">						     
                             <!-- 显示代码bug修改 -->
							 <?php if($mp_ids_list > 0): if(!empty($$member_public["public_name"])): ?><a href="<?php echo U('home/MemberPublic/lists');?>" class="dropdown-toggle login-nav" data-toggle="dropdown" title="公众号管理">公众号管理								
									  <b class="pl_5 fa fa-sort-down"></b></a><?php endif; ?>							
								  <?php if(empty($$member_public["public_name"])): ?><a href="#" class="dropdown-toggle login-nav" data-toggle="dropdown" title="<?php echo ($member_public["public_name"]); ?>"><?php echo (msubstr_local($member_public["public_name"],0,5,'utf-8')); ?><b class="pl_5 fa fa-sort-down"></b></a><?php endif; ?>		
							 <?php else: ?>
							     <a href="#" class="dropdown-toggle login-nav" data-toggle="dropdown" title="未设置公众号"><font color="red">未设置公众号</font>						
									  <b class="pl_5 fa fa-sort-down"></b></a><?php endif; ?>
                            <ul class="dropdown-menu" style="display:none">
							    <!-- 显示代码bug修改 	
								  <li><a href="<?php echo U('home/MemberPublic/lists');?>">公众号管理</a></li>	
								-->									
                                <?php if(is_array($member_public_list)): $i = 0; $__LIST__ = $member_public_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('home/MemberPublic/changPublic','id='.$vo['id']);?>" title="<?php echo ($vo["public_name"]); ?>"><?php echo (msubstr_local($vo["public_name"],0,5,'utf-8')); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </li>
                        <li class="dropdown admin_nav">
                            <a href="#" class="dropdown-toggle login-nav" data-toggle="dropdown" style=""><?php echo get_username();?> <b class="pl_5 fa fa-sort-down"></b></a>
                            <ul class="dropdown-menu" style="display:none">
                                <li><a href="<?php echo U('Admin/index/index');?>">后台管理</a></li>
                                <li><a href="<?php echo U('User/profile');?>">修改密码</a></li>
                                <li><a href="<?php echo U('User/logout');?>">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="nav" style="margin-right:0">
                    	<li style="padding-right:20px">你好!欢迎来到<?php echo C('WEB_SITE_TITLE');?></li>
                        <li>
                            <a href="<?php echo U('User/login');?>">登录</a>
                        </li>
                        <li>
                            <a href="<?php echo U('User/register');?>">注册</a>
                        </li>
                        <li>
                            <a href="<?php echo U('admin/index/index');?>" style="padding-right:0">后台入口</a>
                        </li>
                    </ul><?php endif; ?>
            </div>
        </div>
</div>

  <link href="<?php echo ADDON_PUBLIC_PATH;?>/css/jquery-ui.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
  <link href="<?php echo ADDON_PUBLIC_PATH;?>/css/diy.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
  <div id="main-container" class="container" style="min-height: 402px;">
    <section id="contents" style="position:relative">
    	<div class="action_wrap">
      	<div class="sider"> 
            <a class="background" id="changeBg">更换背景</a> 
            <a class="module" onclick="alert('还没有现成模板');">现成模板</a> 
            <!--
            <a class="preview" id="preview">预览</a>
            --> 
            <a class="save" id="saveLayout">保存</a> 
        </div>
        </div>
      <div class="iphone">
        <div class="i_top"></div>
        <div class="i_mid">
          <div class="area" style="<?php if(!empty($background)): ?>background-image:url(<?php echo ($background); ?>);<?php endif; ?> background-repeat:no-repeat;">
            <div id="phoneArea" data-bgid="初始化背景ID"> 
              <!-- 模板预填充输出 -->
              
              <?php if(is_array($layouts)): $i = 0; $__LIST__ = $layouts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$layout): $mod = ($i % 2 );++$i;?><!-- 每行的布局处理 -->
                
                <div data-type="<?php echo ($layout["type"]); ?>" class="layout_row">
                  <?php if(is_array($layout["widgets"])): $i = 0; $__LIST__ = $layout["widgets"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$widget): $mod = ($i % 2 );++$i;?><!-- 每个布局里的模块处理 -->

                 <?php if(empty($widget["widget_id"])): ?><div class="layout_item">
                     <div class="item_content"></div>                 
                 </div>
                 <?php else: ?>
                  <div class="layout_item function_edit" 
                      data-param="" 
                      data-name="<?php echo ($widget["widget_name"]); ?>" data-id="<?php echo ($widget["widget_id"]); ?>" 
                      data-set= "<?php echo addons_url("Diy://Diy/param", array('widget'=>$widget[widget_name]));?>" 
                      data-html="<?php echo addons_url("Diy://Widget/getTemplateCode");?>" 
                      data-save="<?php echo addons_url("Diy://widget/saveTemplateCode");?>">
						<!--模块具体的HTML输出-->                     
                    	<div class="item_content"><?php echo ($widget["html"]); ?></div>
                  </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                  <!-- 每个布局里的模块处理 end-->
                </div>
                <!-- 每行的布局处理 end--><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="add_layout">添加布局单元</div>
            
          </div>
        </div>
        <div class="i_bottom"></div>
      </div>
    </section>
  </div>
  <!-- 布局对话框 -->
  <div id="layoutModule" class="diy_dialog">
    <h6>布局管理<span class="dialog_close">X</span></h6>
    <div class="content">
    	<span style="padding-left:20px">请选择一个布局</span>
    	<div class="sys_layout">
          <div class="layout" data-type="1"> <img src="<?php echo ADDON_PUBLIC_PATH;?>/img/layout_1.png" />通栏布局 </div>
          <div class="layout" data-type="1:1"> <img src="<?php echo ADDON_PUBLIC_PATH;?>/img/layout_1-1.png" />1:1布局 </div>
          <div class="layout" data-type="1:2"> <img src="<?php echo ADDON_PUBLIC_PATH;?>/img/layout_1-2.png" />1:2布局 </div>
          <div class="layout" data-type="1:3"> <img src="<?php echo ADDON_PUBLIC_PATH;?>/img/layout_1-3.png" />1:3两栏布局 </div>
          <div class="layout" data-type="1:1:1"> <img src="<?php echo ADDON_PUBLIC_PATH;?>/img/layout_1-1-1.png" />1:1:1布局 </div>
          <div class="layout" data-type="1:1:1:1"> <img src="<?php echo ADDON_PUBLIC_PATH;?>/img/layout_1-1-1-1.png" />1:1:1:1布局</div>
      	</div>
      	<div class="form-item" style="padding-left:20px;">
            <label class="item-label" style="width:auto">也可以自定义布局:<span class="check-tips"></span></label>
            <div class="controls">
                <input style="width:100px" type="text" name="type" id="selfType" class="text input-large" value="">
                <span class="check-tips" style="color:#aaa">示例：1:1:1为三等分布局，1:2为1比2两栏布局，请谨慎填写！</span>
                <br/>
                <button type="button" id="confirmLayout" class="btn submit-btn" target-form="form-horizontal">确 定</button>
            </div>
        </div>
    </div>
  </div>
  <!-- 功能对话框 -->
  <div id="functionModule" class="diy_dialog">
    <h6>添加功能模块<span class="dialog_close">X</span></h6>
    <div class="content">
    <?php if(is_array($widget_list)): $i = 0; $__LIST__ = $widget_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="function" data-name="<?php echo ($vo["name"]); ?>" data-save="<?php echo ($vo["save"]); ?>" data-html="<?php echo ($vo["html"]); ?>" data-set="<?php echo ($vo["set"]); ?>"><div class="icon"><img src="<?php echo ($vo["icon"]); ?>"/></div><?php echo ($vo["title"]); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
  </div>
  <!-- 背景对话框 -->
  <div id="bgModule" class="diy_dialog">
    <h6>设置背景<span class="dialog_close">X</span></h6>
    <div class="content" style="padding:20px 55px"> 
      <!--
        	<div class="sys_piclist">
            	<div class="bg_item no_bg" data-name="bg_no">无背景</div>
                
                <?php $__FOR_START_3542__=1;$__FOR_END_3542__=12;for($j=$__FOR_START_3542__;$j < $__FOR_END_3542__;$j+=1){ ?><div class="bg_item" data-name="bg_<?php echo ($j); ?>"><img src="<?php echo ADDON_PUBLIC_PATH;?>/img/bg/<?php echo ($j); ?>.jpg"/></div><?php } ?>
                
            </div>
            -->
      <div class="form-item cf self_bg_item">
        <label class="item-label">自定义背景图:<span class="check-tips"></span></label>
        <div class="controls uploadrow">
          <input type="file" id="bg_upload_picture_<?php echo ($o_key); ?>">
          <input type="hidden" name="imgId" id="bg_cover_id_imgId" value=""/>
          <div class="upload-img-box">
            <?php if(!empty($form['value'])): ?><div class="upload-pre-item"><img src="/weiphp<?php echo (get_cover($form['value'],'path')); ?>"/></div><?php endif; ?>
          </div>
        </div>
        <script type="text/javascript">
                    //上传图片
                    /* 初始化上传插件 */
                    $("#bg_upload_picture_<?php echo ($o_key); ?>").uploadify({
                        "height"          : 120,
                        "swf"             : "/weiphp/Public/static/uploadify/uploadify.swf",
                        "fileObjName"     : "download",
                        "buttonText"      : "上传图片",
                        "uploader"        : "<?php echo U('home/File/uploadPicture',array('session_id'=>session_id()));?>",
                        "width"           : 120,
                        'removeTimeout'	  : 1,
                        'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                        "onUploadSuccess" : uploadPicture<?php echo ($o_key); ?>
                    });
					
                    function uploadPicture<?php echo ($o_key); ?>(file, data){
                        var data = $.parseJSON(data);
                        var src = '';
                        if(data.status){
							$("#bg_cover_id_imgId").val(data.id);
                            src = data.url || '/weiphp' + data.path;
                            $("#bg_cover_id_imgId").parent().find('.upload-img-box').html(
                                '<div class="upload-pre-item"><img width="120" height="120" src="' + src + '"/></div>'
                            );
                        } else {
                            var tips = $("#bg_cover_id_imgId").parents('.form-item').find('.check-tips');
                            tips.html(data.info).show();
                            setTimeout(function(){
                                tips.html('').hide();
                                $(that).removeClass('disabled').prop('disabled',false);
                            },1500);
                        }
                    }
                </script> 
      </div>
      <div class="controls">
        <button type="button" id="confirm" class="btn submit-btn ajax-post" target-form="form-horizontal">确 定</button>
      </div>
    </div>
  </div>
  <!-- 配置对话框 -->
  <div id="setDialog" class="diy_dialog">
    <h6>模块编辑<span class="dialog_close">X</span></h6>
    <!--<div class="content dialog_loading"  style="padding:0;"></div>-->
    <iframe id="paramIframe" width="900" height="500" frameborder="0"></iframe>
  </div>
  <div class="dialog_layer"></div>

 
  <script src="<?php echo ADDON_PUBLIC_PATH;?>/js/jquery-ui.min.js" type="text/javascript"></script>
  <script src="/weiphp/Public/Home/js/m/flipsnap.min.js?v=<?php echo SITE_VERSION;?>" type="text/javascript"></script>  
  <script src="/weiphp/Public/Home/js/m/mobile_module.js?v=<?php echo SITE_VERSION;?>" type="text/javascript"></script> 
  <script src="<?php echo ADDON_PUBLIC_PATH;?>/js/diy.js?v=<?php echo SITE_VERSION;?>" type="text/javascript"></script> 
  <script type="text/javascript">
  	$(function(){
		$('.layout_row').each(function(index, element) {
            initItemLayoutAndAction($(this),$(this).data('type'),true);
        });
		})
  </script>

</body>
</html>