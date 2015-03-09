jQuery.extend(jQuery.validator.messages, {
	required : "请填写本字段",
	remote : "验证失败",
	email : "请输入正确的电子邮件",
	url : "请输入正确的网址",
	date : "请输入正确的日期",
	dateISO : "请输入正确的日期 (ISO).",
	number : "请输入正确的数字",
	digits : "请输入正确的整数",
	creditcard : "请输入正确的信用卡号",
	equalTo : "请再次输入相同的值",
	accept : "请输入指定的后缀名的字符串",
	maxlength : jQuery.validator.format("允许的最大长度为 {0} 个字符"),
	minlength : jQuery.validator.format("允许的最小长度为 {0} 个字符"),
	rangelength : jQuery.validator.format("允许的长度为{0}和{1}之间"),
	range : jQuery.validator.format("请输入介于 {0} 和 {1} 之间的值"),
	max : jQuery.validator.format("请输入一个最大为 {0} 的值"),
	min : jQuery.validator.format("请输入一个最小为 {0} 的值")
});
$(function(){
	
	$("a.ajax-confirm").confirmation({
		title:"你确定进行此操作吗？",
		placement:"top",
		btnOkLabel:"确定",
		btnCancelLabel:"取消",
		onConfirm: function(event,element) {
			element.button('loading');
			$.getJSON(element.get(0).href,function(data){
				element.button('reset');
				element.removeAttr("title");
				var jump_url = data.url;
				if(data.url&&data.url.length>0){
					jump_url=data.url;
				}else{
					jump_url = window.location.href;
				}
				element.popover({
					trigger : 'manual',
					content : data.info,//+'<a id="href" href="'+jump_url+'">跳转</a> 等待时间： <b id="wait">3</b>',
					placement : 'right'
				}).popover('show');
				element.next('.popover').addClass(
						data.status==1?'popover-success':'popover-danger');
				function distroy() {
					element.popover('destroy')
					window.location.href = jump_url;
				}
				setTimeout(distroy, 1200);
			});
			//console.info(element.get(0).href);
		}
	});
	
});
