<?php
/**
 * Functions relating to the social functionality.
 * 
 * Share counters rely on a plugin "Post Share Count"
 *
 */
class Bunyad_Theme_Social
{
	/**
	 * Combined social sharing cout number
	 * 
	 * @return string|number
	 */
	public function share_count($post_id = null)
	{
		if (!Bunyad::options()->share_counters) {
			return '';
		}
		
		if (!class_exists('Sphere_Plugin_Core')) {
			return 0;
		}
		
		$count = 0;
		foreach (array('facebook', 'twitter', 'gplus') as $service) {
			$count += Sphere_Plugin_Core::get('social-share')->count($service, $post_id);
		}
		
		return intval($count);
	}
	
	/**
	 * Get an array of services supported at different locations
	 * such as Top bar social icons.
	 */
	public function get_services()
	{
		$services = array(
			'facebook' => array(
				'icon' => 'facebook-b',
				'label' => esc_html__('Facebook', 'smart-blog')
			),
			
			'twitter' => array(
				'icon' => 'twitter-b',
				'label' => esc_html__('Twitter', 'smart-blog')
			),
			
			'instagram' => array(
				'icon' => 'instagram-b',
				'label' => esc_html__('Instagram', 'smart-blog')
			),
			
			'pinterest' => array(
				'icon' => 'pinterest-b',
				'label' => esc_html__('Pinterest', 'smart-blog')
			),
			
			'bloglovin' => array(
				'icon' => 'heart',
				'label' => esc_html__('BlogLovin', 'smart-blog')
			),
			
			'rss' => array(
				'icon' => 'rss',
				'label' => esc_html__('RSS', 'smart-blog')
			),
			
			'gplus' => array(
				'icon' => 'gplus',
				'label' => esc_html__('Google Plus', 'smart-blog')
			),
			
			'youtube' => array(
				'icon' => 'youtube',
				'label' => esc_html__('YouTube', 'smart-blog')
			),
			
			'dribbble' => array(
				'icon' => 'dribbble',
				'label' => esc_html__('Dribbble', 'smart-blog')
			),
			
			'tumblr' => array(
				'icon' => 'tumblr',
				'label' => esc_html__('Tumblr', 'smart-blog')
			),
			
			'linkedin' => array(
				'icon' => 'linkedin',
				'label' => esc_html__('LinkedIn', 'smart-blog')
			),
			
			'flickr' => array(
				'icon' => 'flickr',
				'label' => esc_html__('Flickr', 'smart-blog')
			),
			
			'soundcloud' => array(
				'icon' => 'soundcloud',
				'label' => esc_html__('SoundCloud', 'smart-blog')
			),
			
			'vimeo' => array(
				'icon' => 'vimeo',
				'label' => esc_html__('Vimeo', 'smart-blog')
			),
		);
		
		return $services;
	}
}

// init and make available in Bunyad::get('social')
Bunyad::register('social', array(
	'class' => 'Bunyad_Theme_Social',
	'init' => true
));