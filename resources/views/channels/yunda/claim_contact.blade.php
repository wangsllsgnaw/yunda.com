<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>申请理赔</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<link rel="stylesheet" href="{{config('view_url.channel_views')}}css/lib/mui.min.css">
		<link rel="stylesheet" href="{{config('view_url.channel_views')}}css/lib/iconfont.css">
		<link rel="stylesheet" href="{{config('view_url.channel_views')}}css/common.css" />
		<link rel="stylesheet" href="{{config('view_url.channel_views')}}css/index.css" />
		<link rel="stylesheet" href="{{config('view_url.channel_views')}}css/step.css" />
		<script src="{{config('view_url.channel_views')}}js/baidu.statistics.js"></script>
		<style>
			.btn-next{display: block;margin: .4rem auto;width: 90%;color: #744c22;background: #f6d85f;}
		</style>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
			<div class="head-left">
				<div class="head-img">
					<i class="iconfont icon-fanhui"></i>
				</div>
			</div>
			<div class="head-right">
				<i class="iconfont icon-close"></i>
			</div>
			<div class="head-title">
				<span>申请理赔</span>
			</div>
		</header>
		<div>
			<form action="{{config('view_url.channel_yunda_target_url')}}claim_result?token={{$_GET['token']}}" method="post" id="claim_result">
				<input type="hidden" name="input" value="{{json_encode($data)}}">
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll">
						<div>
							<ul class="process-wrapper">
								<li class="active"><div class="icon"></div><div>出险人员</div></li>
								<li class="active"><div class="icon"></div><div>出险类型</div></li>
								<li class="active"><div class="icon"></div><div>出险信息</div></li>
								<li class="active"><div class="icon"></div><div>联系方式</div></li>
							</ul>
							<ul class="form-wrapper">
								<li style="font-weight: bold;">联系方式</li>
								<li>姓名<input type="text" name="contact_name" value="" placeholder="请输入"/></li>
								<li>手机号码<input type="text" name="phone" value="" placeholder="请输入" maxlength="11"/></li>
								<li>电子邮箱<input type="text" name="email" value="" placeholder="请输入"/></li>
							</ul>
							<button id="next" disabled class="btn btn-next">确认并提交</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<script src="{{config('view_url.channel_views')}}js/lib/jquery-1.11.3.min.js"></script>
		<script src="{{config('view_url.channel_views')}}js/lib/mui.min.js"></script>
		<script src="{{config('view_url.channel_views')}}js/common.js"></script>
		<script>
			var $inputs = $('input'),$next = $('#next');
			$inputs.bind('input propertychange', function() {  
			  $inputs.each(function(index){
			  	if(!$(this).val()){
			  		$next.prop('disabled',true)
			  		return
			  	}
			  	if(index == $inputs.length-1){
			  		$next.prop('disabled',false)
			  	}
			  })
			});
            $('#next').on('click', function () {
                var name = $("input[name='contact_name']").val();
                var phone = $("input[name='phone']").val();
                var email = $("input[name='email']").val();
                if (name.length <= 1) {
                    Mask.alert('姓名不合法', 3);
                    return false;
                }
				if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test(phone))){
                    Mask.alert('请输入正确的手机号', 3);
                    return false;
				}
                if(!(/^([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)$/.test(email))){
                    Mask.alert('请输入正确的邮箱地址', 3);
                    return false;
                }
            });

            $('.head-right').on('tap',function () {
                location.href = "bmapp:homepage";return false;
            });
            $('.head-left').on('tap',function(){
                history.back(-1);return false;
            });
		</script>
	</body>

</html>