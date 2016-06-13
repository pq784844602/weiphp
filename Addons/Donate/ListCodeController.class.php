<?php

namespace Addons\Donate\Controller;
use Addons\Donate\Controller\BaseController;

class ListController extends BaseController{
	var $model;
	//显示捐款记录
	function lists(){
		$res = array();
		$this->model = $this->getModel ( 'donate_list_code' );
		$map ['token'] = get_token ();
		$data = M('donate_category')->where($map)->select();
		foreach ($data as $val) {
			$res[$val['id']] = $val['title'];
		}
		session ( 'common_condition', $map );
		
		$list_data = $this->_get_model_list ( $this->model );

		foreach ($list_data['list_data'] as &$val) {
			$val['cid'] = $res[$val['cid']];
		}
		$this->assign ( $list_data );
		// dump ( $list_data );exit;
		$templateFile = $this->model ['template_list'] ? $this->model ['template_list'] : '';
		$this->display ( $templateFile );
	}


}
