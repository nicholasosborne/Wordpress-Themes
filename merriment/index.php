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
  Template Name: Index
 */

get_header(); ?>




<section id="wrapper">
	<div class="wrapper">

		<div id="content">
		
			<div id="news">
			<? query_posts( 'category_name=news&posts_per_page=1' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="news-item front-page-item">
				<div class="item-title">news</div>
					<div class="news-thumb"><a href="<?php the_permalink(); ?>">
					<? if (has_post_thumbnail()){the_post_thumbnail();?>
					<? }else{ ?>
					<img src="<? bloginfo('template_directory');?>/images/news.jpg">
					<? }?>
					</a></div>
					<div class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<div class="news-content"><?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
						<?php the_excerpt('Read More..'); ?>
						<?php else : ?>
						<?php the_excerpt( __( '(More ...)') ); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; // End the loop. Whew. ?>
			
			<? query_posts( 'category_name=blog&posts_per_page=1' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="news-item front-page-item">
				<div class="item-title">blog</div>
					<div class="news-thumb"><a href="<?php the_permalink(); ?>">
					<? if (has_post_thumbnail()){the_post_thumbnail();?>
					<? }else{ ?>
					<img src="<? bloginfo('template_directory');?>/images/blog.jpg">
					<? }?>
					
					</a></div>
					<div class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<div class="news-content"><?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
						<?php the_excerpt('Read More..'); ?>
						<?php else : ?>
						<?php the_excerpt( __( '(More ...)') ); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; // End the loop. Whew. ?>	
			
		</div>

		<div id="video" class="front-page-item">
		<div class="item-title">video</div>
		<?=get_latest_video();?>
		</div>
		
		<div id="twitter-box" class="front-page-item">
		<h2>twitter</h2>
		<? include("extlib/tweets.php"); ?>
		<a href="#"><span id="tweet-follow">+Follow</span></a>
		</div>

		<div id="photo-box" class="front-page-item">
		<div class="item-title">photos</div>
		<? facebook_photos('https://graph.facebook.com/170678996317734/photos');?>
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