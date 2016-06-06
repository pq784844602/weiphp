<?php

namespace Addons\Shop\Controller;

use Addons\Shop\Controller\BaseController;

class PayController extends BaseController {
	public function config() {
		if (IS_POST) {
			$flag = D ( 'Common/AddonConfig' )->set ( 'ShopPay', I ( 'config' ) );
			
			if ($flag !== false) {
				$this->success ( '保存成功', Cookie ( '__forward__' ) );
			} else {
				$this->error ( '保存失败' );
			}
		}
		
		$addon ['config'] = $this->pay_fields ();
		$db_config = D ( 'Common/AddonConfig' )->get ( 'ShopPay' );
		if ($db_config) {
			foreach ( $addon ['config'] as $key => $value ) {
				! isset ( $db_config [$key] ) || $addon ['config'] [$key] ['value'] = $db_config [$key];
			}
		}
		$this->assign ( 'data', $addon );
		// dump($addon);
		
		// 使用提示
		$normal_tips = '微信支持功能正在内测中，目前此功能仅作保存配置用，完整的支付流程待内测完再再升级发布';
		$this->assign ( 'normal_tips', $normal_tips );
		
		$this->display ();
	}
	function pay_fields() {
		// define(APPID , "wxf8b4f85f3a794e77"); //appid
		// define(APPKEY ,"2Wozy2aksie1puXUBpWD8oZxiD1DfQuEaiC7KcRATv1Ino3mdopKaPGQQ7TtkNySuAmCaDCrw4xhPY5qKTBl7Fzm0RgR3c0WaVYIXZARsxzHV2x7iwPPzOz94dnwPWSn"); //paysign key
		// define(SIGNTYPE, "sha1"); //method
		// define(PARTNERKEY,"8934e7d15453e97507ef794cf7b0519d");//通加密串
		// define(APPSERCERT, "09cb46090e586c724d52f7ec9e60c9f8");
		return array (
				'APPID' => array (
						'title' => 'APPID:',
						'type' => 'text',
						'value' => '',
						'tip' => 'appid' 
				),
				'APPKEY' => array (
						'title' => 'APPKEY:',
						'type' => 'text',
						'value' => '',
						'tip' => 'paysign key' 
				),
				'SIGNTYPE' => array (
						'title' => 'SIGNTYPE:',
						'type' => 'text',
						'value' => 'sha1',
						'tip' => 'method' 
				),
				'PARTNERKEY' => array (
						'title' => 'PARTNERKEY:',
						'type' => 'text',
						'value' => '',
						'tip' => '通加密串' 
				),
				'APPSERCERT' => array (
						'title' => 'APPSERCERT:',
						'type' => 'text',
						'value' => '',
						'tip' => '' 
				) 
		);
	}
}
