<?php
/**
 * Partial: Social Share Counters for Single Page
 */

// Nothing to show?
if (!Bunyad::options()->posts_likes && !Bunyad::options()->single_share) {
	return;
}

?>
		<div class="post-share">
			<span class="counters">
			
			<?php if (Bunyad::options()->posts_likes): ?>
				<?php Bunyad::get('likes')->heart_link(); ?>
			<?php endif; ?>
				
			<?php if (Bunyad::options()->single_share): ?>
				<span class="count count-share"><i class="icon icon-share-1"></i><?php echo esc_html(Bunyad::get('social')->share_count()); ?></span>
			<?php endif; ?>
				
			</span>
			
			<?php if (Bunyad::options()->single_share): ?>
			
			<div class="post-share-icons cf">
			
				<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="link" title="<?php 
					esc_attr_e('Share on Facebook', 'smart-blog'); ?>"><i class="icon icon-facebook"></i></a>
					
				<a href="http://twitter.com/home?status=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="link" title="<?php 
					esc_attr_e('Share on Twitter', 'smart-blog'); ?>"><i class="icon icon-twitter"></i></a>
					
				<a href="http://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="link" title="<?php 
					esc_attr_e('Share on Google+', 'smart-blog'); ?>"><i class="icon icon-gplus"></i></a>
					
				<?php 
				/**
				 * A filter to programmatically add more icons
				 */
				do_action('bunyad_post_social_icons'); 
				?>
				
			</div>
			
			<?php endif; ?>
			
		</div>