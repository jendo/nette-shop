(function() {

	/**
	 * Main app object
	 *
	 * @type object
	 */
	$.app = $.app || {};

	/**
	 * Forms object
	 *
	 * @type object
	 */
	$.app.form = $.app.form || {};

	/**
	 * Setups form
	 *
	 * @param {jQuery} $form
	 * @returns {void}
	 */
	$.app.form.setupForm = function($form) {

		/*$('input.date').each(function() {
		 $.admit.form.setupDatePicker($(this));
		 });*/

		/*$('input.clear-button').on('click', function(evt) {
		 evt.stopImmediatePropagation();
		 $.admit.form.clearForm($(this).parents('form'));
		 return false;
		 });*/

		$('.ajax-btn').each(function() {
			$(this).off('click').on('click', function() {
				//$.nette.createSpinner();
				var $el = $(this);
				var postData = {};
				postData[$el.attr('name')] = $el.val();
				// toto nechapem ??
				if (typeof $.fn.ajaxForm !== 'undefined') {
					// Using new Ajax Form submitting => this is no clasical function
					$(this).parents('form').ajaxSubmit({data: postData});
				} else {
					// Using old, classical ajax submit
					$el.ajaxSubmit();
				}
				return false;
			});
		});
	};

	// On load
	$(document).ready(function() {
		$.app.form.setupForm();
	});

})(jQuery);

