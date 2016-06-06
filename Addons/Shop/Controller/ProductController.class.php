<?php

namespace Addons\Shop\Controller;

use Addons\Shop\Controller\BaseController;

class ProductController extends BaseController {
	var $model;
	function _initialize() {
		$this->model = $this->getModel ( 'shop_product' );
		parent::_initialize ();
	}
	// 通用插件的列表模型
	public function lists() {
		$map ['token'] = get_token ();
		session ( 'common_condition', $map );
		
		$list_data = $this->_get_model_list ( $this->model );
		foreach ( $list_data ['list_data'] as &$vo ) {
			$vo ['icon'] = '<img src="' . get_cover_url ( $vo ['icon'] ) . '" width="50px" >';
		}
		$this->assign ( $list_data );
		// dump ( $list_data );
		//dump ( M ( 'shop_product' )->selectPage ( 1 ) );
		//exit ();
		
		$templateFile = $this->model ['template_list'] ? $this->model ['template_list'] : '';
		$this->display ( $templateFile );
	}
	// 通用插件的编辑模型
	public function edit() {
		parent::common_edit ( $this->model );
	}
	
	// 通用插件的增加模型
	public function add() {
		parent::common_add ( $this->model );
	}
	
	// 通用插件的删除模型
	public function del() {
		parent::common_del ( $this->model );
	}
	// 首页
	function index() {
		$this->display ();
	}
	// 分类列表
	function product() {
		$this->display ();
	}
	// 相册模式
	function picList() {
		$this->display ();
	}
	// 详情
	function detail() {
		$this->display ();
	}
	
	// 加入购物车
	function buy() {
		$id = I ( 'id', 0, 'intval' );
		if (empty ( $id ))
			return false;
		
		$prodct ['id'] = $id; // 商品ID
		$prodct ['count'] = I ( 'count', 1, 'intval' ); // 购买数
		$prodct ['param'] = I ( 'param' ); // 其它参数，如颜色、大小等
		
		$key = 'buy_list_' . $this->mid;
		$list = ( array ) session ( $key );
		
		$list [] = $prodct;
		session ( $key, $list );
	}
}
