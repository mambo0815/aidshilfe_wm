  <div class="slick-image-slide" style="max-height:<?php echo $sliderheightv; ?>px;">
			<?php $sliderurl = get_post_meta( get_the_ID(),'wpsisac_slide_link', true );				if($sliderurl != '') { ?>				<a href="<?php echo $sliderurl; ?>" >	<?php the_post_thumbnail('url'); ?>		</a>				<?php } else { 				the_post_thumbnail('url');				}				?>									
	</div>