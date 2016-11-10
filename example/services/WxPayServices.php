<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 2016/7/25
 * Time: 22:44
 */

namespace services\wxpay;


class WxPayServices
{
    // 这里的参数我不一一列出,根据业务把方法中的变量提取到方法的参数中.
    public function wxpay($openid)
    {
        //②、统一下单
        // 这里可能出现找不到JsApiPay这个类.根据自己使用的框架解决一下
        $tools = new \JsApiPay();
        
        $input = new \WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(\WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openid);
        $order = \WxPayApi::unifiedOrder($input);
        echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
        printf_info($order);
        $jsApiParameters = $tools->GetJsApiParameters($order);

        // 获取共享收货地址js函数参数
        // $editAddress = $tools->GetEditAddressParameters();

        //③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
        /**
         * 注意：
         * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
         * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
         * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
         */
        // 返回的json数据
        return $jsApiParameters;
    }
}