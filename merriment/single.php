<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Merriment
 * @since Merriment 1.0
 */

get_header(); ?>

<section id="wrapper">
	<div class="wrapper">

		<div id="content">
		
			<div id="main">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div class="news-item front-page-item">
				<div class="item-social">
				<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="true" data-layout="box_count" data-width="50" data-show-faces="false" data-font="verdana"></div>

<a href="https://twitter.com/share" class="twitter-share-button" data-via="merrimentmusic" data-count="vertical">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
					<div class="news-thumb">
					<? if (has_post_thumbnail()){the_post_thumbnail();}else{ ?>
					<?php echo get_avatar($post->post_author, 116); ?>
					<? } ?>
					</div>
					<div class="news-title"><?php the_title(); ?></div>
					<div class="news-date"><?php twentyten_posted_on(); ?></div>
					<div class="news-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
					</div>
				</div>
				
				<div class="news-item front-page-item bottom-padding">
		
		<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="1" data-width="733"></div>
		
		</div>
			<?php endwhile; // End the loop. Whew. ?>
		
		
			
		</div>
		
	</div>
</section> 


<?php get_footer(); ?>