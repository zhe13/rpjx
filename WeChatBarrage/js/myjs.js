//data	:	2015-5-31
//author:	zhe13
//email	:	wutianzhe123@gmail.com
//name 	:	基于Ajax(js2php)的弹幕系统
//
$(document).ready(function() {
	var time = getTime();
	console.log(time);
	//点击消失
	$(".showBarrage,.s_close").click(function() {
		$(".showBarrage,.barrage,.s_close").toggle("slow");
	});

	$(".showBarrage").click(function() {
		setInterval(function() {
			var time = getTime();
			var data = 'action=getlink&time=' + time;

			$.getJSON('server/barrageServer.php', data, function(json) {
				console.log('get');
				var text = json.wx
				if (text == "") {
					return;
				};
				var _lable = $("<div style='right:20px;top:0px;opacity:1;color:" + getRandomColor() + ";'>" + text + "</div>");
				$(".mask").append(_lable.show());
				init_barrage();
			});
		}, 1000);

	});
	//发射弹幕
	$(".send .s_btn").click(function() {
		var text = $(".s_text").val();
		if (text == "") {
			return;
		};
		var _lable = $("<div style='right:20px;top:0px;opacity:1;color:" + getRandomColor() + ";'>" + text + "</div>");
		$(".mask").append(_lable.show());
		init_barrage();
	})

})

//获取时间Date
function getTime() {
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth() + 1;
	var day = date.getDate();
	var hour = date.getHours();
	var minute = date.getMinutes();
	var second = date.getSeconds();
	var time = year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;
	return time;
}

//初始化弹幕技术
function init_barrage() {
	var _top = 0;
	$(".mask div").show().each(function() {
		var _left = $(window).width() - $(this).width(); //浏览器最大宽度，作为定位left的值
		var _height = $(window).height(); //浏览器最大高度

		_top += 75;
		if (_top >= (_height - 130)) {
			_top = 0;
		}
		$(this).css({
			left: _left,
			top: _top,
			color: getRandomColor()
		});

		//定时弹出文字
		var time = 10000;
		if ($(this).index() % 2 == 0) {
			time = 15000;
		}

		$(this).animate({
			left: "-" + _left + "px"
		}, time, function() {
			$(this).remove();
		});
	});
}

//获取随机颜色
function getRandomColor() {
	return '#' + (function(h) {
		return new Array(7 - h.length).join("0") + h
	})((Math.random() * 0x1000000 << 0).toString(16))
}