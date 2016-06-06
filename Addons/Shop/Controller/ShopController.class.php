<?php

namespace Addons\Shop\Controller;

use Addons\Shop\Controller\BaseController;

class ShopController extends BaseController {
	function config() {
		// 使用提示
		$param ['token'] = get_token ();
		$normal_tips = '在微信里回复商店名或者通过地址访问商店：' . addons_url ( 'Shop://Shop/index', $param ) . ' ，也可点击<a target="_blank" href="' . U ( 'index', $param ) . '">这里</a>在预览';
		$this->assign ( 'normal_tips', $normal_tips );
		
		if (IS_POST) {
			D ( 'Common/Keyword' )->set ( $_POST ['config'] ['title'], _ADDONS, 1, 0 );
		}
		
		parent::config ();
	}
	// 引导入口
	function ad() {
		echo diyPage ( '引导入口' );
	}
	// 商店首页
	function index() {
		// 增加积分
		add_credit ( 'shop', 86400 );
		
		echo diyPage ( '微商店' );
	}
	// 搜索页面+商品分类
	function search() {
		echo diyPage ( '商品分类' );
	}
	// 商品列表
	function products() {
		echo diyPage ( '商品列表' );
	}
	// 商品详情
	function detail() {
		echo diyPage ( '商品详情' );
	}
	// 购物车
	function shopping_cart() {
		$key = 'buy_list_' . $this->mid;
		$list = ( array ) session ( $key );
		foreach ( $list as $v ) {
			$ids [] = $v ['id'];
			$bug_list [$v ['id']] = $v;
		}
		
		$map ['id'] = array (
				'in',
				$ids 
		);
		$products = M ( 'shop_product' )->where ( $map )->select ();
		foreach ( $list as &$vo ) {
			$vo = array_merge ( $vo, $bug_list [$vo ['id']] );
		}
		
		$this->assign ( 'list', $products );
		$this->display ();
	}
	// 个人中心
	function personal() {
		$this->display ();
	}
}
