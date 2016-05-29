<?php 
/**
 * Template to output comment form - called via single.php
 * 
 * @see comments_template()
 */


// Bail early for password protected
if (post_password_required()) {
	return;
}

?>

	<div id="comments" class="grid-box comments-area">

	<?php if (have_comments()) : ?>
	
		<h3 class="common-heading">
			<?php
			
			comments_number(
				esc_html__('Comments', 'smart-blog'), 
				sprintf(esc_html__('%s Comment', 'smart-blog'), '<span class="number">1</span>'),
				sprintf(esc_html__('%s Comments', 'smart-blog'), '<span class="number">%</span>')
			);

			?>
		</h3>
	
		<ol class="comments-list add-separator">
			<?php
				get_template_part('partials/comment');
				wp_list_comments(array('callback' => 'smart_blog_comment', 'max-depth' => 4));
			?>
		</ol>

		
		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')): // are there comments to navigate through ?>
		
		<nav class="main-pagination comment-nav cf">
			<?php // Next/previous concept is swapped for comments ?>
			<div class="next"><?php previous_comments_link('<i class="icon icon-arrow-prev"></i>' . esc_html__('Previous', 'smart-blog')); ?></div>
			<div class="previous"><?php next_comments_link(esc_html__('Next', 'smart-blog') . '<i class="icon icon-arrow-next"></i>'); ?></div>
		</nav>
		
		<?php endif; // check for comment navigation ?>
		

	<?php elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')):	?>
	
		<p class="no-comments"><?php esc_html_e('Comments are closed.', 'smart-blog'); ?></p>
		
	<?php endif; ?>
	
	
	<?php 
	
	/**
	 * Configure and output the comment form
	 */
	
	$commenter = wp_get_current_commenter();
	
	// Comment field HTML
	$comment_field = '
			<div class="reply-field cf">
				<textarea name="comment" id="comment" cols="45" rows="7" placeholder="'. esc_attr__('Your Message', 'smart-blog') .'" aria-required="true"></textarea>
			</div>
	';
	
	// Logged in user message and links
	$logged_in = sprintf(
					esc_html__('Logged in as %1$s. %2$s', 'smart-blog'),
					'<a href="'. esc_url(admin_url('profile.php')) .'">'. $user_identity  .'</a>',
					'<a href="'. wp_logout_url(get_permalink())  .'" title="Log out of this account">Log out?</a>'
	);
	
	comment_form(array(
		'title_reply' => '<span class="common-heading">' . esc_html__('Leave A Reply', 'smart-blog') . '</span>',
		'title_reply_to' => '<span class="section-head alt cf">' . esc_html__('Reply To %s', 'smart-blog') . '</span>',
		'comment_notes_before' => (!is_user_logged_in() ? '<div class="fields">' : ''),
		'comment_notes_after'  => (!is_user_logged_in() ? '</div>' : ''),
	
		'logged_in_as' => '<p class="logged-in-as">' . $logged_in. '</p>',
	
		'comment_field' => $comment_field,
	
		'id_submit' => 'comment-submit',
		'label_submit' => esc_html__('Submit', 'smart-blog'),
	
		'cancel_reply_link' => esc_html__('Cancel Reply', 'smart-blog'),
	

		'fields' => array(
			'author' => '
				<div class="inline-field"> 
					<input name="author" id="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" aria-required="true" />
					<label for="author">' . esc_html_x('Name', 'Comment Form', 'smart-blog') . ' <span class="required">*</span></label>
				</div>',
	
			'email' => '
				<div class="inline-field"> 
					<input name="email" id="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" aria-required="true" />
					<label for="email">' . esc_html_x('Email', 'Comment Form', 'smart-blog') . ' <span class="required">*</span></label>
				</div>
			',
	
			'url' => '
				<div class="inline-field"> 
					<input name="url" id="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" />
					<label for="url">' . esc_html_x('Website', 'Comment Form', 'smart-blog') . '</label>
				</div>
			'
		),
		
	)); ?>

	</div><!-- #comments -->
