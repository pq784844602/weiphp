<?php

namespace Addons\Hotel\Controller;

use Home\Controller\AddonsController;
use Org;

class WebController extends AddonsController {
	public $token;
    public $openid;
    public $hid = 0;
    public $offset = 8;

	function _initialize() {
		parent::_initialize();

        $this->token = get_token();
        $this->assign('token', get_token());
        if(!session("session_hotel_openid"))
        {
        	session("session_hotel_openid", get_openid() <> -1  ? get_openid() : 'guest_' . time() . rand(100000,999999) );
    	};
        $this->openid = session("session_hotel_openid");
        $this->assign('openid', $this->openid);

        $this->hid = $_SESSION["session_hotel_{get_token()}"];
        $this->assign('hid', $this->hid);
	}

    public function index1()
    {
        $hid = I('get.hid',0,'int');
        if ($hotel = M('hotel')->where(array('token' => get_token(), 'id' => $hid))->find()) {
            $_SESSION["session_hotel_{get_token()}"] = $hid;
        } else {
            $this->redirect('hotellist', array('token' => get_token(), 'openid' => $this->openid));
        }
        $dates = array();
        $dates[] = array('k' => date('Y-m-d'), 'v' => date('m月d日'));
        for ($i = 1; $i <= 90; $i++) {
            $dates[] = array('k' => date('Y-m-d', strtotime("+{$i} days")), 'v' => date('m月d日', strtotime("+{$i} days")));
        }
        
        $url_selectdata = U('selectdate',array('token' => $this->token, 'hid' => $hotel['id']));
        $url_my = U('my',array('token' => $this->token, 'hid' => $hotel['id']));
        $url_map = U('map',array('token' => $this->token, 'hid' => $hotel['id']));
        $url_about = U('about',array('token' => $this->token, 'hid' => $hotel['id']));
        
        $this->assign('hotel', $hotel);
        $this->assign('dates', $dates);
        $this->assign('url_selectdata', $url_selectdata);
        $this->assign('url_my', $url_my);
        $this->assign('url_map', $url_map);
        $this->assign('url_about', $url_about);
        $this->assign('metaTitle', $hotel['name']);
        
        $this->display();
    }

	public function index()
    {
    	$map['token'] = get_token();

        $hotel = M('hotel')->where($map)->select();
        if (count($hotel) == 1) {
            $this->redirect('selectdate', array('token' => get_token(), 'openid' => $this->openid, 'hid' => $hotel[0]['id']));
        }
        $price = M('hotel_room_type')->field('min(price1) as price, hid')->group('hid')->where($map)->select();
        $t = array();
        foreach ($price as $row) {
            $t[$row['hid']] = $row['price'];
        }
        $list = array();
        foreach ($hotel as $c) {
            if (isset($t[$c['id']])) {
                $c['price'] = $t[$c['id']];
            } else {
                $c['price'] = 0;
            }
            $list[] = $c;
        }
        // echo "<pre>";
        // print_r($list);
        // die();
        $this->assign('hotel', $list);
        $this->assign('metaTitle', '酒店列表');
        $this->display();
    }
    public function selectdate()
    {
        $hid = I('get.hid',0,'int');
        if ($hotel = M('hotel')->where(array('token' => get_token(), 'id' => $hid))->find()) {
            $_SESSION["session_hotel_{get_token()}"] = $hid;
        } else {
            $this->redirect('index', array('token' => get_token(), 'openid' => $this->openid));
        }
        $dates = array();
        $dates[] = array('k' => date('Y-m-d'), 'v' => date('m月d日'));
        for ($i = 1; $i <= 90; $i++) {
            $dates[] = array('k' => date('Y-m-d', strtotime("+{$i} days")), 'v' => date('m月d日', strtotime("+{$i} days")));
        }
        $this->assign('hotel', $hotel);
        $this->assign('dates', $dates);
        $this->assign('metaTitle', $hotel['name']);
        $this->display();
    }
    public function hotel()
    {
        $in = I('check_in_date');
        $out = I('check_out_date');
        $days = (strtotime($out) - strtotime($in)) / 86400;
        if ($days < 1) {
            $this->redirect('selectdate', array('token' => get_token(), 'openid' => $this->openid));
        }
        $in = date('Ymd', strtotime($in));
        $out = date('Ymd', strtotime($out));
        $hotel = M('hotel')->where(array('id' => $this->hid))->find();
        $types = M('hotel_room_type')->where(array('hid' => $this->hid, 'token' => get_token()))->select();
        $order = M('hotel_order')->field('sum(nums) as num, roomtype')->group('roomtype')->where(array('startdate' => array('ELT', $in), 'enddate' => array('GT', $in), 'token' => get_token(), 'hid' => $this->hid))->select();
        $t = array();
        foreach ($order as $o) {
            $t[$o['roomtype']] = $o['num'];
        }
        $list = array();
        foreach ($types as $s) {
            $s['orderRooms'] = isset($t[$s['id']]) ? $t[$s['id']] : 0;
            $list[] = $s;
        }
        $this->assign('hotel', $hotel);
        $this->assign('sday', date('m月d日', strtotime($in)));
        $this->assign('eday', date('m月d日', strtotime($out)));
        $this->assign('startdate', $in);
        $this->assign('enddate', $out);
        $this->assign('days', $days);
        $this->assign('list', $list);
        $this->assign('metaTitle', $hotel['name']);
        $this->display();
    }
    public function order()
    {
        $in = I('startdate');
        $out = I('enddate');
        $roomtype = I('roomtype',0,'int'); 
        $days = (strtotime($out) - strtotime($in)) / 86400;
        if ($days < 1) {

            $this->redirect('selectdate',array('token' => get_token(), 'openid' => $this->openid));
        }
        if ($sort = M('hotel_room_type')->where(array('hid' => $this->hid, 'token' => get_token(), 'id' => $roomtype))->find()) {
        	$sort['price'] = $sort['price1'];
            $hotel = M('hotel')->where(array('id' => $this->hid))->find();
            $this->assign('hotel', $hotel);
            $this->assign('sort', $sort);
            $this->assign('sday', date('m月d日', strtotime($in)));
            $this->assign('eday', date('m月d日', strtotime($out)));
            $this->assign('startdate', $in);
            $this->assign('enddate', $out);
            $this->assign('days', $days);
            $this->assign('total', $days * $sort['price']);
            $this->assign('metaTitle', $hotel['name']);
            $this->display();
        }
    }
    public function saveorder()
    {
        $db = D('hotel_order');
        if (IS_POST) {
            $price = 0;
            if ($sort = M('hotel_room_type')->where(array('hid' => $this->hid, 'token' => get_token(), 'id' => $_POST['roomtype']))->find()) {
                $price = $sort['price1'];
            }
            $days = (strtotime($_POST['enddate']) - strtotime($_POST['startdate'])) / 86400;
            $sday = date('Y年m月d日', strtotime($_POST['startdate']));
            $eday = date('Y年m月d日', strtotime($_POST['enddate']));
            if ($_POST['startdate'] < date('Ymd') || $days < 1) {
                $this->error('您预定的时间不正确');
            }
            $_POST['orderid'] = $orderid = substr($this->openid, -1, 4) . date('YmdHis');
            $_POST['price'] = $_POST['num'] * $days * $price;
            $_POST['cTime'] = time();
            $_POST['mTime'] = time();
            $_POST['time'] = time();
            $_POST['status'] = 0;
            $_POST['token'] = $this->token;
            $_POST['openid'] = $this->openid;
            $_POST['hid'] = $this->hid;
            if ($db->create() !== false) {
                $action = $db->add();
                if ($action != false) {
                    $this->success('预订成功',addons_url('Hotel://Web/my', array('token' => get_token())));
                    //todo: 发送邮件或微信消息通知
                } else {
                    $this->error('操作失败');
                }
            } else {
                $this->error($db->getError());
            }
        }
    }
    public function my()
    {
        $hotel = M('hotel')->where(array('id' => $this->hid, 'token' => get_token()))->find();
        

        $orders = M('hotel_order')->where(array('token' => get_token(), 'openid' => $this->openid))->order('id desc')->limit($this->offset)->select();

        $list = array();
        foreach ($orders as $o) {
            $o['day'] = (strtotime($o['enddate']) - strtotime($o['startdate'])) / 86400;
            $o['startdate'] = date('m月d日', strtotime($o['startdate']));
            $o['enddate'] = date('m月d日', strtotime($o['enddate']));
            $list[] = $o;
        }
        $count = M('Hotels_order')->where(array('hid' => $this->hid, 'token' => get_token(), 'wecha_id' => $this->wecha_id))->count();
        $totalpage = ceil($count / $this->offset);
        $this->assign('totalpage', $totalpage);
        $this->assign('hotel', $hotel);
        $this->assign('list', $list);
        $this->assign('metaTitle', $hotel['name']);
        $this->display();
    }
    public function ajaxorder()
    {
        $hotel = M('hotel')->where(array('id' => $this->hid, 'token' => get_token()))->find();
        $page = isset($_GET['page']) && intval($_GET['page']) > 1 ? intval($_GET['page']) : 2;
        $start = ($page - 1) * $this->offset;
        $orders = M('Hotels_order')->where(array('hid' => $this->hid, 'token' => get_token(), 'wecha_id' => $this->wecha_id))->order('id desc')->limit($start . ', ' . $this->offset)->select();
        $list = array();
        foreach ($orders as $o) {
            $o['day'] = (strtotime($o['enddate']) - strtotime($o['startdate'])) / 86400;
            $o['startdate'] = date('m月d日', strtotime($o['startdate']));
            $o['enddate'] = date('m月d日', strtotime($o['enddate']));
            $o['hotelname'] = $hotel['name'];
            $list[] = $o;
        }
        $count = M('Hotels_order')->where(array('hid' => $this->hid, 'token' => get_token(), 'wecha_id' => $this->wecha_id))->count();
        $totalpage = ceil($count / $this->offset);
        $page = $totalpage > $page ? intval($page + 1) : 0;
        die(json_encode(array('page' => $page, 'data' => $list)));
    }
    public function detail()
    {
        $id = I('get.id',0,'int');
        if ($order = M('hotel_order')->where(array('hid' => $this->hid, 'token' => get_token(), 'id' => $id))->find()) {
            $hotel = M('hotel')->where(array('id' => $this->hid))->find();
            $order['startdate'] = date('m月d日', strtotime($order['startdate']));
            $order['enddate'] = date('m月d日', strtotime($order['enddate']));
            $sort = M('hotel_room_type')->where(array('hid' => $this->hid, 'token' => get_token(), 'id' => $order['roomtype']))->find();
            $order['housename'] = isset($sort['name']) ? $sort['name'] : '';
            $this->assign('hotel', $hotel);
            $this->assign('order', $order);
            $this->assign('metaTitle', $hotel['name']);
            $this->display();
        } else {
            $this->redirect('my', array('token' => get_token()));
        }
    }

    public function map()
    {
    	$hid = I('get.hid',0,'int');
        $hotel = M('hotel')->where(array('token' => get_token(), 'id' => $hid))->find();
        if($hotel){
            $this->assign('metaTitle', $hotel['name']);
        	$this->assign('hotel',$hotel);
        } else {
        	$this->error('出错啦');
        }
        
    	$this->display();
    }
}
