<?php if (!defined('THINK_PATH')) exit();?><!--通用的diy页面widget模板的基类模板-->
<!--头部标题栏-->
<!--鉴于样式title放进具体每块模块-->
<!--CSS模块-->


	<?php if(!empty($widget_title) || !empty($widget_more_title[0])): ?><div class="widget_title">
            <?php if(!empty($widget_title)): ?><h2><?php echo ($widget_title); ?></h2><?php endif; ?>
            
            <?php if(!empty($widget_more_title["0"])): if(is_array($widget_more_title)): $k = 0; $__LIST__ = $widget_more_title;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$title): $mod = ($k % 2 );++$k;?><div class="more"><a href="<?php echo ($widget_more_url[$k]); ?>"><?php echo ($title); ?></a></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div><?php endif; ?>


<!--widget内容块 一般情况widget里的显示模板继承此模板后只需要重写widget_content代码块即可-->

<section class="banner square_slide_banner banner_<?php echo ($widget_id); ?>">
    <ul>
      <?php if(is_array($imgId)): $k = 0; $__LIST__ = $imgId;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li><a href="<?php echo ($url[$k]); ?>"><img src="<?php echo (get_cover_url($vo)); ?>"/></a><span class="title"><?php echo ($title[$k]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>    
    </ul>
    <span class="identify">
    	<?php if(is_array($imgId)): $k = 0; $__LIST__ = $imgId;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><em></em><?php endforeach; endif; else: echo "" ;endif; ?>       
    </span>
    <a class="prevBtn" href="javascript:;"></a>
    <a class="nextBtn" href="javascript:;"></a>
</section>


<!--JS模块-->

<script type="text/javascript">
setTimeout(function(){
	$.WeiPHP.squarePicSlide(false,0,$('.layout_item').width(),400,'.banner_<?php echo ($widget_id); ?> .prevBtn','.banner_<?php echo ($widget_id); ?> .nextBtn');
	},400)
</script>