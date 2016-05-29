<?php
/**
 * General Template tags / View Helpers
 */
class Bunyad_Theme_Helpers
{
	/**
	 * View Helper: Output mobile logo
	 */
	public function mobile_logo()
	{
		if (!Bunyad::options()->mobile_logo_2x) {
			return;
		}
		
		// Attachment id is saved in the option
		$id   = Bunyad::options()->mobile_logo_2x;
		$logo = wp_get_attachment_image_src($id, 'full');
		
		if (!$logo) {
			return;
		}
			
		// Have the logo attachment - use half sizes for attributes since it's in 2x size
		if (is_array($logo)) {
			$url = $logo[0]; 
			$width  = round($logo[1] / 2);
			$height = round($logo[2] / 2);
		}
		
		?>
					
		<img class="mobile-logo" src="<?php echo esc_url($url); ?>" width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" 
			alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" />

		<?php
	}
}


// init and make available in Bunyad::get('helpers')
Bunyad::register('helpers', array(
	'class' => 'Bunyad_Theme_Helpers',
	'init' => true
));