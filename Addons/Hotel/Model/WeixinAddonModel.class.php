<?php

        	

namespace Addons\Hotel\Model;

use Home\Model\WeixinModel;

        	

/**

 * Hotel的微信模型

 */

class WeixinAddonModel extends WeixinModel{

	function reply($dataArr, $keywordArr = array()) {

		$config = getAddonConfig ( 'Hotel' ); // 获取后台插件的配置参数	

		$hotel = M('hotel')->where(array('token'=>get_token()))->find();
		if($hotel){
			$url = addons_url('Hotel://Web/index',array('token' => get_token(),'openid' => get_openid() ) );
			$articles [0] = array (
				'Title' => $hotel ['name'],
				'Description' => $hotel ['name'] . "\n电话：" . $hotel ['tel'] . "\n地址：" . $hotel['address'] . "\n点击进入在线订房。",
				'PicUrl' => get_cover_url($hotel['image']),
				'Url' => $url 
			);
			$this->replyNews ( $articles );
		} else {
			$this->replyText('亲，老板正在配置酒店，请稍后再来...');
		}
	} 



	// 关注公众号事件

	public function subscribe() {

		return true;

	}

	

	// 取消关注公众号事件

	public function unsubscribe() {

		return true;

	}

	

	// 扫描带参数二维码事件

	public function scan() {

		return true;

	}

	

	// 上报地理位置事件

	public function location() {

		return true;

	}

	

	// 自定义菜单事件

	public function click() {

		return true;

	}	

}

        	