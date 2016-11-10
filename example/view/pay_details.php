<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>微信支付样例-支付</title>
    <script type="text/javascript">
        //调用微信JS api 支付
        function jsApiCall()
        {
            WeixinJSBridge.invoke('getBrandWCPayRequest',<?php echo $jsApiParameters; ?>,
                function(res){
                    WeixinJSBridge.log(res.err_msg);
//                    alert(res.err_code+res.err_desc+res.err_msg);
                    // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
                    // 注意这里的字符串比较中的冒号为英文的冒号!
                    if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                        window.location.href="支付成功页面的url";
                    }
                }
            );
            /*
            // 建议使用这中方式发起支付.
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest', {
                    "appId":"wx2421b1c4370ec43b",     //公众号名称，由商户传入     
                    "timeStamp":"1395712654",         //时间戳，自1970年以来的秒数     
                    "nonceStr":"e61463f8efa94090b1f366cccfbbb444", //随机串     
                    "package":"prepay_id=u802345jgfjsdfgsdg888",
                    "signType":"MD5",         //微信签名方式：     
                    "paySign":"70EA570631E4BB79628FBCA90534C63FF7FADD89" //微信签名 
                }, function(res){
                    // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
                    if(res.err_msg == "get_brand_wcpay_request:ok" ) {}     
                }
            );*/
        }

        function callpay()
        {
            if (typeof WeixinJSBridge == "undefined"){
                if( document.addEventListener ){
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                }else if (document.attachEvent){
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            }else{
                jsApiCall();
            }
        }
    </script>
</head>
<body>
<br/>
<font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">1分</span>钱</b></font><br/><br/>
<div align="center">
    <button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
</div>
</body>
</html>