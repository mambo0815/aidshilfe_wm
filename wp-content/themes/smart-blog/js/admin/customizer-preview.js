/**
 * Customizer postMessage handlers for frontend
 */

(function($) {
	 "use strict";
	
	var api = wp.customize;
	
	
	/**
	 * Live update Custom CSS
	 */
	api('smart_blog_theme_options[css_custom]', function(value) {
		
		
		value.bind(function(change) {
			
			var custom_css = $('#bunyad-custom-css');
			
			if (!custom_css.length) {
				
				// add the style to preview
				$('<style id="bunyad-custom-css" />').appendTo('head');
				
				// remove existing custom styles
				$('#smart-blog-responsive-inline-css, #smart-blog-core-inline-css').remove();
			}
			
			custom_css.text(change);

		});
	});
	
})(jQuery);