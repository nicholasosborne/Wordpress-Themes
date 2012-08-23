<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
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
				<div class="news-item front-page-item bottom-padding">
				<div class="item-title"><?php the_title(); ?></div>
				
					<div class="news-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
					</div>
				</div>
				
				
			<?php endwhile; // End the loop. Whew. ?>
		
		
			
		</div>
		
	</div>
</section> 


<?php get_footer(); ?>