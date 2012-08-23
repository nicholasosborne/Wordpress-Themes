<?php
require_once 'rss_fetch.inc';

$url = 'http://twitter.com/statuses/user_timeline/merrimentmusic.rss?count=3';
$rss = fetch_rss($url);

$count = 0;
foreach ($rss->items as $item ) {
	$tweet = $item['title'];
	

// The Regular Expression filter
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
// The Text you want to filter for urls

// Check if there is a url in the text
if(preg_match($reg_exUrl, $tweet, $url)) {

       // make the urls hyper links
       $tweet = preg_replace($reg_exUrl, "<a href=\"{$url[0]}\" class=\"twitterlink\" target=\"_blank\">{$url[0]}</a> ", $tweet);
}

  $tweet = preg_replace('/(^|\s)@(\w+)/',
        '\1@<a href="http://www.twitter.com/\2" class=\"twitterreply\" target=\"_blank\">\2</a>',
        $tweet);
    $tweet = preg_replace('/(^|\s)#(\w+)/',
        '\1#<a href="http://search.twitter.com/search?q=%23\2" class=\"twitterhashtag\" target=\"_blank\">\2</a>',
        $tweet);


$tweet = str_replace("MerrimentMusic: ", "", $tweet);
$tweet = str_replace("@", "<span class=\"twitterreply\">@</span>", $tweet);
$tweet = str_replace("#", "<span class=\"twitterreply\">#</span>", $tweet);
echo "<span class=\"tweet\">".$tweet."</span>"; 


$count++;
}
?>

