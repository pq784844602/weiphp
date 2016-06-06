<?php if (!defined('THINK_PATH')) exit();?><!--通用的参数配置页面基类模板-->
<!DOCTYPE html>
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

<link href="/weiphp/Public/Home/css/module.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<script type="text/javascript" src="/weiphp/Public/static/uploadify/jquery.uploadify.min.js"></script>
<!--CSS模块-->

<link href="<?php echo ADDON_PUBLIC_PATH;?>/css/diy.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">

</head>
<body>
<div class="param_wrap">
<!--标签切换模块-->

<div class="param_tab"><a class="cur setting" href="javascript:;">参数配置</a><a class="editwidget" href="javascript:;">高级配置</a></div>


<div class="tab1">


<!--参数配置模块 一般情况widget里的param.html继承此模板后只需要重写baseSetting代码块即可-->

<form id="baseSettingForm" class="edit_module_form form-horizontal">
	<div class="form-item">
    	<label class="item-label">显示模板:<span class="check-tips"></span></label>
        <div class="controls">
			<select name="template" id="template">
					<option value="simple" <?php if(($template) == "simple"): ?>selected<?php endif; ?> >单图显示模板</option>
                    <option value="mult" <?php if(($template) == "mult"): ?>selected<?php endif; ?> >相册模板</option>
                    <option value="slideshow" <?php if(($template) == "slideshow"): ?>selected<?php endif; ?> >滚动图片模板</option>
                    <option value="lateralslide" <?php if(($template) == "lateralslide"): ?>selected<?php endif; ?> >左右滑动切换模板</option>
                    <option value="adshow" <?php if(($template) == "adshow"): ?>selected<?php endif; ?> >广告引导模板</option>

                    <option value="$widget_id" id="custom_template" <?php if(($template) == "widget_id"): ?>selected<?php endif; ?> >自定义模板</option>

			</select>
		</div>
        <a class="edithtml" href="javascript:;">编辑模板</a>
	</div>
    <?php if(!empty($title)) { foreach($title as $i=>$vo) { ?>
     <div class="form-col">
        <div class="form-item">
            <label class="item-label">封面标题:<span class="check-tips"></span></label>
            <div class="controls">
                <input type="text" name="title[<?php echo ($i); ?>]" class="text input-large" value="<?php echo ($vo); ?>">
            </div>
        </div>
        <div class="form-item cf">
            <label class="item-label">图片:<span class="check-tips"></span></label>
            <div class="controls uploadrow upload_picture_item" rel="<?php echo ($i); ?>">
                <input type="file" class="upload_picture" id="uploadImage_<?php echo ($i); ?>">
                <input type="hidden" name="imgId[<?php echo ($i); ?>]" class="img" value="<?php echo ($imgId["$i"]); ?>"/>
                <div class="upload-img-box">
                  <?php if(!empty($imgId[$i])): ?><div class="upload-pre-item"><img width="120" height="120" src="/weiphp<?php echo (get_cover($imgId["$i"],'path')); ?>"/></div><?php endif; ?>
                </div>
            </div>
           
            <!--<textarea name="picArea" id="picArea"></textarea>
            <button class="uploadBtn" type="button">上传图片</button>
            <?php echo hook('uploadImg', array('id'=>'picArea','className'=>'uploadBtn'));?>
             -->
        </div>
        <div class="form-item cf">
                <label class="item-label">超链接:<span class="check-tips"></span></label>
                <div class="controls">
                   <input type="text" name="url[<?php echo ($i); ?>]" class="text input-large" value="<?php echo ($url["$i"]); ?>">
                </div>
        </div>
        <div class="delete-item">
              <a href="javascript:;" class="deleteBtn" onclick="$(this).parents('.form-col').remove();">删除</a>
        </div>
    </div>   
    <?php } } else{ ?>
    <div class="form-col">
        <div class="form-item">
            <label class="item-label">封面标题:<span class="check-tips"></span></label>
            <div class="controls">
                <input type="text" name="title[]" class="text input-large" value="">
            </div>
        </div>
        <div class="form-item cf">
           <label class="item-label">图片:<span class="check-tips"></span></label>
            <div class="controls upload_picture_item uploadrow" rel="0">
                <input type="file" class="upload_picture" id="uploadImage_0">
                <input type="hidden" name="imgId[]" class="img" value=""/>
                <div class="upload-img-box">
                  <?php if(!empty($form['value'])): ?><div class="upload-pre-item"><img width="120" height="120" src="/weiphp<?php echo (get_cover($form['value'],'path')); ?>"/></div><?php endif; ?>
                </div>
            </div>
             <!--
            <textarea name="picArea" id="picArea"></textarea>
            <button class="uploadBtn" type="button">上传图片</button>
            <?php echo hook('uploadImg', array('id'=>'picArea','className'=>'uploadBtn'));?>-->
        </div>
        <div class="form-item cf">
                <label class="item-label">超链接:<span class="check-tips"></span></label>
                <div class="controls">
                   <input type="text" name="url[]" class="text input-large" value="">
                </div>
        </div>
        <div class="delete-item">
              <a href="javascript:;" class="deleteBtn" onclick="$(this).parents('.form-col').remove();">删除</a>
        </div>
    </div>    
    <?php } ?>
    
    
    <div class="form-item cf" id="addPicItem" style="display:<?php if(($template) == "simple"): ?>none<?php endif; ?> ">
        <label class="item-label"></label>
        <div class="controls">
           <a href="javascript:;" id="addPic">添加</a>
        </div>
    </div>
    
    <div class="form-item cf">
    	<label class="item-label"></label>
        <div class="controls">
           <button type="button" id="confirm" class="btn submit-btn ajax-post" target-form="form-horizontal">确 定</button>
           <button type="button" class="btn preview_btn">预 览</button>
        </div>
    </div>
</form>


<!--高级配置模块-->

<form id="editwidgetForm" style="display:none" class="edit_module_form form-horizontal">
	<div class="form-item">
    	<label class="item-label">模块高度:</label>
        <div class="controls">
			<input name="widget_height" value="<?php echo ($widget_height); ?>" type="text">
            <span class="check-tips">为空时会根据内容自适应高度</span>
		</div>
	</div>
    <div class="form-item">
    	<label class="item-label">模块标题:</label>
        <div class="controls">
			<input name="widget_title" value="<?php echo ($widget_title); ?>" type="text">
            <span class="check-tips">为空时不显示模块的标题栏</span>
		</div>
	</div>
    
    <div class="form-col-more">
        <div class="form-item">
            <label class="item-label">更多标题:</label>
            <div class="controls">
                <input type="text" name="widget_more_title[]" class="text input-large" value="">
            </div>
        </div>

        <div class="form-item cf">
                <label class="item-label">超链接:<span class="check-tips"></span></label>
                <div class="controls">
                   <input type="text" name="widget_more_url[]" class="text input-large" value="">
                </div>
        </div>
        <div class="form-item cf">
            <label class="item-label"></label>
            <div class="controls">
               <a href="javascript:;" id="addWidgetMoreLink">添加</a>
                <a href="javascript:;" class="deleteBtn" onclick="$(this).parents('.form-col-more').remove();">删除</a>
            </div>
        </div>
    </div>
        	
    <div class="form-item cf">
    	<label class="item-label"></label>
        <div class="controls">
           <button type="button" id="editwidgetConfirm" class="btn submit-btn ajax-post" target-form="form-horizontal">确 定</button>
           <button type="button" class="btn preview_btn">预 览</button>
        </div>
    </div>
</form>


<!--编辑模板模块-->

    <form id="editHtmlForm" style="display:none" class="edit_module_form form-horizontal">
    <div>以下模板代码仅供有HTML等前端技术基础的用户用于高级定制，如你不熟悉代码请尽量不要修改</div>
        <textarea id="htmlTextarea" name="html"></textarea>
        <div class="form-item cf">
            
               <button type="button" id="saveHtmlBtn" class="btn submit-btn ajax-post" target-form="form-horizontal">保存</button>
        </div>
    </form>

</div>
<!--预览模块


-->
<!--JS模块-->

<script src="<?php echo ADDON_PUBLIC_PATH;?>/js/form.js?v=<?php echo SITE_VERSION;?>" type="text/javascript"></script> 
<script type="text/javascript">
//上传图片
/* 初始化上传插件 */
var node = '';
function initPuls(){
	$(".upload_picture_item").each(function(index, obj) {
		var id = $(obj).attr('rel');
		node = '#uploadImage_'+id;
		$(node).uploadify({
			"height"          : 120,
			"swf"             : "/weiphp/Public/static/uploadify/uploadify.swf",
			"fileObjName"     : "download",
			"buttonText"      : "上传图片",
			"uploader"        : "<?php echo U('home/File/uploadPicture',array('session_id'=>session_id()));?>",
			"width"           : 120,
			'removeTimeout'	  : 1,
			'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
			"onUploadSuccess" : function(file, data, response) {
                uploadPictureimage(file, data, id);
            }
	    });
	});
}

function uploadPictureimage(file, data, id){
	var data = $.parseJSON(data);
	var src = '';
	if(data.status){
		//alert(data.status)
		$("#uploadImage_"+id).parent().find('.img').val(data.id);
		src = data.url || '/weiphp' + data.path;
		$("#uploadImage_"+id).parent().find('.upload-img-box').html(
			'<div class="upload-pre-item"><img width="120" height="120" src="' + src + '"/></div>'
		);
	} else {
		updateAlert(data.info);
		setTimeout(function(){
			$('#top-alert').find('button').click();
		},1500);
	}
}
$(function(){ 
   initPuls(); 
});

$('#template').change(function(){
	var val = $(this).val();
	if(val=='mult' || val=='slideshow' || val=="lateralslide"){
			$('#addPicItem').show();
		}else{
			$('#addPicItem').hide();
			$('.form-col').eq(0).siblings('.form-col').remove();
		}
	});
$('#addPic').click(function(){
	var size = $('.form-col').size();
	var next = size;
	var $clone = "";
	 	$clone = '<div class="form-col">'+
        '<div class="form-item">'+
            '<label class="item-label">封面标题:<span class="check-tips"></span></label>'+
            '<div class="controls">'+
                '<input type="text" name="title['+next+']" class="text input-large" value="">'+
            '</div>'+
        '</div>'+
        '<div class="form-item cf">'+
            '<label class="item-label">图片:<span class="check-tips"></span></label>'+
            '<div class="controls upload_picture_item uploadrow" rel="'+next+'">'+
                '<input type="file" class="upload_picture" id="uploadImage_'+next+'">'+
                '<input type="hidden" name="imgId['+next+']" class="img" value=""/>'+
                '<div class="upload-img-box">'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="form-item cf">'+
                '<label class="item-label">超链接:<span class="check-tips"></span></label>'+
                '<div class="controls">'+
                   '<input type="text" name="url['+next+']" class="text input-large" value="">'+
                '</div>'+
        '</div>'+
        '<div class="delete-item">'+
              '<a href="javascript:;" style="diaplay:block" class="deleteBtn" onclick="$(this).parents(\'.form-col\').remove();">删除</a>'+
        '</div>'+
    '</div> '; 
	$($clone).insertBefore($(this).parents('.form-item'));
	initPuls(); 
	})
</script>

</body>
</html>