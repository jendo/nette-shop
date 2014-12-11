
"use strict";

Nette.formMsgTarget = Nette.formMsgTarget || {};

Nette.validators.ApplicationFormsCustomValidators_divisibilityValidator = function (elem, arg, value) {
	return value % arg === 0;
}

// Override addError function
Nette.addError = function(elem, message) {
	if (elem.focus) {
		elem.focus();
	}
	if (message) {
		if (Nette.formMsgTarget.name.length > 0) {
			var prefix  = Nette.formMsgTarget.type == 'class' ? '.' : '#';
			$(prefix + Nette.formMsgTarget.name).html(message).slideDown('fast',function(){});
		} else {
			alert(message);
		}
	}
};

// Shorthand for document ready
$(function(){

	// My own image preloader
	$('img').css('opacity',0); // hide all images
	$('.product_info').css('display','none'); // hide all images
	$('img').each(function(){
		var img = $(this);
		img.load(function(){
			img.animate({'opacity':1},250,function(){
				$(this).parent('a').siblings('div.loader').css('display','none');
				$(this).siblings('.black_gradient').css('display','block');
				$(this).siblings('.product_info').css('display','block');
			});
		});
	});

});


