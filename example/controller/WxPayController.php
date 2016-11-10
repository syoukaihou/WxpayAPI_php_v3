<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 2016/7/25
 * Time: 22:43
 */

namespace controller\wxpay;

use services\wxpay\WxPayServices;

/**
 * 这里涉及到[设置测试目录],例如你设置的测试目录为:
 * www.baoge.com/weixin/test/
 * 那么这个controller的调用地址必须在test/之后才有效,例如:
 * www.baoge.com/weixin/test/pay
 * Class WxPayController
 * @package controller\wxpay
 */
class WxPayController
{

    public function doPay()
    {
        // openid 可以从在获取到openid的时候放到session中
        $openid = "";
        $wxPayServices = new WxPayServices();
        $jsApiParameters = $wxPayServices->wxpay($openid);
        // 返回支付详情的页面,并把获取的统一下单得到json串串给页面
        // 这个页面描述了买的啥,多少钱,支付按钮之类的
        // 在这个页面点击支付的时候可能出现找不到appId的错误.建议你按照文档上的写法发起支付.
        // 例子我在支付页面里的js给出了demo
        return view("pay_detials",compact($jsApiParameters));
    }
}