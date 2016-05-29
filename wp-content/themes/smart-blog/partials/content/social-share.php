<?php
/**
 * Partial: Social Share Buttons for Archives
 */

// Options can be set when included using locate_template()
$options = array_merge(
	array(
		'heart' => Bunyad::options()->posts_likes, 
		'comments' => Bunyad::options()->post_comments, 
		'share' => Bunyad::options()->post_share
	),
	(!empty($options) ? $options : array())
);
?>

		<ul class="post-counters">
		
		<?php if ($options['heart']): ?>
			<li class="item heart"><?php Bunyad::get('likes')->heart_link(); ?></li>
		<?php endif; ?>
		
		<?php if ($options['share']): ?>	
			<li class="item share">
				<a href="#" class="count-link"><i class="icon icon-share-1"></i><span class="number"><?php echo esc_html(Bunyad::get('social')->share_count()); ?></span></a>
				
				<ul class="post-share-menu">
					
					<li>
						<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="link">
							<i class="icon-facebook-squared"></i><?php esc_html_e('Facebook', 'smart-blog'); ?></a>
					</li>
					
					<li>
						<a href="http://twitter.com/home?status=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="link">
							<i class="icon-twitter"></i><?php esc_html_e('Twitter', 'smart-blog'); ?></a>
					</li>
					
					<li>
						<a href="http://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="link">
							<i class="icon-gplus"></i><?php esc_html_e('Google+', 'smart-blog'); ?></a>
					</li>
					
					<?php 
					/**
					 * A filter to programmatically add more share links
					 * 
					 * @param string 'archive' value denotes its an archive
					 */
					do_action('bunyad_post_social_icons', 'archive'); 
					?>
				
					
				</ul>
				
			</li>
		<?php endif; ?>
		
		
		<?php if ($options['comments']): ?>	
			<li class="item comments"><a href="<?php echo esc_url(get_comments_link()); ?>" class="count-link">
				<i class="icon icon-comment-1"></i><span class="number"><?php echo esc_html(get_comments_number()); ?></span></a>
			</li>
		<?php endif; ?>
		
		</ul>