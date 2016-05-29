<?php
/**
 * Single Comment template 
 */
if (!function_exists('smart_blog_comment')):

	/**
	 * Callback for displaying a comment
	 * 
	 * @todo eventually move to bunyad templates with auto-generated functions as template containers
	 * 
	 * @param mixed   $comment
	 * @param array   $args
	 * @param integer $depth
	 */
	function smart_blog_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
		
		// get single post author
		$post_author = (get_post() ? get_post()->post_author : 0);
		
		// type of comment?
		switch ($comment->comment_type):
			case 'pingback':
			case 'trackback':
			?>
			
			<li class="post pingback">
				<p><?php esc_html_e('Pingback:', 'smart-blog'); ?> <?php comment_author_link(); ?><?php 
					edit_comment_link(esc_html__('Edit', 'smart-blog'), '<span class="edit-link">', '</span>'); ?></p>
			<?php
				break;


			default:
			?>
		
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment" itemscope itemtype="http://schema.org/UserComments">
				
					<header class="comment-head cf">
					
						<span class="comment-avatar"><?php echo get_avatar($comment, 55); ?></span>
						
						<div class="comment-meta">
							<span class="comment-author" itemprop="creator" itemscope itemtype="http://schema.org/Person">
								<span itemprop="name"><?php comment_author_link(); ?></span>
															
								<?php if (!empty($comment->user_id) && $post_author == $comment->user_id): ?>
									<span class="post-author"><?php esc_html_e('Post Author', 'smart-blog'); ?></span>
								<?php endif; ?>
								
							</span>
							
							<?php /* Uncomment for non-reative times
							<a href="<?php comment_link(); ?>" class="comment-time" title="<?php comment_date();esc_html_e(' at ', 'smart-blog'); comment_time(); ?>">
								<time itemprop="commentTime" datetime="<?php comment_time(DATE_W3C); ?>"><?php comment_date(); ?> <?php comment_time(); ?></time>
							</a> */
							?>
							
							<a href="<?php comment_link(); ?>" class="comment-time">
								<time itemprop="commentTime" datetime="<?php comment_time(DATE_W3C); ?>">
									<?php printf(esc_html__('%s ago', 'smart-blog'), human_time_diff(get_comment_time('U'))); ?>
								</time>
							</a>
			
							<?php edit_comment_link(esc_html__('Edit', 'smart-blog'), '<span class="edit-link">', '</span>'); ?>
							
							<span class="reply">
								<?php
								comment_reply_link(array_merge($args, array(
									'reply_text' => esc_html__('Reply', 'smart-blog'),
									'depth'      => $depth,
									'max_depth'  => $args['max_depth']
								))); 
								?>
								
							</span><!-- .reply -->
							
						</div> <!-- .comment-meta -->
					
					</header> <!-- .comment-head -->
		
					<div class="comment-content">
						<div itemprop="commentText" class="text"><?php comment_text(); ?></div>
						
						<?php if ($comment->comment_approved == '0'): ?>
							<em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'smart-blog'); ?></em>
						<?php endif; ?>
						
					</div>
				</article><!-- #comment-N -->
	
		<?php
				break;
		endswitch;
		
	}
	
endif;
