<?php

namespace Addons\Donate\Controller;

use Addons\Donate\Controller\BaseController;

class PayController extends BaseController {
	public function config() {
		if (IS_POST) {
			$flag = D ( 'Common/AddonConfig' )->set ( 'DonatePay', I ( 'config' ) );
			
			if ($flag !== false) {
				$this->success ( '保存成功', Cookie ( '__forward__' ) );
			} else {
				$this->error ( '保存失败' );
			}
		}
		
		$addon ['config'] = $this->pay_fields ();
		$db_config = D ( 'Common/AddonConfig' )->get ( 'DonatePay' );
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
						'tip' => '微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看' 
				),
				'MCHID' => array (
						'title' => 'MCHID:',
						'type' => 'text',
						'value' => '',
						'tip' => '受理商ID，身份标识' 
				),
				'KEY' => array (
						'title' => 'KEY:',
						'type' => 'text',
						'value' => '',
						'tip' => '商户支付密钥Key。审核通过后，在微信发送的邮件中查看' 
				),
				'APPSECRET' => array (
						'title' => 'APPSECRET:',
						'type' => 'text',
						'value' => '',
						'tip' => 'JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看' 
				),
				'NOTIFY_URL' => array (
						'title' => 'NOTIFY_URL:',
						'type' => 'text',
						'value' => '',
						'tip' => '异步通知url，商户根据实际开发过程设定' 
				),
				'JS_API_CALL_URL' => array (
						'title' => 'JS_API_CALL_URL:',
						'type' => 'text',
						'value' => '',
						'tip' => '获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面' 
				),
				'WEIXIN_PAY_UNIT' => array (
						'title' => 'WEIXIN_PAY_UNIT:',
						'type' => 'text',
						'value' => '',
						'tip' => '微信支付单位，100为元 ，10为角，1为分' 
				),
				'SUCCESS_URL' => array (
						'title' => 'SUCCESS_URL:',
						'type' => 'text',
						'value' => '',
						'tip' => '支付成功跳转页面' 
				),
		);
	}
}
