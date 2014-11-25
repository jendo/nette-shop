/**
 * AJAX Nette Framwork plugin for jQuery
 *
 * @copyright   Copyright (c) 2009 Jan Marek
 * @license     MIT
 * @link        http://nettephp.com/cs/extras/jquery-ajax
 * @version     0.2
 */

jQuery.extend({
	nette: {

		msgTarget: undefined,

		setMsgTarget: function(selector,prefix) {
			this.msgTarget = prefix + selector;
		},

		hideMsgTarget: function() {
			$(this.msgTarget).hide();
		},

		updateSnippet: function(id, html) {
			if (this.msgTarget !== 'undefined') {
				$("#" + id).html(html);
				$(this.msgTarget).slideDown('fast', function() {});
			} else {
				$("#" + id).html(html);
			}
		},

		success: function(payload) {

			//set target for messages
			if (payload.target) {
				if (payload.target.class !== 'undefined') {
					var prefix = '.';
					jQuery.nette.setMsgTarget(payload.target.class,prefix);
				} else {
					var prefix = '#';
					jQuery.nette.setMsgTarget(payload.target.id,prefix);
				}
				//if is message target , then hide it before other
				jQuery.nette.hideMsgTarget();
			}

			// redirect
			if (payload.redirect) {
				window.location.href = payload.redirect;
				return;
			}

			// snippets
			if (payload.snippets) {
				for (var i in payload.snippets) {
					jQuery.nette.updateSnippet(i, payload.snippets[i]);

					if (typeof $.app.form !== 'undefined' && $.app.form.setupForm !== 'undefined') {
						$.app.form.setupForm();
					}
				}
			}

			// focus afted upadte snippet
			if(payload.focus) {
				if (payload.focus.name !== 'undefined') {
					$("input[name='" + payload.focus.name  + "']").focus();
				}
			}

		}

	}
});

jQuery.ajaxSetup({
	success: jQuery.nette.success,
	dataType: "json"
});
