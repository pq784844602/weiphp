<?php

namespace Addons\Shop\Model;

use Think\Model;

/**
 * WeiSite模型
 */
class FooterModel extends Model {
	protected $tableName = 'shop_footer';
	function get_list($map) {
		$map ['token'] = get_token ();
		$list = $this->where ( $map )->order ( 'pid asc, sort asc' )->select ();
		
		foreach ( $list as &$vo ) {
			$vo ['icon'] = get_cover_url ( $vo ['icon'] );
			$vo ['icon'] && $vo ['icon'] = '<img src="' . $vo ['icon'] . '" >';
		}
		
		return $list;
	}
}
