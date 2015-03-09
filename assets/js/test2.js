$.extend({
	setAjaxForm : function(formID, callback) {
		if ($(document).data('setAjaxForm:' + formID))
			return;

		form = $(formID);

		var options = {
			target : null,
			timeout : 30000,
			dataType : 'json',

			success : function(response) {
				$.enableForm(formID);
				var submitButton = $(formID).find(
						':input[type=submit], .submit');

				/*
				 * The response is not an object, some error occers,
				 * bootbox.alert it.
				 */
				if ($.type(response) != 'object') {
					if (response)
						return bootbox.alert(response);
					return bootbox.alert('No response.');
				}

				/* The response.result is success. */
				if (response.result == 'success') {
					if (response.message && response.message.length) {
						submitButton.popover({
							trigger : 'manual',
							content : response.message,
							placement : 'right'
						}).popover('show');
						submitButton.next('.popover').addClass(
								'popover-success');
						function distroy() {
							submitButton.popover('destroy')
						}
						setTimeout(distroy, 2000);
					}

					if ($.isFunction(callback))
						return callback(response);

					if ($('#responser').length && response.message
							&& response.message.length) {
						$('#responser').html(response.message).addClass(
								'red f-12px').show().delay(3000).fadeOut(100);
					}

					if (response.locate) {
						return setTimeout(function() {
							location.href = response.locate;
						}, 1200);
					}

					return true;
				}

				/**
				 * The response.result is fail.
				 */

				/* The result.message is just a string. */
				if ($.type(response.message) == 'string') {
					if ($('#responser').length == 0) {
						submitButton.popover({
							trigger : 'manual',
							content : response.message,
							placement : 'right'
						}).popover('show');
						submitButton.next('.popover')
								.addClass('popover-danger');
						function distroy() {
							submitButton.popover('destroy')
						}
						setTimeout(distroy, 2000);
					} else
						$('#responser').html(response.message).addClass(
								'red f-12px').show().delay(5000).fadeOut(100);
				}

				/* The result.message is just a object. */
				if ($.type(response.message) == 'object') {
					$.each(response.message, function(key, value) {
						/* Define the id of the error objecjt and it's label. */
						var errorOBJ = '#' + key;
						var errorLabel = key + 'Label';

						/* Create the error message. */
						var errorMSG = '<span id="' + errorLabel + '" for="'
								+ key + '"  class="text-error red">';
						errorMSG += $.type(value) == 'string' ? value : value
								.join(';');
						errorMSG += '</span>';

						/*
						 * Append error message, set style and set the focus
						 * events.
						 */
						$('#' + errorLabel).remove();
						var $errorOBJ = $(errorOBJ);
						if ($errorOBJ.closest('.input-group').length > 0) {
							$errorOBJ.closest('.input-group').after(errorMSG)
						} else {
							$errorOBJ.parent().append(errorMSG);
						}
						$errorOBJ.css('margin-bottom', 0);
						$errorOBJ.css('border-color', '#953B39')
						$errorOBJ.change(function() {
							$errorOBJ.css('margin-bottom', 0);
							$errorOBJ.css('border-color', '')
							$('#' + errorLabel).remove();
						});
					})

					/* Focus the first error field thus to nitify the user. */
					var firstErrorField = $('#'
							+ $('span.red').first().attr('for'));
					topOffset = parseInt(firstErrorField.offset().top) - 20; // 20px
																				// offset
																				// more
																				// for
																				// margin.

					/*
					 * If there's the navbar-fixed-top element, minus it's
					 * height.
					 */
					if ($('.navbar-fixed-top').size()) {
						topOffset = topOffset
								- parseInt($('.navbar-fixed-top').height());
					}

					/* Scroll to the error field and foucus it. */
					$(document).scrollTop(topOffset);
					firstErrorField.focus();
				}

				if ($.isFunction(callback))
					return callback(response);
			},

			/* When error occers, alert the response text, status and error. */
			error : function(jqXHR, textStatus, errorThrown) {
				$.enableForm(formID);
				if (textStatus == 'timeout') {
					bootbox.alert(v.lang.timeout);
					return false;
				}
				bootbox.alert(jqXHR.responseText + textStatus + errorThrown);
			}
		};

		/* Call ajaxSubmit to sumit the form. */
		$(document).on('submit', formID, function() {
			$.disableForm(formID);
			$(this).ajaxSubmit(options);
			return false; // Prevent the submitting event of the browser.
		}).data('setAjaxForm:' + formID, true);
	},

	/* Switch the label and disabled attribute for the submit button in a form. */
	setSubmitButton : function(formID, action) {
		var submitButton = $(formID).find(':submit');

		label = submitButton.val();
		loading = submitButton.data('loading');
		disabled = action == 'disable';

		submitButton.attr('disabled', disabled);
		submitButton.val(loading);
		submitButton.data('loading', label);
	},

	/* Disable a form. */
	disableForm : function(formID) {
		$.setSubmitButton(formID, 'disable');
	},

	/* Enable a form. */
	enableForm : function(formID) {
		$.setSubmitButton(formID, 'enable');
	}
});