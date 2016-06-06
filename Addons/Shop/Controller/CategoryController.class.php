<?php

namespace Addons\Shop\Controller;

use Addons\Shop\Controller\BaseController;

class CategoryController extends BaseController {
	var $model;
	function _initialize() {
		$this->model = $this->getModel ( 'common_category' );
		parent::_initialize ();
	}
	// 通用插件的列表模型
	public function lists() {
		$model = $this->model;
		
		// 解析列表规则
		$list_data = $this->_list_grid ( $model );
		$fields = $list_data ['fields'];
		
		// 搜索条件
		$map = $this->_search_map ( $model, $fields );
		
		$list_data ['list_data'] = $this->get_data ( $map );
		$this->assign ( $list_data );
		
		$this->display ();
	}
	function get_data($map) {
		$map ['token'] = get_token ();
		$map ['module'] = 'shop_category';
		$list = M ( 'common_category' )->where ( $map )->order ( 'pid asc, sort asc' )->select ();
		//dump($list);
	
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
	/**
	 * 显示分类树，仅支持内部调
	 *
	 * @param array $tree
	 *        	分类树
	 */
	public function tree($tree = null) {
		C ( '_SYS_GET_CATEGORY_TREE_' ) || $this->_empty ();
		$this->assign ( 'tree', $tree );
		$this->display ( T ( 'tree' ) );
	}
	// 通用插件的编辑模型
	public function edit() {
		$model = $this->model;
		$Model = D ( parse_name ( get_table_name ( $model ['id'] ), 1 ) );
		$id = I ( 'id' );
		
		if (IS_POST) {
			// 获取模型的字段信息
			$_POST ['module'] = 'shop_category';
			$Model = $this->checkAttr ( $Model, $model ['id'] );
			if ($Model->create () && $Model->save ()) {
				$this->success ( '保存' . $model ['title'] . '成功！', U ( 'lists?model=' . $model ['name'] ) );
			} else {
				$this->error ( $Model->getError () );
			}
		} else {
			// 获取一级菜单
			$map ['token'] = get_token ();
			$map ['module'] = 'shop_category';
			$map ['pid'] = 0;
			$map ['id'] = array (
					'not in',
					$id 
			);
			$list = $Model->where ( $map )->select ();
			foreach ( $list as $v ) {
				$extra .= $v ['id'] . ':' . $v ['title'] . "\r\n";
			}
			
			$fields = get_model_attribute ( $model ['id'] );
			if (! empty ( $extra )) {
				foreach ( $fields [1] as &$vo ) {
					if ($vo ['name'] == 'pid') {
						$vo ['extra'] .= "\r\n" . $extra;
					}
				}
			}
			
			// 获取数据
			$data = M ( get_table_name ( $model ['id'] ) )->find ( $id );
			$data || $this->error ( '数据不存在！' );
			
			$this->assign ( 'fields', $fields );
			$this->assign ( 'data', $data );
			$this->meta_title = '编辑' . $model ['title'];
			
			$this->display ();
		}
	}
	
	// 通用插件的增加模型
	public function add() {
		$model = $this->model;
		$Model = D ( parse_name ( get_table_name ( $model ['id'] ), 1 ) );
		// var_dump(parse_name ( get_table_name ( $model ['id'] ), 1 ));
		// exit;
		if (IS_POST) {
			// 获取模型的字段信息
			$_POST ['module'] = 'shop_category';
			$Model = $this->checkAttr ( $Model, $model ['id'] );
			if ($Model->create () && $id = $Model->add ()) {
				$this->success ( '添加' . $model ['title'] . '成功！', U ( 'lists?model=' . $model ['name'] ) );
			} else {
				$this->error ( $Model->getError () );
			}
		} else {
			// 获取一级菜单
			$map ['pid'] = 0;
			$map ['token'] = get_token ();
			$map ['module'] = 'shop_category';
			$list = $Model->where ( $map )->select ();
			foreach ( $list as $v ) {
				$extra .= $v ['id'] . ':' . $v ['title'] . "\r\n";
			}
			// var_dump($extra);exit;
			$fields = get_model_attribute ( $model ['id'] );
			if (! empty ( $extra )) {
				foreach ( $fields [1] as &$vo ) {
					if ($vo ['name'] == 'pid') {
						$vo ['extra'] .= "\r\n" . $extra;
					}
				}
			}
			
			$this->assign ( 'fields', $fields );
			$this->meta_title = '新增' . $model ['title'];
			
			$this->display ();
		}
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
	function category() {
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
}
