<?php

namespace Addons\Shop\Controller;

use Addons\Shop\Controller\BaseController;

class FooterController extends BaseController {
	var $model;
	function _initialize() {
		$this->model = $this->getModel ( 'shop_footer' );
		parent::_initialize ();
	}
	public function lists() {
		// 解析列表规则
		$list_data = $this->_list_grid ( $this->model );
		$fields = $list_data ['fields'];
		
		// 搜索条件
		$map = $this->_search_map ( $this->model, $fields );
		
		$list_data ['list_data'] = $this->get_data ( $map );
		$this->assign ( $list_data );
		
		// 使用提示
		$arr = array (
				'首页' => 'index',
				'分类' => 'search',
				'列表' => 'products',
// 				'购物车' => 'shopping_cart',
// 				'个人中心' => 'personal',
// 				'广告' => 'ad' 
		);
		$param ['token'] = get_token ();
		foreach ( $arr as $k => $a ) {
			$url = addons_url ( 'Shop://Shop/' . $a, $param );
			$url = str_replace ( SITE_URL, '{site_url}', $url );
			$tip .= $k . ': ' . $url . '<br/>';
		}
		$normal_tips = '常用的底部地址：<br/>' . $tip;
		$this->assign ( 'normal_tips', $normal_tips );
		
		$this->display ();
	}
	function get_data($map) {
		$list = D ( 'Addons://Shop/Footer' )->get_list ( $map );
		
		// 取一级菜单
		foreach ( $list as $k => $vo ) {
			if ($vo ['pid'] != 0)
				continue;
			
			$one_arr [$vo ['id']] = $vo;
			unset ( $list [$k] );
		}
		
		foreach ( $one_arr as $p ) {
			$data [] = $p;
			
			$two_arr = array ();
			foreach ( $list as $key => $l ) {
				if ($l ['pid'] != $p ['id'])
					continue;
				
				$l ['title'] = '├──' . $l ['title'];
				$two_arr [] = $l;
				unset ( $list [$key] );
			}
			
			$data = array_merge ( $data, $two_arr );
		}
		
		return $data;
	}
	public function edit() {
		$Model = D ( parse_name ( get_table_name ( $this->model ['id'] ), 1 ) );
		$id = I ( 'id' );
		
		if (IS_POST) {
			// 获取模型的字段信息
			$Model = $this->checkAttr ( $Model, $this->model ['id'] );
			if ($Model->create () && $Model->save ()) {
				$this->success ( '保存' . $this->model ['title'] . '成功！', U ( 'lists?model=' . $this->model ['name'] ) );
			} else {
				$this->error ( $Model->getError () );
			}
		} else {
			// 获取一级菜单
			$map ['token'] = get_token ();
			$map ['pid'] = 0;
			$map ['id'] = array (
					'not in',
					$id 
			);
			$list = $Model->where ( $map )->select ();
			foreach ( $list as $v ) {
				$extra .= $v ['id'] . ':' . $v ['title'] . "\r\n";
			}
			
			$fields = get_model_attribute ( $this->model ['id'] );
			if (! empty ( $extra )) {
				foreach ( $fields [1] as &$vo ) {
					if ($vo ['name'] == 'pid') {
						$vo ['extra'] .= "\r\n" . $extra;
					}
				}
			}
			
			// 获取数据
			$data = M ( get_table_name ( $this->model ['id'] ) )->find ( $id );
			$data || $this->error ( '数据不存在！' );
			
			$this->assign ( 'fields', $fields );
			$this->assign ( 'data', $data );
			$this->meta_title = '编辑' . $this->model ['title'];
			
			$this->display ();
		}
	}
	public function add() {
		$Model = D ( parse_name ( get_table_name ( $this->model ['id'] ), 1 ) );
		
		if (IS_POST) {
			// 获取模型的字段信息
			$Model = $this->checkAttr ( $Model, $this->model ['id'] );
			if ($Model->create () && $id = $Model->add ()) {
				$this->success ( '添加' . $this->model ['title'] . '成功！', U ( 'lists?model=' . $this->model ['name'] ) );
			} else {
				$this->error ( $Model->getError () );
			}
		} else {
			// 获取一级菜单
			$map ['pid'] = 0;
			$list = $Model->where ( $map )->select ();
			foreach ( $list as $v ) {
				$extra .= $v ['id'] . ':' . $v ['title'] . "\r\n";
			}
			
			$fields = get_model_attribute ( $this->model ['id'] );
			if (! empty ( $extra )) {
				foreach ( $fields [1] as &$vo ) {
					if ($vo ['name'] == 'pid') {
						$vo ['extra'] .= "\r\n" . $extra;
					}
				}
			}
			
			$this->assign ( 'fields', $fields );
			$this->meta_title = '新增' . $this->model ['title'];
			
			$this->display ();
		}
	}
	
	// 通用插件的删除模型
	public function del() {
		parent::common_del ( $this->model );
	}
	// 底部导航
	function template() {
		$this->display ();
	}
}
