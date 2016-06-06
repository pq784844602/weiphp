<?php

namespace Addons\Shop\Controller;

use Home\Controller\AddonsController;

class BaseController extends AddonsController {
	var $config;
	function _initialize() {
		parent::_initialize();
		
		$controller = strtolower ( _CONTROLLER );
		
		$res ['title'] = '商店设置';
		$res ['url'] = addons_url ( 'Shop://Shop/config' );
		$res ['class'] = $controller == 'shop' ? 'current' : '';
		$nav [] = $res;
		
		$res ['title'] = '微信支付设置';
		$res ['url'] = addons_url ( 'Shop://Pay/config' );
		$res ['class'] = $controller == 'pay' ? 'current' : '';
		$nav [] = $res;		

		$res ['title'] = '商品分类';
		$res ['url'] = addons_url ( 'Shop://Category/lists' );
		$res ['class'] = $controller == 'category' ? 'current' : '';
		$nav [] = $res;
		
		$res ['title'] = '商品管理';
		$res ['url'] = addons_url ( 'Shop://Product/lists' );
		$res ['class'] = $controller == 'product' ? 'current' : '';
		$nav [] = $res;		

		$res ['title'] = '广告位';
		$res ['url'] = addons_url ( 'Shop://Banner/lists' );
		$res ['class'] = $controller == 'banner' ? 'current' : '';
		$nav [] = $res;	
		
		$res ['title'] = '底部导航';
		$res ['url'] = addons_url ( 'Shop://Footer/lists' );
		$res ['class'] = $controller == 'footer' ? 'current' : '';
		$nav [] = $res;		

		$res ['title'] = '页面配置';
		$res ['url'] = addons_url ( 'Shop://Template/lists' );
		$res ['class'] = $controller == 'template' ? 'current' : '';
		$nav [] = $res;

		$res ['title'] = '订单管理';
		$res ['url'] = addons_url ( 'Shop://Order/lists' );
		$res ['class'] = $controller == 'order' ? 'current' : '';
		$nav [] = $res;	
				
		$this->assign ( 'nav', $nav );
		
		$config = getAddonConfig ( 'Shop' );
		$config ['cover_url'] = get_cover_url ( $config ['cover'] );
		$config ['background'] = get_cover_url ( $config ['background'] );
		$this->config = $config;
		$this->assign ( 'config', $config );
		// dump ( $config );
		// dump(get_token());
	}
}
