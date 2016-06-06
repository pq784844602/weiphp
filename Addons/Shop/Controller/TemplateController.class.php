<?php

namespace Addons\Shop\Controller;

use Addons\Shop\Controller\BaseController;

class TemplateController extends BaseController {
	var $model = 'Diy';
	function lists($page = 0) {
		// 获取模型信息
		$model = $this->getModel ( $this->model );
		
		$map ['module'] = _ADDONS;
		session ( 'common_condition', $map );
		
		$list_data = $this->_get_model_list ( $model, $page );
		$this->assign ( $list_data );

		$this->display ();
	}
	function add() {
		$model = $this->getModel ( $this->model );
		if (IS_POST) {
			$_POST ['module'] = _ADDONS;
			$Model = D ( parse_name ( get_table_name ( $model ['id'] ), 1 ) );
			// 获取模型的字段信息
			$Model = $this->checkAttr ( $Model, $model ['id'] );
			$Model->create ();
			var_dump(I('post.'));exit();
			if ($Model->create () && $id = $Model->add ()) {
				$this->_saveKeyword ( $model, $id );
				
				$this->success ( '添加' . $model ['title'] . '成功！', U ( 'lists?model=' . $model ['name'] ) );
			} else {
				$this->error ( $Model->getError () );
			}
		} else {
			$fields = get_model_attribute ( $model ['id'] );
			
			$this->assign ( 'fields', $fields );
			$this->meta_title = '新增' . $model ['title'];
			
			$this->display ();
		}
	}
	public function edit($id = 0) {
		$model = $this->getModel ( $this->model );
		$id || $id = I ( 'id' );
		
		if (IS_POST) {
			$_POST ['module'] = _ADDONS;
			$Model = D ( parse_name ( get_table_name ( $model ['id'] ), 1 ) );
			// 获取模型的字段信息
			$Model = $this->checkAttr ( $Model, $model ['id'] );
			if ($Model->create () && $Model->save ()) {
				$this->_saveKeyword ( $model, $id );
				
				$this->success ( '保存' . $model ['title'] . '成功！', U ( 'lists?model=' . $model ['name'] ) );
			} else {
				$this->error ( $Model->getError () );
			}
		} else {
			$fields = get_model_attribute ( $model ['id'] );
			
			// 获取数据
			$data = M ( get_table_name ( $model ['id'] ) )->find ( $id );
			$data || $this->error ( '数据不存在！' );
			
			$this->assign ( 'fields', $fields );
			$this->assign ( 'data', $data );
			$this->meta_title = '编辑' . $model ['title'];
			
			$this->display ();
		}
	}
	function preview() {
		$this->_getPage ( $_REQUEST ['id'] );
	
		$this->display ();
	}
}
