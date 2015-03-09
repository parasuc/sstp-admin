$.extend({
	setAjaxForm : function(c, d) {
		if ($(document).data("setAjaxForm:" + c)) {
			return
		}
		form = $(c);
		var b = {
			target : null,
			timeout : 30000,
			dataType : "json",
			success : function(g) {
				$.enableForm(c);
				var h = $(c).find(":input[type=submit], .submit");
				if ($.type(g) != "object") {
					if (g) {
						return bootbox.alert(g)
					}
					return bootbox.alert("No response.")
				}
				if (g.result == "success") {
					if (g.message && g.message.length) {
						h.popover({
							trigger : "manual",
							content : g.message,
							placement : "right"
						}).popover("show");
						h.next(".popover").addClass("popover-success");
						function f() {
							h.popover("destroy")
						}
						setTimeout(f, 2000)
					}
					if ($.isFunction(d)) {
						return d(g)
					}
					if ($("#responser").length && g.message
							&& g.message.length) {
						$("#responser").html(g.message).addClass(
								"red f-12px").show().delay(3000)
								.fadeOut(100)
					}
					if (g.closeModal) {
						setTimeout($.closeModal, 1200)
					}
					if (g.callback) {
						var j = window[g.callback];
						if ($.isFunction(j)) {
							if (j() === false) {
								return
							}
						}
					}
					if (g.locate) {
						var l = g.locate == "reload" ? location.href
								: g.locate;
						setTimeout(function() {
							location.href = l
						}, 1200)
					}
					if (g.ajaxReload) {
						var e = $(g.ajaxReload);
						if (e.length === 1) {
							e.load(document.location.href + " "
									+ g.ajaxReload, function() {
								e.dataTable();
								e.find('[data-toggle="modal"]')
										.modalTrigger()
							})
						}
					}
					return true
				}
				if ($.type(g.message) == "string") {
					if ($("#responser").length == 0) {
						h.popover({
							trigger : "manual",
							content : g.message,
							placement : "right"
						}).popover("show");
						h.next(".popover").addClass("popover-danger");
						function f() {
							h.popover("destroy")
						}
						setTimeout(f, 2000)
					}
					$("#responser").html(g.message).addClass(
							"red small text-danger").show().delay(5000)
							.fadeOut(100)
				}
				if ($.type(g.message) == "object") {
					$.each(g.message, function(n, r) {
						var o = "#" + n;
						var q = n + "Label";
						var p = '<span id="' + q + '" for="' + n
								+ '"  class="text-error red">';
						p += $.type(r) == "string" ? r : r.join(";");
						p += "</span>";
						$("#" + q).remove();
						var m = $(o);
						if (m.closest(".input-group").length > 0) {
							m.closest(".input-group").after(p)
						} else {
							m.parent().append(p)
						}
						m.css("margin-bottom", 0);
						m.css("border-color", "#953B39");
						m.change(function() {
							m.css("margin-bottom", 0);
							m.css("border-color", "");
							$("#" + q).remove()
						})
					});
					var k = $("#" + $("span.red").first().attr("for"));
					if (k.length) {
						topOffset = parseInt(k.offset().top) - 20
					}
					if ($(".navbar-fixed-top").size()) {
						topOffset = topOffset
								- parseInt($(".navbar-fixed-top")
										.height())
					}
					$(document).scrollTop(topOffset);
					k.focus()
				}
				if ($.isFunction(d)) {
					return d(g)
				}
			},
			error : function(e, g, f) {
				$.enableForm(c);
				if (g == "timeout") {
					bootbox.alert(v.lang.timeout);
					return false
				}
				bootbox.alert(e.responseText + g + f)
			}
		};
		$(document).on("submit", c, function() {
			$.disableForm(c);
			$(this).ajaxSubmit(b);
			return false
		}).data("setAjaxForm:" + c, true)
	},
	setSubmitButton : function(d, c) {
		var b = $(d).find(":submit");
		label = b.val();
		loading = b.data("loading");
		disabled = c == "disable";
		b.attr("disabled", disabled);
		b.val(loading);
		b.data("loading", label)
	},
	disableForm : function(b) {
		$.setSubmitButton(b, "disable")
	},
	enableForm : function(b) {
		$.setSubmitButton(b, "enable")
	}
});
