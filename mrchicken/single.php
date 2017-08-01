<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>
<!--  \ np box / -->
        
<!--  / left container \ -->
<section id="content-wrap">
		<article class="text-block">
    <!--  / news box \ -->

		<?php if (have_posts()) : 			$post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
        <?php /* If this is a category archive */ if (is_category()) { ?>
        <h1 class="pagetitle"><?php printf(__('Archive for the &#8216;%s&#8217; Category', 'kubrick'), single_cat_title('', false)); ?></h1>
        <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
        <h1 class="pagetitle"><?php printf(__('Posts Tagged &#8216;%s&#8217;', 'kubrick'), single_tag_title('', false) ); ?></h1>
        <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
        <h1 class="pagetitle"><?php printf(_c('Archive for %s|Daily archive page', 'kubrick'), get_the_time(__('F jS, Y', 'kubrick'))); ?></h1>
        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
        <h1 class="pagetitle"><?php printf(_c('Archive for %s|Monthly archive page', 'kubrick'), get_the_time(__('F, Y', 'kubrick'))); ?></h1>
        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
        <h1 class="pagetitle"><?php printf(_c('Archive for %s|Yearly archive page', 'kubrick'), get_the_time(__('Y', 'kubrick'))); ?></h1>
        <?php /* If this is an author archive */ } elseif (is_author()) { ?>
        <h1 class="pagetitle"><?php _e('Author Archive', 'kubrick'); ?></h1>
        <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
        <h1 class="pagetitle"><?php _e('Blog Archives', 'kubrick'); ?></h1>
        <?php } ?>

		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?> style="margin-bottom:25px;">
			
            
            	
            <a href="<?php the_permalink() ?>" style="float:left;"><?php the_post_thumbnail('cam-thumb2'); ?></a>
                
            <h2><a style="color:#ffb633;text-decoration:none;display:inline;" href="<?php the_permalink() ?>" title="<?php printf(__('Permanent Link to %s', 'kubrick'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h2><?php the_date(); ?>
            <div class="entry" style="margin-top:10px;">
            
            	<p><?php echo get_the_content(__('Read more', 'kubrick')); ?></p>
                	
            </div>
			<a href="/category/news/" style="float:right;padding: 5px 10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;background-color: white;color: #C30000;text-decoration: none;">Back To News</a>
		</div>
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'kubrick')); ?></div>
			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'kubrick')); ?></div>
		</div>
        
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>".__("Sorry, but there aren't any posts in the %s category yet.", 'kubrick').'</h2>', single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo('<h2>'.__("Sorry, but there aren't any posts with this date.", 'kubrick').'</h2>');
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>".__("Sorry, but there aren't any posts by %s yet.", 'kubrick')."</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>".__('No posts found.', 'kubrick').'</h2>');
		}
	  //get_search_form();
	endif;
?>
    <!--  \ news box / -->
    </article>  
</section>
<!--  \ left container / -->

<?php get_footer(); ?>