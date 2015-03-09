$(".chosen").chosen({no_results_text: '没有匹配的选项', disable_search_threshold: 1, search_contains: true, width: '100%'});
if(+[1,]){
	$('form.ajax-validate').hide().fadeIn(480);
}
$(function(){
	
	//先验证，然后Ajax提交
	$("form.ajax-validate").validate({
		rules : {
			required : {
				required : true
			},
			email : {
				required : true,
				email : true
			},
			date : {
				required : true,
				date : true
			},
			url : {
				required : true,
				url : true
			}
		},
		errorClass : "label-warning",
		highlight : function(element, errorClass, validClass) {
			$(element).parents('.form-group').addClass('has-error');
		},
		unhighlight : function(element, errorClass, validClass) {
			$(element).parents('.form-group').removeClass('has-error');
			$(element).parents('.form-group').addClass('success');
		},
		submitHandler: function(element) {
			//console.info($(element));
			var submitbtn = $(element).find("input[type=submit]");
			submitbtn.button('loading');
			$(element).ajaxSubmit({
				timeout : 30000,
				dataType : 'json',
				success:function(data){
					//console.info(data);
					submitbtn.button('reset');
					//if(data.status==1){
					var jump_url = data.url;
					if(data.url&&data.url.length>0){
						jump_url=data.url;
					}else{
						jump_url = window.location.href;
					}
						submitbtn.popover({
							trigger : 'manual',
							content : data.info,//+'<a id="href" href="'+jump_url+'">跳转</a> 等待时间： <b id="wait">3</b>',
							placement : 'right'
						}).popover('show');
						submitbtn.next('.popover').addClass(
								data.status==1?'popover-success':'popover-danger');
						function distroy() {
							submitbtn.popover('destroy')
							window.location.href = jump_url;
						}
						setTimeout(distroy, 1200);
					//}else{
						//alert("出错啦~");
					//}
				},
				error:function(jqXHR, textStatus, errorThrown){
					alert("出错啦~");
				}
			});
			return false;
		}
	});
	
	
});