/**
 * Custom control handling of customizer
 */

jQuery(function($) {
	"use strict";
	
	var api = wp.customize;
	
	/**
	 * Setup multiple checkboxes
	 */
	api.controlConstructor['checkboxes'] = api.Control.extend({
		
		ready: function() 
		{
			var control = this;

			this.container.on('change', 'input:checkbox', function() {

				// get the checkbox value objects and used get() to retrieve an array of values
				var values = $('input[type="checkbox"]:checked', control.container).map(function() {
						return this.value;
				}).get();
				
				control.setting.set(values || '');
				
			});
		}
	});
	
	/**
	 * Typography control
	 */
	api.controlConstructor['typography'] = api.Control.extend({
		
		ready: function() 
		{
			var control = this, 
			    values = {},
			    container = this.container;
			
			// init selectize
			$(this.container.find('.font_name')).selectize({
				create: (this.params.add_custom ? true : false)
			});

			this.container.on('change', '.font_name, .font_weight, .font_size', function() {
				
				// Update value object
				$.each(['.font_name', '.font_weight', '.font_size'], function(i, key) {
					var element = $(container).find(key);

					if (element.length) {
						values[key.replace('.', '')] = element.val();
					}
				});
		
				// Signal a refresh
				control.setting.set('').set(values);
			});
		}
	});

	/**
	 * Reset settings
	 */
	$(document).on('click', '.reset-customizer', function(e) {
		
		e.preventDefault();
		
		if (!confirm('WARNING: All settings will reset to default.')) {
			return;
		}
		
		var data = {
			'action': 'reset_customizer',
			'nonce':  api.settings.nonce.save
		};
		
		$.post(ajaxurl, data, function(resp) {
			
			if (!resp.success) {
				return;
			}
			
			wp.customize.state('saved').set(true);
			location.reload();
		}, 'json');
	});
	
	
	/**
	 * Mailchimp parse
	 */
	$(document).on('input change', '#customize-control-footer_mailchimp input', function() {
		
		var code = $(this).val(),
		    match = code.match(/action=\"([^\"]+)\"/);
		
		if (match) {
			$(this).val(match[1]);
		}
	});
	
});