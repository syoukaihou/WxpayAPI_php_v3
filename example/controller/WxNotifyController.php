<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 2016/7/31
 * Time: 16:35
 */

namespace controller\wxpay;


use services\wxpay\WxNotifyServices;

class WxNotifyController
{
    public function notify()
    {
        \Log::DEBUG("begin notify");
        $notify = new WxNotifyServices();
        $notify->Handle(false);
    }

}