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
 Template Name: Video
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
						<?=get_all_video();?>
					</div>
				</div>
				
				
			<?php endwhile; // End the loop. Whew. ?>
		
		
			
		</div>
		
	</div>
</section> 


<?php get_footer(); ?>