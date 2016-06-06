<?php

namespace Addons\Hotel\Controller;
use Home\Controller\AddonsController;

class HotelController extends AddonsController{
    public function _initialize()
    {
        parent::_initialize();

        $controller = strtolower ( _ACTION );
        
        $res ['title'] = '酒店管理';
        $res ['url'] = addons_url ( 'Hotel://Hotel/lists' );
        $res ['class'] = 'current';
        $nav [] = $res;

        $this->assign ( 'nav', $nav );
    }

    function roomtype() {
        $param ['hid'] = I ( 'hid', 0, 'intval' );
        $url = addons_url ( 'Hotel://Roomtype/lists', $param );
        redirect ( $url );
    }
    function room() {
        $param ['hid'] = I ( 'hid', 0, 'intval' );
        $url = addons_url ( 'Hotel://Room/lists', $param );
        redirect ( $url );
    }
    function orders() {
        $param ['hid'] = I ( 'hid', 0, 'intval' );
        $url = addons_url ( 'Hotel://Orders/lists', $param );
        redirect ( $url );
    }

}

