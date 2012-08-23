<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Merriment
 * @since Merriment 1.0
 */
 
 function get_latest_video(){
		#$string = file_get_contents("http://gdata.youtube.com/feeds/api/users/merrimentmusic/uploads/?v=2&max-results=1&orderby=published&alt=json");
		$string = file_get_contents("http://gdata.youtube.com/feeds/api/users/merrimentmusic/uploads/?v=2&max-results=1&orderby=viewCount&alt=json");
		$json_a=json_decode($string,true);
		$videotitle =str_replace('Merriment - ', "", $json_a['feed']['entry'][0]['title']['$t']);
		$thumbnail = $json_a['feed']['entry'][0]['media$group']['media$thumbnail'][2]['url'];	
		$link = $json_a['feed']['entry'][0]['content']["src"];
		$id = $json_a['feed']['entry'][0]['media$group']['yt$videoid']['$t'];
			
		$output = '<a class="various fancybox.iframe" href="http://www.youtube.com/embed/'.$id.'?autoplay=1"><div id="video-thumb" style="background: url('.$thumbnail.') no-repeat center center;background-size: cover;"></div></a>';
		$output.= '<a class="various fancybox.iframe" href="http://www.youtube.com/embed/'.$id.'?autoplay=1"><span id="video-title">'.$videotitle.'</span></a>';
		$output.= '<span id="video-more"><a href="/video/">+More Videos</a></span>';
		
		return $output;
}


 function get_all_video(){
		$string = file_get_contents("http://gdata.youtube.com/feeds/api/users/merrimentmusic/uploads/?v=2&orderby=published&alt=json");
		$json_a=json_decode($string,true);
		$json_a = $json_a['feed']['entry'];
		$output = "";
		
		foreach ($json_a as &$entry) {
		$output .='<div class="video-wrapper">';
		$videotitle =str_replace('Merriment - ', "", $entry['title']['$t']);
		$thumbnail = $entry['media$group']['media$thumbnail'][1]['url'];	
		$link = $entry['content']["src"];
		$id = $entry['media$group']['yt$videoid']['$t'];
			
		$output.= '<a class="various fancybox.iframe" href="http://www.youtube.com/embed/'.$id.'?autoplay=1"><div id="video-page-thumb" style="background: url('.$thumbnail.') no-repeat center center;background-size: cover;"></div></a>';
		$output.= '<a class="various fancybox.iframe" href="http://www.youtube.com/embed/'.$id.'?autoplay=1"><span id="video-page-title">'.$videotitle.'</span></a></div>';
		
		}
		
		return $output;
}


function facebook_photos($url){


$c = curl_init();
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($c, CURLOPT_URL, $url);
$contents = curl_exec($c);
$err  = curl_getinfo($c,CURLINFO_HTTP_CODE);
curl_close($c);
$fb_photos= json_decode($contents); 

$data = array();

echo '<ul">';

foreach($fb_photos->data as $key=>$photo) { 
           
      if($key < 6){     
           
       echo '<a href="'.$photo->source.'" class="fancybox" rel="group"><li style="background: url('.$photo->picture.') no-repeat center center;background-size: cover;"></li></a>';
           
      }else{
      
      	echo '<a href="'.$photo->source.'" class="fancybox" rel="group"><li style="display:none"></li></a>';
      } 
            
 
              
                         }
			

echo '</ul>';

}               
 
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * twentyten_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script type="text/javascript" src="<? bloginfo('template_directory');?>/js/jquery.js"></script>
<script type="text/javascript" src="<? bloginfo('template_directory');?>/js/jquery.fancybox.js?v=2.0.6"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox({
			nextMethod:'resizeIn',
			nextSpeed:250,
			prevMethod:'resizeOut',
			prevSpeed:250});
			
			$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
			
			});
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22338048-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!--[if lt IE 9]>
<script src="<? bloginfo('template_directory');?>/dist/html5shiv.js"></script>
<![endif]-->                                                 

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=443377639029995";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header>
<div id="header" class="wrapper">

	
	
	<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
		<?php wp_nav_menu( array(
  	'container'       => false, 
  	'link_before'     => '',
  	'link_after'      => '',) );
  	?>
		
 	<ul id="social">
    		<a href="https://www.facebook.com/merrimentmusic" target="_blank"><li id="facebook"></li></a>
    		<a href="https://twitter.com/MerrimentMusic" target="_blank"><li id="twitter"></li></a>
    		<a href="http://www.youtube.com/user/MerrimentMusic" target="_blank"><li id="youtube"></li></a>
    		<a href="http://merrimentmusic.tumblr.com/" target="_blank"><li id="tumblr"></li></a>
    </ul>

</div>
</header>