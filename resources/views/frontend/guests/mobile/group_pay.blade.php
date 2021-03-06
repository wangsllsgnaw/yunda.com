<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>天眼互联-科技让保险无限可能</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" href="{{config('view_url.view_url')}}mobile/css/lib/mui.min.css">
    <link rel="stylesheet" href="{{config('view_url.view_url')}}mobile/css/lib/mui.picker.all.css">
    <link rel="stylesheet" href="{{config('view_url.view_url')}}mobile/css/lib/iconfont.css" />
    <link rel="stylesheet" href="{{config('view_url.view_url')}}mobile/css/common.css" />
    <style>
        .mui-scroll-wrapper {top: .9rem;}
        .mui-bar-nav {background: #025a8d;}
        .mui-icon-back,.mui-title {color: rgba(255, 255, 255, .8);}
        .payment-header {padding: .5rem 0 .54rem;background: #fff;text-align: center;color: #FFAE00;font-size: .32rem;}
        .payment-header>i {margin-bottom: .3rem;font-size: 1.45rem;}
        .payment-table {font-size: .24rem;}
        .payment-table {padding: 0 .3rem;background: #fff;}
        .payment-table-header {height: .6rem;line-height: .6rem;border-bottom: 1px solid #dcdcdc;}
        .payment-table-content {height: 1rem;line-height: 1rem;}
        .col1 {width: 1.4rem;}
        .col3 {width: 1rem;}
        .payment-table-img {width: .8rem;height: .65rem;margin-top: 0.2rem;}
        .payment-bank {margin: .3rem;background: #fff;box-shadow: 0 0 20px 1px rgba(0, 162, 255, .1);}
        .payment-bank li {position: relative;margin: 0 .54rem;}
        .payment-bank li .iconfont {position: absolute;top: 0;right: 0;z-index: 1;height: .9rem;line-height: .9rem;font-size: .36rem;color: #00a2ff;}
        .payment-bank input {padding-left: 0;height: .9rem;line-height: .9rem;font-size: .28rem;border: none;border-radius: 0;border-bottom: 1px solid #dcdcdc;}
        .btn-payment {margin: .32rem .54rem;width: 1.6rem;height: .62rem;line-height: .62rem;background: #FFAE00;color: #fff;}
        .payment-other {padding: 1rem .3rem;width: 100%;bottom: .98rem;}
        .payment-other>div {display: inline-block;width: 49%;text-align: center;}
        .payment-other>div:first-child {border-right: 1px solid #dcdcdc;}
        .payment-other .iconfont {margin-right: .3rem;font-size: .5rem;}
        .payment-other span {font-size: .26rem;}
        .icon-weixinzhifu {color: #00c800;}
        .icon-icon-alipay {color: #25abee;}
    </style>
</head>

<body>
<div class="main">
    <header class="mui-bar mui-bar-nav">
        <a class="mui-icon mui-icon-back mui-pull-left mui-action-back"></a>
        <h1 class="mui-title">订单支付</h1>
    </header>
    <div class="mui-content">
        <div class="mui-scroll-wrapper">
            {{--<form action="{{url('/')}}" method="post" >--}}
                <div class="mui-scroll">
                    <div class="payment-header">
                        <i class="iconfont icon-chenggong2"></i>
                        <p>订单创建成功</p>
                    </div>
                    <div class="division"></div>
                        <div class="payment-table">
                            <ul>
                                <li>
                                    <div class="payment-table-header clearfix">
                                        <div class="col1 bold fl">订单编号</div>
                                        <div class="col2 fl">{{$orderData->order_code}}</div>
                                    </div>
                                    <div class="payment-table-content clearfix">
                                        <div class="col1 fl">
                                            <div class="payment-table-img">

                                            </div>
                                        </div>
                                        <div class="col2 fl"></div>
                                        <div class="col3 fr">￥{{$orderData->premium/100}}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="division"></div>
                        <div class="payment-bank" id="bank_pay" >
                            <h2 class="notice-title">银行卡支付</h2>
                            <br>
                            <ul>
                                <li><h4>保险公司银行账号：(线下转账)</h4></li>
                                <br>
                                <li><h5>{{$company_bank['bank_type']}}: {{$company_bank['bank_num']}}</h5></li>
                                <li><div id="bank_hidden"></div></li>
                            </ul>
                            <div class="text-right">
                                <button class="btn-payment" id="payDone">支付完成</button>
                            </div>
                        </div>
                </div>
                {{--</form>--}}
        </div>
    </div>
</div>
<script src="{{config('view_url.view_url')}}mobile/js/lib/jquery-1.11.3.min.js"></script>
<script src="{{config('view_url.view_url')}}mobile/js/lib/mui.min.js"></script>
<script src="{{config('view_url.view_url')}}mobile/js/lib/mui.picker.all.js"></script>
<script src="{{config('view_url.view_url')}}mobile/js/common.js"></script>
<script src="{{config('view_url.view_url')}}mobile/js/payment.js"></script>
<script>
//    $(document).ready(function(){
        $('#payDone').click(function(){
            alert('正在核保中...')
            location.href = '{{url('/')}}'
        })
//    })
//    function bank() {
//        var o = {};
//        var a = $(form).serializeArray();
//        $.each(a, function () {
//            if (o[this.name] !== undefined) {
//                if (!o[this.name].push) {
//                    o[this.name] = [o[this.name]];
//                }
//                o[this.name].push(this.value || '');
//            } else {
//                o[this.name] = this.value || '';
//            }
//        });
//
//        if(o['bank_code']=='none'){
//            alert('请选择银行');
//            return false;
//        }else if(o['card_number']==''){
//            alert('请填写银行卡号');
//            return false;
//        }else if(o['card_number'].length < 16){
//            alert('银行卡号不符合规范');
//            return false;
//        }else{
//            return true;
//        }
//    }
    {{--function get_pay_way(pay_way) {--}}
        {{--if(pay_way!=="cardPay"){--}}
            {{--Mask.loding('正在支付,请稍等!');--}}
        {{--}--}}
        {{--var token = $("input[name=_token]").val();--}}
        {{--var private_p_code = "{{$private_p_code}}";--}}
        {{--var union_order_code = "{{$union_order_code}}";--}}
        {{--$.post('/ins/get_pay_way_info',--}}
                {{--{"_token": token, 'pay_way': pay_way, 'union_order_code': union_order_code, 'private_p_code': private_p_code},--}}
                {{--function (data) {--}}
                    {{--if (data.status == 200) {--}}
                        {{--var order_code = data.content.order_code;--}}
                        {{--var pay_way_data = data.content.pay_way_data;--}}
                        {{--if (typeof pay_way_data.banks !== 'undefined') {--}}
                            {{--var banks = pay_way_data.banks;--}}
                            {{--window.banks = banks;--}}
                            {{--$('#bank_pay').css('display', 'block');--}}
                            {{--$('#choose_bank').css('display', 'none');--}}
                            {{--for (var i in banks) {--}}
                                {{--$('#select_bank').append('<option value="' + banks[i].uuid + '-' + banks[i].code + '">' + banks[i].name + '</option>');--}}
                            {{--}--}}
                        {{--} else if (typeof pay_way_data.url !== 'undefined') {--}}
                            {{--var url = pay_way_data.url;--}}
                            {{--if(pay_way !=='wechatPay'){--}}
                                {{--window.open(url, 'newwindow', '');--}}
                                {{--setInterval("get_pay_res()",10000);--}}
                            {{--}else{--}}
                                {{--Mask.img(url);--}}
                                {{--setInterval("get_pay_res()",10000);--}}
                            {{--}--}}
                        {{--}--}}
                    {{--} else {--}}
                        {{--alert(data.content);--}}
                    {{--}--}}
                {{--}--}}
        {{--);--}}
    {{--}--}}
    {{--function get_bank_info() {--}}
        {{--var bank_info = $('#select_bank option:selected') .val();--}}
        {{--var bank_infos = bank_info.split("-");--}}
        {{--$('#bank_hidden').html('<input type="hidden" name="bank_uuid" value="'+bank_infos[0]+'" ><input type="hidden" name="bank_code" value="'+bank_infos[1]+'" >');--}}
    {{--}--}}
    {{--var union_order_code = "{{$union_order_code}}";--}}
    {{--var token = $("input[name=_token]").val();--}}
    {{--function get_pay_res(){--}}
        {{--$.ajax({--}}
            {{--type: "post",--}}
            {{--dataType: "json",--}}
            {{--async: true,--}}
            {{--url: "/ins/get_pay_res",--}}
            {{--data: {union_order_code:union_order_code},--}}
            {{--headers: {--}}
                {{--'X-CSRF-TOKEN':token--}}
            {{--},--}}
            {{--success: function (data) {--}}
                {{--if(data.status=="200"){--}}
                    {{--window.location.href="/product/order_pay_sussess";--}}
                {{--}else{--}}
                    {{--alert('支付失败');--}}
                    {{--history.go(-1);return false;--}}
                {{--}--}}
            {{--}--}}
        {{--});--}}
    {{--}--}}
</script>
</body>
</html>