<?php
/**
 * @package WordPress
 * @subpackage Spurious_Logic_Theme
 */
?>
<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
<![endif]-->
<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>> 

<head> 
	<title>Spurious Logic</title> 
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>
	 
	<!-- Bad Behavior 2.0.28 run time: 77.204 ms --> 
	<script type="text/javascript"> 
	<!--
	function bb2_addLoadEvent(func) {
		var oldonload = window.onload;
		if (typeof window.onload != 'function') {
			window.onload = func;
		} else {
			window.onload = function() {
				oldonload();
				func();
			}
		}
	}
	 
	bb2_addLoadEvent(function() {
		for ( i=0; i < document.forms.length; i++ ) {
			if (document.forms[i].method == 'post') {
				var myElement = document.createElement('input');
				myElement.setAttribute('type', 'hidden');
				myElement.name = 'bb2_screener_';
				myElement.value = '1272551939 194.88.4.145';
				document.forms[i].appendChild(myElement);
			}
		}
	});
	// --></script> 

</head> 



<body> 
<div id="content"> 


<?php 
if ( is_category('24') || is_category('26') )
{
?>
	<p>
<?php posts_nav_link(' &#8212; ', __('&laquo; Older Posts'), __('Newer Posts &raquo;')); ?>
	</p>
<?php 
}
?>

<!-- begin sidebar -->
<div id="content-sidebar">
	<ul>		
		<li><h3><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></h3></li> 
		<li class="page_item page-item-2"><a href="http://spurious-logic.net/?page_id=2" title="Info"><span>Info</span></a></li> 	
	</ul>
	<ul>		
	<?php 	/* Widgetized sidebar, if you have the plugin installed. */
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
		<?php wp_list_categories('title_li=' . __('Categories:') . '&exclude=24,26'); ?>

	 <li>Series
		 <ul>
			<li><a href="http://spurious-logic.net/?cat=24">Tale of Moratalla</a></li>
			<li><a href="http://spurious-logic.net/?cat=26">Sisyphean Design</a></li>
		 </ul>
	 </li>
	 <li id="archives"><?php _e('Archives:'); ?>
		<ul>
		 <?php wp_get_archives(); ?>
		</ul>
	 </li>
	 <li id="meta"><?php _e('Meta:'); ?>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<li><a href="<?php bloginfo('rss2_url'); ?>"><img src="http://www.mozilla.org/images/feed-icon-14x14.png" alt="RSS Feed" title="RSS Feed" /></a></li>
		</ul>
		
	 </li>
	<?php endif; ?>

	</ul>
	<br />
	<br />	
	<p>
	<?php if ( is_category('24') || is_category('26') )
	{
		posts_nav_link(' | ', __('&laquo; Older Posts'), __('Newer Posts &raquo;'));
	} 
	else 
	{
		posts_nav_link(' | ', __('&laquo; Newer Posts'), __('Older Posts &raquo;'));
	}
	?>
	</p>	

</div>
<!-- end sidebar -->


<!-- begin content -->
<div id="content-body"> 

	<?php 
/*
	//trying to get 1 post on the front page. and multiple posts on subsequent pages.
	
	if ( $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] == 'www.spurious-logic.net/' )
	{			
		$query_string = $query_string . '&posts_per_page=1';
		echo $query_string;
	}
	else
	{
		//still searching from index 8		
		$query_string = $query_string . '&offset=' . get_query_var(‘paged’) -1;
		echo $query_string;
	}
*/	
	
	if ( is_home() ) 
	{
		query_posts($query_string . '&cat=-24,-26');
	} 
	
	if ( is_category('24') || is_category('26') )
	{
		query_posts($query_string .'&order=ASC&orderby=ID');
	}
	
	if (have_posts()) : while (have_posts()) : the_post();
	
	?>

	<div <?php post_class() ?> id="post-<?php the_ID(); ?> post"><h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		
		<div <?php if(get_the_ID() % 2 == 0) { echo 'class=" story"';} else {echo 'class=" story"';} /*even-odd removed*/ ?> >
			<?php the_content(__('...more...')); ?>
		</div>
		
		<div class="clear"></div> 
		
	</div>
	
	<?php if(is_single()) 
	{?>
	<div class="story-links">
		<?php if ( is_category('24') || is_category('26') )
		{
			posts_nav_link(' &#8212; ', __('&laquo; Older Posts'), __('Newer Posts &raquo;'));
		} 
		else 
		{
			previous_post_link('%link', 'Previous', FALSE); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php next_post_link('%link', 'Next', FALSE);
		}
		?>
	</div>
	<?php } ?>

	<?php comments_template(); // Get wp-comments.php template ?>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

</body> 
</html>