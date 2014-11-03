
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

$(function(){
	//alert(Nette.formMsgTarget);
});
