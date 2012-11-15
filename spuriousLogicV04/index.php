<!DOCTYPE html>
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
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> class="no-js"> 

<head> 
	<title>Spurious Logic</title> 
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<style type="text/css" media="screen">@import url( <?php bloginfo('stylesheet_url'); ?> );</style>
		
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/base/jquery-ui.css" type="text/css" media="all" /> 
	<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" /> 	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script> 
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript"></script> 

	<script src="scripts/modernizr-1.6.min.js"></script> 
	<script>
	$(document).ready(function() {
		$("#accordion").accordion({active: false, alwaysOpen: false, autoHeight: false, collapsible: true});
	});
	</script>
	<?php wp_head(); ?>
</head> 



<body>
<div id="container"> 
	<div id="title">
		<h1 class="center"><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></h1>	
	</div>
	<!-- begin navbar -->
	<div id="navbar">
		<ul>				
			<li class="page_item page-item-2"><a href="http://spurious-logic.net/?page_id=2" title="About"><span>About</span></a></li> 	
			<?php 	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
			<?php wp_list_categories('title_li=' . __('Categories:') . '&exclude=24,26,27, 28'); ?>
			
			 <li class="categories">Series:
				 <ul>
					<li><a href="http://spurious-logic.net/?cat=24">Tale of Moratalla</a></li>
					<li><a href="http://spurious-logic.net/?cat=27">Spartan Folly</a></li>
					<li><a href="http://spurious-logic.net/?cat=26">Sisyphean Design</a></li>
				 </ul>
			 </li>
			 
			 <li id="meta" class="categories"><?php _e('Meta:'); ?>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="<?php bloginfo('rss2_url'); ?>"><img src="http://www.mozilla.org/images/feed-icon-14x14.png" alt="RSS Feed" title="RSS Feed" /></a></li>
				</ul>
				
			 </li>
			<?php endif; ?>
		</ul>	

	</div>
	<!-- end navbar -->
	<!-- begin content-pane -->
	<div id="content-pane"> 
		<?php
		if ( is_category('24') || is_category('26') || is_category('27'))
		{			
			query_posts($query_string .'&order=ASC&orderby=ID');
		}
		else
		{
			if(!is_category())
			{
				//trying to get 1 post on the front page. and multiple posts on subsequent pages.			
				if ( $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] == 'www.spurious-logic.net/')
				{					
					$query_string = $query_string . '&posts_per_page=1';
				}
				else
				{
					//still searching from index 8
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;		
					$offset = 1 + (($paged - 2) * 8); //starts from 2
					$query_string = $query_string . '&offset=' . $offset;		
				}
			}
			
			
			query_posts( 'post_type=recipes,posts');
			query_posts($query_string . '&cat=-24,-26,-27');
		}
		?>

		<div class="post-links">
			<?php if(is_single()) 
			{
				if ( in_category('24') || in_category('26') || in_category('27'))
				{					
					previous_post_link('%link', '&laquo; Previous Post', TRUE); ?>&nbsp;&nbsp;&#8212;&nbsp;&nbsp;<?php next_post_link('%link', 'Next Post &raquo;', TRUE);
				}
				else
				{
					next_post_link('%link', '&laquo; Newer Posts', FALSE, '24 or 26 or 27'); ?>&nbsp;&nbsp;&#8212;&nbsp;&nbsp;<?php previous_post_link('%link', 'Older Posts &raquo;', FALSE, '24 or 26 or 27');
				}
			}
			else 
			{
				if ( in_category('24') || in_category('26') || in_category('27'))
				{					
					posts_nav_link('&nbsp;&nbsp;&#8212;&nbsp;&nbsp;', __('&laquo; Older Posts'), __('Newer Posts &raquo;'));
				}
				else
				{
					posts_nav_link('&nbsp;&nbsp;&#8212;&nbsp;&nbsp;', __('&laquo; Newer Posts'), __('Older Posts &raquo;'));
				}

				
			} ?>
		</div>
		
		<?php
		if (have_posts()) : while (have_posts()) : the_post();
		?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?> post">
		<div class="postTitle">
			<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
		</div>
			
			<div <?php if(get_the_ID() % 2 == 0) { echo 'class="story"';} else {echo 'class="story"';} /*even-odd removed*/ ?> >
				<?php the_content(); ?>
			</div>
			
			<div class="clear"></div> 
			
		</div>

		<?php comments_template(); // Get wp-comments.php template ?>

		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
		

		<div class="post-links">
			<?php if(is_single()) 
			{
				if ( in_category('24') || in_category('26') || in_category('27'))
				{					
					previous_post_link('%link', '&laquo; Previous Post', TRUE); ?>&nbsp;&nbsp;&#8212;&nbsp;&nbsp;<?php next_post_link('%link', 'Next Post &raquo;', TRUE);
				}
				else
				{
					next_post_link('%link', '&laquo; Newer Posts', FALSE, '24 or 26 or 27'); ?>&nbsp;&nbsp;&#8212;&nbsp;&nbsp;<?php previous_post_link('%link', 'Older Posts &raquo;', FALSE, '24 or 26 or 27');
				}
			}
			else 
			{
				if ( in_category('24') || in_category('26') || in_category('27'))
				{					
					posts_nav_link('&nbsp;&nbsp;&#8212;&nbsp;&nbsp;', __('&laquo; Older Posts'), __('Newer Posts &raquo;'));
				}
				else
				{
					posts_nav_link('&nbsp;&nbsp;&#8212;&nbsp;&nbsp;', __('&laquo; Newer Posts'), __('Older Posts &raquo;'));
				}

				
			} ?>
		</div>

	</div>
	<!-- end content pane -->
</div>
</body> 
</html>