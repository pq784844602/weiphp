<?php

namespace Addons\Donate\Controller;
use Addons\Donate\Controller\BaseController;

class DonateController extends BaseController{
	var $model;
	function config() {
		// 使用提示
		$normal_tips = '点击<a target="_blank" href="' . U ( 'show',array('token'=>get_token ())) . '">这里</a>在预览';
		$this->assign ( 'normal_tips', $normal_tips );
		
		if (IS_POST) {
			$flag = D ( 'Common/AddonConfig' )->set ( _ADDONS, $_POST ['config'] );
			
			if ($flag !== false) {
				$this->success ( '保存成功', Cookie ( '__forward__' ) );
			} else {
				$this->error ( '保存失败' );
			}
			exit ();
		}
		
		parent::config ();
	}
	//显示捐款页面
	function show($html = 'show') {
		// var_dump($this->config);exit;
		$payConfig = D ( 'Common/AddonConfig' )->get ( 'DonatePay' );
		$map ['token'] = get_token ();
		$map ['is_show'] = 1;
		$openid =  $_COOKIE["openid"];
		// $openid ='';
		if (empty($openid) && ( !isset($_GET['state']) ||$_GET['state'] !='STATE'))
		{
			//触发微信返回code码
			$url = D('Addons://Donate/Donate')->createOauthUrlForCode();
			Header("Location: $url"); 
		}else{
			if(empty($openid)){
				$donateModel = D('Addons://Donate/Donate');
				$code = $_GET['code'];
	    		$donateModel->setCode($code);
	    		$openid = $donateModel->getOpenId();
	    		setcookie('openid',$openid,time()+60);
			}
			
			$category = M ( 'donate_category' )->where ( $map )->order ( 'sort asc, id desc' )->select ();
			$this->model = $this->getModel ( 'donate_list' );
			$this->assign ( 'category', $category );
			
			$fields = get_model_attribute ( $this->model ['id'] );
			$this->assign ( 'fields', $fields );
			$this->assign ( 'openid', $openid );
			$this->assign ( 'page_title', $this->config['title'] );
			$this->assign ('successUrl',$payConfig['SUCCESS_URL']);
			$this->display ( $html );
		}
	}

	//二维码页面
	function code($html = 'code') {
		$payConfig = D ( 'Common/AddonConfig' )->get ( 'DonatePay' );
		$map ['token'] = get_token ();
		$map ['is_show'] = 1;
		$openid =  $_COOKIE["openid"];
		if (empty($openid) && ( !isset($_GET['state']) ||$_GET['state'] !='STATE'))
		{
			//触发微信返回code码
			$return_url = "http://www.zhangzizhong.net/weiphp/index.php?s=/addon/Donate/Donate/code/token/gh_2838ce7f0ead.html";
			$url = D('Addons://Donate/Donate')->createOauthUrlForCode($return_url);
			Header("Location: $url"); 
		}else{
			if(empty($openid)){
				$donateModel = D('Addons://Donate/Donate');
				$code = $_GET['code'];
	    		$donateModel->setCode($code);
	    		$openid = $donateModel->getOpenId();
	    		setcookie('openid',$openid,time()+60);
			}
			$this->model = $this->getModel ( 'donate_list' );
			$success_url = "http://www.zhangzizhong.net/weiphp/index.php?s=/addon/Donate/Donate/success/token/gh_2838ce7f0ead.html";
			$fields = get_model_attribute ( $this->model ['id'] );
			$this->assign ( 'fields', $fields );
			$this->assign ( 'openid', $openid );
			$this->assign ( 'page_title', $this->config['title'] );
			$this->assign ('successUrl',$success_url);
			$this->display ( $html );
		}
	}
    //二维码捐款成功后页面
    function success($html = 'success')
    {
    	$map ['token'] = get_token ();
		$map ['is_show'] = 1;
		$category = M ( 'donate_code_category' )->where ( $map )->order ( 'sort asc, id desc' )->select ();
		$this->assign ( 'category', $category );
		
    	$this->model = $this->getModel ( 'donate_list_code' );
    	$fields = get_model_attribute ( $this->model ['id'] );
		$this->assign ( 'fields', $fields );
    	$this->display ( $html );
    }
    //添加捐款记录---二维码
    function addCode(){
    	$donate = D('donate_list_code');
    	$data = $donate->create();
    	if($data){
    		$pid = $donate->add('','','',true);
    		if(false !== $pid){
    			$tip = '提交成功，谢谢参与';
        		$res['status'] =1;
        		$res['info'] =$tip;
        		$this->render($res);
        		exit();
    		}
    	}
    }
	//添加捐款记录
	function add(){
		$openId = I('openId');
		if(empty($openId)){
			$openid =  $_COOKIE["openid"];
		}
		$money = I('money');
		$jsApiParameters = $this->pay($openId,$money);
		$donate = D('donate_list');
        $data = $donate->create();
       
        if(empty($money)){$this->error('捐款金额不能为空');}
        if($data){
        	$pid = $donate->add('','','',true);
        	 // var_dump($pid);exit;
        	if(false !== $pid){
        		$tip = '提交成功，谢谢参与';
        		$res['status'] =1;
        		$res['info'] =$tip;
        		$res['pay'] = $jsApiParameters;
        		$this->render($res);
        		exit();
        	}
        }else{
        	 $this->error($donate->getError());
        }
		$this->display ( 'add' );
	}


	function pay($openid,$money){
		$donateModel = D('Addons://Donate/Donate');
	    	//=========步骤2：使用统一支付接口，获取prepay_id============
			//使用统一支付接口
			
			//设置统一支付接口参数
			//设置必填参数
			//appid已填,商户无需重复填写
			//mch_id已填,商户无需重复填写
			//noncestr已填,商户无需重复填写
			//spbill_create_ip已填,商户无需重复填写
			//sign已填,商户无需重复填写
			// $openid ="oqL-UuHVgUKqZGDYahzHsor87ar0";
			$payConfig = D ( 'Common/AddonConfig' )->get ( 'DonatePay' );
			$donateModel->setParameter("openid","$openid");//商品描述
			$donateModel->setParameter("body","捐款金额");//商品描述
			//自定义订单号，此处仅作举例
			$timeStamp = time();
			$out_trade_no = $payConfig['APPID']."$timeStamp";
			$donateModel->setParameter("out_trade_no","$out_trade_no");//商户订单号 
			$donateModel->setParameter("total_fee",$money*$payConfig['WEIXIN_PAY_UNIT']);//总金额
			$donateModel->setParameter("notify_url",$payConfig['NOTIFY_URL']);//通知地址 
			$donateModel->setParameter("trade_type","JSAPI");//交易类型
			//非必填参数，商户可根据实际情况选填
			//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
			//$unifiedOrder->setParameter("device_info","XXXX");//设备号 
			//$unifiedOrder->setParameter("attach","XXXX");//附加数据 
			//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
			//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
			//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
			//$unifiedOrder->setParameter("openid","XXXX");//用户标识
			//$unifiedOrder->setParameter("product_id","XXXX");//商品ID
		
			$prepay_id = $donateModel->getPrepayId();
			// echo $prepay_id;exit();
			//=========步骤3：使用jsapi调起支付============
			$donateModel->setPrepayId($prepay_id);
		
			return $jsApiParameters = $donateModel->getParameters();
	}

	function notify(){
		echo "SUCCESS";
	}
	


}
