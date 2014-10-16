
"use strict";

Nette.validators.ApplicationFormsCustomValidators_divisibilityValidator = function (elem, arg, value) {
	return value % arg === 0;
}


$(function(){

});
