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
 Template Name: Photo
 */
function facebook_album($id,$title){

$url = "https://graph.facebook.com/$id/photos";
$c = curl_init();
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($c, CURLOPT_URL, $url);
$contents = curl_exec($c);
$err  = curl_getinfo($c,CURLINFO_HTTP_CODE);
curl_close($c);
$fb_photos= json_decode($contents); 

$data = array();

$first = 0;
$cover = '';
$output = '';
foreach($fb_photos->data as $key=>$photo) {        
 
	if($first != 0){
	$output .= ",";
	}      
       
   # if(isset($photo->name)){   
    #	$output .= "{href : '".$photo->source."',title : '".$photo->name."'}";
    #}else{
    	$output .= "{href : '".$photo->source."'}";
    #}
    
            
       #echo '<a href="'.$photo->source.'" class="fancybox" rel="group"><li><img src="'.$photo->picture.'"></li></a>';
           
      
       #var_dump($photo);     
 		if($first == 0){
 			$images = $photo->images;
			$acover = $images[3];
			$cover = $acover->source;
			$first = 1;
		}     
              	
	}
			
		echo '<script type="text/javascript">';

		echo "var a$id = [".$output."]";

		echo '</script>';
		
		
		echo '<div class="video-wrapper"><div onclick="facebook_album(a'.$id.');" class="click" id="video-page-thumb" style="background: url('.$cover.') no-repeat top center;background-size: cover;"></div>';
		echo '<span class="click" onclick="facebook_album(a'.$id.');" id="video-page-title">'.$title.'</span></div>';
		
					


} 




get_header(); ?>

<script type="text/javascript">

function facebook_album(id){
				$.fancybox.open(id);
	}			
			

</script>

<section id="wrapper">
	<div class="wrapper">

		<div id="content">
		
			<div id="main">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div class="news-item front-page-item bottom-padding">
				<div class="item-title"><?php the_title(); ?></div>
				
					<div class="news-content">
							<? $args = array( 'post_type' => 'photoalbum'); ?>
						<? $loop = new WP_Query( $args ); ?>
						<? while ( $loop->have_posts() ) : $loop->the_post(); ?>

						<?php if (get_post_meta($post->ID, "photo_album_url", true) != ""){
							facebook_album(get_post_meta($post->ID, "photo_album_url", true),get_the_title());
						}?>
						<? endwhile; // End the loop. Whew.  ?>	
					</div>
				</div>
				
				
			<?php endwhile; // End the loop. Whew. ?>
		
		
			
		</div>
		
	</div>
</section> 


<?php get_footer(); ?>