<?php

namespace Addons\Donate;
use Common\Controller\Addon;

/**
 * 捐款插件
 * @author Joson
 */

    class DonateAddon extends Addon{

        public $info = array(
            'name'=>'Donate',
            'title'=>'捐款',
            'description'=>'用于学校、基金、协会等机构接受捐款',
            'status'=>1,
            'author'=>'Joson',
            'version'=>'0.1',
            'has_adminlist'=>0,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/Donate/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Donate/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }