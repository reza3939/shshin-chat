function url(e) {
    return "rewrite" == $url_type ? "/" + e + $rewrite_prefix : "i" == $url_type ? "?i=" + e.replace(/\//, "&") : void 0
}

function theme_url(e) {
    return "theme/" != e.substr(0, 6) ? "/theme/" + $theme + "/" + e : "/" + e
}

function login(e) {
    1 == firstlogin && ($("#password").val(""), firstlogin = !1);
    var t = e.username.value;
    var serialize = $('#form').serialize();
        serialize += '&token=<?=JWT::encode(array("ip" => ip(),"key" => generateToken(45)), $loginkey, 'HS512');?>';
    return "" == t || " " == t ? ($.msgAlert({
        text: "لطفا نام خود را وارد کنید"
    }), !1) : ($("#ajax_loader").html("<center><img height='30' width='30' src='/theme/microblog/images/ajax-loader.gif'></center>"), $.ajax({
        type: "POST",
        url: url("ajax/login/multi"),
        data: serialize,
        success: function(e) {
            switch (e) {
            case "admins":
            alert("درجه دار گرامی توجه کنید : رمز شما ضعیف و نا امن است پسورد خود را پس از ورود به چت روم از تنظمیات تغییر دهید تا این پیام براتون ارسال نشود. پسورد شما باید حداقل 7 کارکتر و شامل حروف و اعداد و حداقل یکی از کاراکتر های ( &,#,$ , % , @ )  باشد . درصورت عدم گذاشتن رمز قوی مسئولیت مشکلات بعدی به عهده شما می باشد . با تشکر");
             top.location.href = url($chat_prefix);
                    break;
            case "adminsmob":
            alert("درجه دار گرامی توجه کنید : رمز شما ضعیف و نا امن است پسورد خود را پس از ورود به چت روم از تنظمیات تغییر دهید تا این پیام براتون ارسال نشود. پسورد شما باید حداقل 7 کارکتر و شامل حروف و اعداد و حداقل یکی از کاراکتر های ( &,#,$ , % , @ )  باشد . درصورت عدم گذاشتن رمز قوی مسئولیت مشکلات بعدی به عهده شما می باشد . با تشکر");
             top.location.href = url("mobile");
                    break;
                case "mobile":
                    top.location.href = url("mobile");
                    break;
                case "ok":
                    top.location.href = url($chat_prefix);
                    break;
                case "badname":
                    $.msgAlert({
                        text: "این نام در لیست سیاه قرار دارد"
                    });
                    break;
                case "benn":
                    $.msgAlert({
                        text: "شما اجازه ورود به چتروم را ندارید"
                    });
                    break;
                case "capacity":
                    $.msgAlert({
                        text: "ظرفیت چت روم پر است"
                    });
                    break;
                case "running":
                    document.getElementById("lay_pw").style.display = "block", document.getElementById("password").select(), document.getElementById("lay_gender").style.display = "none";
                    break;
                case "questionError":
                    $.msgAlert({
                        text: "جواب سئوال امنیتی شما اشتباه است"
                    });
                    break;
                case "passwh":
                    document.getElementById("lay_pw").style.display = "block", document.getElementById("password").select(), document.getElementById("lay_hide").style.display = "block", document.getElementById("lay_gender").style.display = "none";
                    break;
                case "pass":
                    $.msgAlert({
                        text: "کلمه عبور اشتباه است"
                    });
                    break;
                default:
                    try {
                        var t = jQuery.parseJSON(e);
                        "object" == typeof t ? ($("#lay_pw").slideUp(1e3), $("#question").html(t.question), $("#lay_gender").slideUp(1e3), $("#lay_hide").slideUp(1e3), $("#lay_security_question").slideDown(1e3)) : $.msgAlert({
                            text: e
                        })
                    } catch (n) {
                        $.msgAlert({
                            text: e
                        })
                    }
            }
            $("#ajax_loader").html("")
        }
    }), !1)
}! function(e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : e(jQuery)
}(function(e) {
    function t(e) {
        return s.raw ? e : encodeURIComponent(e)
    }

    function n(e) {
        return s.raw ? e : decodeURIComponent(e)
    }

    function i(e) {
        return t(s.json ? JSON.stringify(e) : String(e))
    }

    function o(e) {
        0 === e.indexOf('"') && (e = e.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, "\\"));
        try {
            e = decodeURIComponent(e.replace(a, " "))
        } catch (t) {
            return
        }
        try {
            return s.json ? JSON.parse(e) : e
        } catch (t) {}
    }

    function r(t, n) {
        var i = s.raw ? t : o(t);
        return e.isFunction(n) ? n(i) : i
    }
    var a = /\+/g,
        s = e.cookie = function(o, a, d) {
            if (void 0 !== a && !e.isFunction(a)) {
                if (d = e.extend({}, s.defaults, d), "number" == typeof d.expires) {
                    var c = d.expires,
                        l = d.expires = new Date;
                    l.setDate(l.getDate() + c)
                }
                return document.cookie = [t(o), "=", i(a), d.expires ? "; expires=" + d.expires.toUTCString() : "", d.path ? "; path=" + d.path : "", d.domain ? "; domain=" + d.domain : "", d.secure ? "; secure" : ""].join("")
            }
            for (var p = o ? void 0 : {}, u = document.cookie ? document.cookie.split("; ") : [], f = 0, m = u.length; m > f; f++) {
                var h = u[f].split("="),
                    g = n(h.shift()),
                    y = h.join("=");
                if (o && o === g) {
                    p = r(y, a);
                    break
                }
                o || void 0 === (y = r(y)) || (p[g] = y)
            }
            return p
        };
    s.defaults = {}, e.removeCookie = function(t, n) {
        return void 0 !== e.cookie(t) ? (e.cookie(t, "", e.extend({}, n, {
            expires: -1
        })), !0) : !1
    }
});
var firstlogin = !0,
    $url_type = "rewrite",
    $rewrite_prefix = "",
    $theme;
$(document).ready(function() {
    $.cookie.json = !0, $.ajax({
        url: url("ajax/login.codes"),
        dataType: "json",
        success: function(e) {
            for (var t = 0; t != e.codes.length; t++) "top" == e.codes[t].location ? $("body").prepend(e.codes[t].code) : "bottom" == e.codes[t].location && $("body").append(e.codes[t].code);
            for (var n = !1, t = 0; t != e.ads.length; t++) switch (e.ads[t].type) {
                case "fixedbanner":
                    var i;
                    switch (e.ads[t].location) {
                        case "top-right":
                            i = "right:0;top:0";
                            break;
                        case "top-left":
                            i = "left:0;top:0";
                            break;
                        case "bottom-left":
                            i = "left:0;bottom:0";
                            break;
                        case "bottom-right":
                            i = "right:0;bottom:0"
                    }
                    var o = "";
                    "true" == e.ads[t].inputs.closeable && (o = '<div style="height: 20px; line-height: 23px; background-color: #FFD8EA; cursor: pointer; text-align: center;font-size:11px" onclick="$(this).parent().hide();">بستن [x]</div>');
                    var r = '<div id="ad-' + e.ads[t].id + '" style="position: fixed;' + i + ';background-color:transparent; z-index: 1000;">' + o + '<a target="_blank" href="' + e.ads[t].url + '"><img src="' + theme_url(e.ads[t].inputs.banner) + '" border="0"></a></div>';
                    $("body").append(r), $("#ad-" + e.ads[t].id + " img").load(function() {
                        $(this).parent().parent().css({
                            width: $(this).width() + "px",
                            height: $(this).height() + 20 + "px"
                        })
                    });
                    break;

                case "popup":
                case "newtab":
                    if (0 == $("#popuplink").length) {
                        var r = '<div id="popuplink" style="position: fixed;left:0;top:0;width:100%;height:100%;z-index:99999"></div>';
                        $("body").append(r)
                    }
                    if ($("#popuplink").attr("ads")) {
                        var a = $("#popuplink").attr("ads");
                        a = a.split(",")
                    } else var a = new Array;
                    a.push(t), $("#popuplink").attr("ads", a.join(",")), $("#popuplink").one("click", function() {
                        if (1 == n) return !1;
                        n = !0;
                        var t = $.cookie("Dads");
                        if ("undefined" == typeof t) t = {};
                        else if ("string" == typeof t) try {
                            t = $.parseJSON(t)
                        } catch (i) {
                            t = {}, t = $.cookie("Dads", "")

                        }
                        var o = $(this).attr("ads");
                        o = o.split(",");
                        for (var r = 0; r != o.length; r++) {
                            var a = e.ads[o[r]];
                            (0 == a.inputs.cockie || "undefined" == typeof t["ad-" + a.id]) && ("popup" == a.type ? (window.open(a.url, "link" + a.id, "height=400,width=600,scrollbars=yes"), window.focus()) : "newtab" == a.type && (window.open(a.url, "_blank"), window.focus()), 0 != a.inputs.cockie && (t["ad-" + a.id] = a.inputs.cockie))
                        }
                        $("#popuplink").hide(), $("#popuplink").remove(), $.cookie("Dads", t)
                    })
            }
        }
    })
});