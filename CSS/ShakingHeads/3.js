$(function() {
	var a, b, c, d, e, f, g, h, i, j, k;
	return c = $(window), a = $(".members-list"), b = a.find(".member"), j = {
		imageSize: 190,
		lookStraight: 30
	}, d = function(a, b, c, d) {
		var e, f, g, h, i;
		return h = a - c, i = b - d, e = Math.sqrt(h * h + i * i), e < j.lookStraight ? g = 12 : (f = Math.PI / 6, g = Math.round(Math.atan2(h, i) / f), g -= 3, g = (12 - g) % 12), g
	}, k = function(a, c) {
		var e, f;
		return f = j.imageSize, e = j.imageSize, $.each(b, function(b, g) {
			var h, i, j, k, l;
			return g = $(g), h = g.offset(), i = h.left + f / 2, j = h.top + e / 2, l = 1, k = -e * d(a, c, i, j) - l, g.css("background-position", "0px " + k + "px")
		})
	}, g = function(a) {
		return k(a.pageX, a.pageY)
	}, f = function(a) {
		var b, c, d, e, f, g, h, i, j;
		if (window.hasOwnProperty("ontouchstart") || navigator.msMaxTouchPoints > 0) {
			if (e = !1, b = 3, c = c > -b && b > c ? 0 : Math.floor(a.originalEvent.beta), d = d > -b && b > d ? 0 : Math.floor(a.originalEvent.gamma), j = {
					x: document.body.clientWidth / 2,
					y: screen.height / 2
				}, void 0 === f && (f = {
					beta: c,
					gamma: d
				}), void 0 !== window.orientation) {
				switch (window.orientation) {
					case 0:
					case 90:
						i = c, c = -d, d = i;
						break;
					case 180:
						d = -d, c = -c;
						break;
					case -90:
						i = c, c = d, d = -i
				}
				e = !0
			}
			if (0 !== c && c !== f.beta && (j.y += c, j.y > document.body.clientHeight ? j.y = document.body.clientHeight : j.y < 0 && (j.y = 0), e = !0), e) return $(window).unbind("mousemove"), g = j.x, h = j.y, k(g, h)
		}
	}, i = function(a) {
		var b, c;
		return b = a.height(), c = a.offset().top, k(a.offset().left + b / 2, c + b / 2)
	}, e = function(a) {
		var b;
		return b = $($(this).hasClass("member") ? this : "#" + $(this).data("target")), b.hasClass("back") ? (b.removeClass("back"), b.hasClass("supporter") || b.find(".full-name").addClass("transparent")) : (b.siblings(".member").removeClass("back"), b.hasClass("supporter") || (b.siblings(".member:not('.supporter')").find(".full-name").addClass("transparent"), b.find(".full-name").removeClass("transparent")), b.addClass("back")), b.hasClass("back") ? ($(window).unbind("mousemove"), $(window).unbind("deviceorientation"), i(b)) : ($(window).mousemove(g), $(window).on("deviceorientation", f), g(a))
	}, h = function() {
		return c.on("mousemove", g), c.on("deviceorientation", f), b.click(e)
	}, a.length ? h() : void 0
})