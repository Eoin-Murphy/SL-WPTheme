<?php
/**
 * @package WordPress
 * @subpackage Spurious_Logic_Theme
 */
?>
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
<div id="top"><h1 id="logo"> <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> <small></small></h1></div> 
<div id="header"> 
 
<div id="top_bar"> 
	<ul id="front_menu"> 
	<li><a class="s" title="Home" href="http://spurious-logic.net"><span>Home</span></a></li> 
	<li class="page_item page-item-2"><a href="http://spurious-logic.net/?page_id=2" title="About"><span>About</span></a></li> 
	</ul> 
</div> 
 
</div> 
<div id="content"> 
<div id="content-body"> 


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?> post">
	 <h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
	<div class="meta"><?php _e("Filed under:"); ?> <?php the_category(',') ?> &#8212; <?php the_tags(__('Tags: '), ', ', ' &#8212; '); ?> <?php the_date() ?> <?php edit_post_link(__('Edit This')); ?></div>

	<div class="storycontent">
		<?php the_content(__('(more...)')); ?>
	</div>

	<div class="feedback">
		<?php wp_link_pages(); ?>
		<?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
	</div>

</div>

<?php comments_template(); // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>


</div> 

<!-- begin sidebar -->
<div id="content-sidebar">

<ul>
<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
	<?php wp_list_pages('title_li=' . __('Pages:')); ?>
	<?php wp_list_bookmarks('title_after=&title_before='); ?>
	<?php wp_list_categories('title_li=' . __('Categories:')); ?>

 <li id="archives"><?php _e('Archives:'); ?>
	<ul>
	 <?php wp_get_archives('type=monthly'); ?>
	</ul>
 </li>
 <li id="meta"><?php _e('Meta:'); ?>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
	</ul>
 </li>
<?php endif; ?>

</ul>

</div>
<div class="clear"></div> 
</div> 
<div id="footer"> 
<span class="text"> 
Copyright &copy; 2010 <a href="http://spurious-logic.net">Spurious Logic</a> &middot; Powered by <a href="http://www.wordpress.org" title="Wordpress" target="_blank">Wordpress</a>
 <br />
<a title="Go to top" class="top" href="#top">Go to top &uarr;</a> 
 
</span> 
</div> 
 

</body> 
</html>