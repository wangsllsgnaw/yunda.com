<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>自动投保设置</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<link rel="stylesheet" href="{{config('view_url.channel_views')}}css/lib/mui.min.css">
		<link rel="stylesheet" href="{{config('view_url.channel_views')}}css/lib/iconfont.css">
		<link rel="stylesheet" href="{{config('view_url.channel_views')}}css/common.css" />
		<link rel="stylesheet" href="{{config('view_url.channel_views')}}css/index.css" />
		<link rel="stylesheet" href="{{config('view_url.channel_views')}}css/step.css" />
		<script src="{{config('view_url.channel_url')}}js/baidu.statistics.js"></script>
	</head>
	<body id="process12">
				<header class="mui-bar mui-bar-nav">
					<div class="head-img">
						<img src="{{config('view_url.channel_views')}}imges/back.png" />
					</div>
					<div class="head-title">
						<span>自动投保设置</span>
					</div>
				</header>
				<div class="mui-content" style="">
					<div class="mui-scroll-wrapper">
						<div class="mui-scroll">
							<div class="policy_list_wrapper">
								<ul class="tab" id="insure_setup">
									<li class="item">英大非机动车驾驶员意外险 <i class="iconfont icon-jiantou"></i></li>
								</ul>
						</div>
					</div>
				</div>
				</div>
		<script src="{{config('view_url.channel_views')}}js/lib/jquery-1.11.3.min.js"></script>
		<script src="{{config('view_url.channel_views')}}js/lib/mui.min.js"></script>
		<script src="{{config('view_url.channel_views')}}js/common.js"></script>
		<script type="text/javascript" charset="utf-8">
			var url = "{{config('view_url.channel_yunda_target_url')}}insure_auto";
            $('#insure_setup').on('tap',function(){
                Mask.loding();
                window.location.href = url;
            });
            $('.head-right').on('tap',function(){
                Mask.loding();
                location.href="bmapp:homepage";
            });
            $('.head-img').on('tap',function(){
                Mask.loding();
                window.history.go(-1);
            });
		</script>
	</body>
</html>