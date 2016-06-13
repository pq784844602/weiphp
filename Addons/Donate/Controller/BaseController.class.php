<?php

namespace Addons\Donate\Controller;

use Home\Controller\AddonsController;

class BaseController extends AddonsController {
	var $config;
	function _initialize() {
		parent::_initialize();
		
		$controller = strtolower ( _CONTROLLER );
		
		$res ['title'] = '捐款设置';
		$res ['url'] = addons_url ( 'Donate://Donate/config' );
		$res ['class'] = $controller == 'donate' ? 'current' : '';
		$nav [] = $res;

		$res ['title'] = '微信支付设置';
		$res ['url'] = addons_url ( 'Donate://Pay/config' );
		$res ['class'] = $controller == 'pay' ? 'current' : '';
		$nav [] = $res;		

		$res ['title'] = '捐款分类';
		$res ['url'] = addons_url ( 'Donate://Category/lists' );
		$res ['class'] = $controller == 'category' ? 'current' : '';
		$nav [] = $res;
		

		$res ['title'] = '捐款记录';
		$res ['url'] = addons_url ( 'Donate://list/lists' );
		$res ['class'] = $controller == 'list' ? 'current' : '';
		$nav [] = $res;	

		$res ['title'] = '二维码捐款分类';
		$res ['url'] = addons_url ( 'Donate://CategoryCode/lists' );
		$res ['class'] = $controller == 'categorycode' ? 'current' : '';
		$nav [] = $res;

		$res ['title'] = '二维码捐款记录';
		$res ['url'] = addons_url ( 'Donate://ListCode/lists' );
		$res ['class'] = $controller == 'listCode' ? 'current' : '';
		$nav [] = $res;	
				
		$this->assign ( 'nav', $nav );
		
		$config = getAddonConfig ( 'Donate' );
		$config ['cover_url'] = get_cover_url ( $config ['cover'] );
		$config ['background'] = get_cover_url ( $config ['background'] );
		$this->config = $config;
		$this->assign ( 'config', $config );
		// dump ( $config );
		// dump(get_token());
	}
}
