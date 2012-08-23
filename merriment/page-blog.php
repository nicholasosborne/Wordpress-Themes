<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Merriment
 * @since Merriment 1.0
  Template Name: Blog
 */
$first = 1;

get_header(); ?>




<section id="wrapper">
	<div class="wrapper">

		<div id="content" class="bottom-padding">
		
			<div id="news">
			<?php 
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			query_posts('posts_per_page=10&category_name=blog&paged='.$paged); 
			?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="news-item front-page-item">
				
				<? if($first){ ?>
				<div class="item-title">blog</div>
				<? $first=0; } ?>

				
					<div class="news-thumb"><a href="<?php the_permalink(); ?>">
					<? if (has_post_thumbnail()){the_post_thumbnail();}else{ ?>
					<img src="<? bloginfo('template_directory');?>/images/blog.jpg">
					<? } ?>
					</a></div>
					<div class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<div class="news-date"><?php twentyten_posted_on(); ?></div>
					<div class="news-content"><?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
						<?php the_excerpt('Read More..'); ?>
						<?php else : ?>
						<?php the_excerpt( __( '(More ...)') ); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; // End the loop. Whew. ?>
			
			<?php /* Display navigation to next/previous pages when applicable */ ?>
			<?php if (  $wp_query->max_num_pages > 1 ) : ?>
			
			<div class="pagination">
			
				<?php previous_posts_link( __( '<div class="news-item front-page-item ">&larr; Older Posts</div>', 'twentyten' ) ); ?>
		
			
			<?php next_posts_link( __( '<div class="news-item front-page-item " style="float:right">Newer Posts &rarr;</div>', 'twentyten' ) ); ?>
			</div>
			<?php endif; ?>
			</div>
			
		</div>

	</div>
</section> 


			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 #get_template_part( 'loop', 'index' );
			?>

<?php get_footer(); ?>