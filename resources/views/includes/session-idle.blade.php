<!--begin::Session Timeout -->
@php($auth_user = getAuthUser())
@php($session_idle_time = sessionIdleTime()*60*1000-20000)
@if(!is_null($auth_user) && $auth_user->remember_token==null)
<script type="text/javascript">
	! function(a) {
	    "use strict";
	    a.sessionTimeout = function(b) {
	        function c() {
	            n || (a.ajax({
	                type: i.ajaxType,
	                url: i.keepAliveUrl,
	                data: i.ajaxData
	            }), n = !0, setTimeout(function() {
	                n = !1
	            }, i.keepAliveInterval))
	        }
	        function d() {
	            clearTimeout(g), (i.countdownMessage || i.countdownBar) && f("session", !0), "function" == typeof i.onStart && i.onStart(i), i.keepAlive && c(), g = setTimeout(function() {
	                "function" != typeof i.onWarn ? a("#session-timeout-dialog").modal("show") : i.onWarn(i), e()
	            }, i.warnAfter)
	        }
	        function e() {
	            clearTimeout(g), a("#session-timeout-dialog").hasClass("in") || !i.countdownMessage && !i.countdownBar || f("dialog", !0), g = setTimeout(function() {
	                "function" != typeof i.onRedir ? window.location = i.redirUrl : i.onRedir(i)
	            }, i.redirAfter - i.warnAfter)
	        }
	        function f(b, c) {
	            clearTimeout(j.timer), "dialog" === b && c ? j.timeLeft = Math.floor((i.redirAfter - i.warnAfter) / 1e3) : "session" === b && c && (j.timeLeft = Math.floor(i.redirAfter / 1e3)), i.countdownBar && "dialog" === b ? j.percentLeft = Math.floor(j.timeLeft / ((i.redirAfter - i.warnAfter) / 1e3) * 100) : i.countdownBar && "session" === b && (j.percentLeft = Math.floor(j.timeLeft / (i.redirAfter / 1e3) * 100));
	            var d = a(".countdown-holder"),
	                e = j.timeLeft >= 0 ? j.timeLeft : 0;
	            if (i.countdownSmart) {
	                var g = Math.floor(e / 60),
	                    h = e % 60,
	                    k = g > 0 ? g + "m" : "";
	                k.length > 0 && (k += " "), k += h + "s", d.text(k)
	            } else d.text(e + "s");
	            i.countdownBar && a(".countdown-bar").css("width", j.percentLeft + "%"), j.timeLeft = j.timeLeft - 1, j.timer = setTimeout(function() {
	                f(b)
	            }, 1e3)
	        }
	        var g, h = {
	                title: "@lang('common.session.expire_alert')",
                    message: "@lang('common.session.expire_alert')",
                    logoutButton: "@lang('common.session.logout')",
                    keepAliveButton: "@lang('common.session.stay_connected')",
	                keepAliveUrl: "/keep-alive",
	                ajaxType: "POST",
	                ajaxData: "",
	                redirUrl: "{{route('redirect')}}",
	                logoutUrl: "{{route('sessionDestroy')}}",
	                warnAfter: 9e5,
	                redirAfter: 12e5,
	                keepAliveInterval: 5e3,
	                keepAlive: !0,
	                ignoreUserActivity: !1,
	                onStart: !1,
	                onWarn: !1,
	                onRedir: !1,
	                countdownMessage: !1,
	                countdownBar: !1,
	                countdownSmart: !1
	            },
	            i = h,
	            j = {};
	        if (b && (i = a.extend(h, b)), i.warnAfter >= i.redirAfter) return console.error("{{trans('sending_nodes.include_common_script_blade.return_bootstrap_session')}}"), !1;
	        if ("function" != typeof i.onWarn) {
	            var k = i.countdownMessage ? "<p>" + i.countdownMessage.replace(/{timer}/g, '<span class="countdown-holder"></span>') + "</p>" : "",
	                l = i.countdownBar ? '<div class="progress"><div class="progress-bar bg-success progress-bar-striped countdown-bar active" role="progressbar" style="min-width: 15px; width: 100%;"><span class="countdown-holder"></span></div></div>' : "";
	            a("body").append('<div class="modal fade" id="session-timeout-dialog" tabindex="-1" role="dialog" aria-labelledby="integration" data-backdrop="static" data-keyboard="false" aria-modal="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">' + i.title + '</h4></div><div class="modal-body"><p>' + i.message + "</p> " + k + "  " + l + ' </div><div class="modal-footer"><button id="session-timeout-dialog-logout" type="button" class="btn btn-default btn-sm">' + i.logoutButton + '</button><button id="session-timeout-dialog-keepalive" type="button" class="btn btn-success btn-sm" data-dismiss="modal">' + i.keepAliveButton + '</button></div></div></div></div><form id="logout-frm" action="{{route('sessionDestroy')}}" method="POST" style="display: none;"><input type="hidden" name="_token" value="{{Session::token()}}"><input type="hidden" name="user_id" value="{{Auth::id()}}"></form>'), a("#session-timeout-dialog-logout").on("click", function() {
            $('#logout-frm').submit();
	            }), a("#session-timeout-dialog").on("hide.bs.modal", function() {
	                d()
	            })
	        }
	        if (!i.ignoreUserActivity) {
	            var m = [-1, -1];
	            a(document).on("keyup mouseup mousemove touchend touchmove", function(b) {
	                if ("mousemove" === b.type) {
	                    if (b.clientX === m[0] && b.clientY === m[1]) return;
	                    m[0] = b.clientX, m[1] = b.clientY
	                }
	                d(), a("#session-timeout-dialog").length > 0 && a("#session-timeout-dialog").data("bs.modal") && a("#session-timeout-dialog").data("bs.modal").isShown && (a("#session-timeout-dialog").modal("hide"), a("body").removeClass("modal-open"), a("div.modal-backdrop").remove())
	            })
	        }
	        var n = !1;
	        d()
	    }
	}(jQuery);
	"use strict";
	var KTSessionTimeoutDemo = function () {
	    var initDemo = function () {
	        $.sessionTimeout({
	            title: '{{trans('settings.app_setting.pop_up_label.idle_timeout')}}',
	            message: '{{trans('settings.app_setting.alert.before_logout')}}',
	            keepAliveUrl: '{{route('sessionAlive')}}',
	            redirUrl: '{{route('redirect')}}',
	            logoutUrl: '{{route('sessionDestroy')}}',
	            warnAfter: {{$session_idle_time}}, //warn after 5 seconds
	            redirAfter: {{$session_idle_time}}+21000, //redirect after 10 secons,
	            ignoreUserActivity: true,
	            countdownMessage: 'Logout in {timer} seconds.',
	            countdownBar: true
	        });
	    }
	    return {
	        //main function to initiate the module
	        init: function () {
	            initDemo();
	        }
	    };
	}();
	jQuery(document).ready(function() {  
		setTimeout(function(){ KTSessionTimeoutDemo.init(); }, 16000);  
	    
	});
</script>
@endif

<!--end::Session Timeout -->