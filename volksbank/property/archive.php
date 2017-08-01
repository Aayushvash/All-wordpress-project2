<?php get_header(); ?>


<div id="content">

    
    <div class="col-ttc">

<div class="page-entry">


 	  <?php $post = $posts[0];  ?>
 	  
 	  <?php if( is_tag() ) { ?>
		<h2 class="pagetitle"><?php printf(__('%s', 'bobox'), single_tag_title('', false) ); ?></h2>
 	  <?php } elseif (is_day()) { ?>
		<h2 class="pagetitle"><?php printf(_c('%s', 'bobox'), get_the_time(__('F jS, Y', 'bobox'))); ?></h2>
 	  <?php } elseif (is_month()) { ?>
		<h2 class="pagetitle"><?php printf(_c('%s', 'bobox'), get_the_time(__('F, Y', 'bobox'))); ?></h2>
 	  <?php } elseif (is_year()) { ?>
		<h2 class="pagetitle"><?php printf(_c('%s', 'bobox'), get_the_time(__('Y', 'bobox'))); ?></h2>
	  <?php } elseif (is_author()) { ?>
		<h2 class="pagetitle"><?php _e('Author Archive', 'bobox'); ?></h2>
        
        
        
        
     
                
 	  <?php  } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle"><?php _e('Blog Archives', 'bobox'); ?></h2>
 	  <?php  } else { } ?>



		<?php $category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>'; ?>

<?php 

		
									
function archive_excerpt_length($length) {
return 35;
}
add_filter('excerpt_length', 'archive_excerpt_length'); 

		function archive_excerpt_more($more) {
return ' <a class="more" href="'. get_permalink($post->ID) .'">'. __(' <em>&rarr;</em>','bobox') .'</a>';
   }
add_filter('excerpt_more', 'archive_excerpt_more');

        

?>


<?php while (have_posts()) : the_post(); ?>
<?php if (is_category() || is_date() || is_author() || is_tag()) { ?>
	
        				<div class="blog-list-entry">
   
             	<h3><a href="<?php the_permalink() ?>"  title="<?php printf(__('Learn more about %s', 'bobox'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h3>
 <?php if (has_post_thumbnail() )  { ?>
           	<div class="teaser-list-thb">
            <a href="<?php the_permalink() ?>" title="<?php printf(__('%s', 'bobox'), the_title_attribute('echo=0')); ?>">
			<?php the_post_thumbnail('news-thumb' ); ?></a></div>
			<?php } ?>
<?php  the_content(); ?>


<?php  
$data = get_option('bo_options');
$cat =  isset( $data['blog']['bo_show_categories'] ) ? $data['blog']['bo_show_categories'] : null; 
$tag =  isset( $data['blog']['bo_show_tags'] ) ? $data['blog']['bo_show_tags'] : null;       
$date =  isset( $data['blog']['bo_show_date'] ) ? $data['blog']['bo_show_date'] : null; 
$author =  isset( $data['blog']['bo_show_author'] ) ? $data['blog']['bo_show_author'] : null; 
?>   
<div class="clear"></div>
<div class="meta-category">
<?php if($date == 'yes') { ?> <span class="meta"><?php echo __('Published at: ', 'bobox');?></span> <?php the_date(); ?><?php } ?><?php if($author == 'no' && $date == 'yes') { ?><br /><?php } ?>
<?php if($author == 'yes') { ?> | <span class="meta"><?php echo __('by: ', 'bobox');?></span> <?php the_author(); ?> <br /> <?php } ?>
<?php if($cat == 'yes') { ?>
<span class="meta"><?php echo __('Category: ', 'bobox');?></span> <?php the_category(' &middot;'); ?><?php } ?>
<?php if ($tag == 'yes') { ?> &nbsp;| <?php $tags = the_tags();  if ( ! empty( $tags ) )	echo '<span class="meta">' . $tags . '</span>'; ?> <?php  } ?>
</div>
				
                </div><!-- eof entry -->
			
		
	<?php	}
		else  { }
		
		
		 endwhile; ?>
        
        <?php remove_filter('excerpt_length', 'archive_excerpt_length');
		remove_filter('excerpt_more', 'archive_excerpt_more'); ?>
        

     
 <div class="post-nav">
<?php
global $wp_query;
$big = 999999999; // need an unlikely integer
echo paginate_links( array(
'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
'format' => '?paged=%#%',
'current' => max( 1, get_query_var('paged') ),
'total' => $wp_query->max_num_pages
) );
?>
<div class="clear"> </div>
				</div><!-- eof post-nav -->

</div><!-- eof page-entry -->
</div><!-- eof col -->


<div class="col-otc cr">
<?php get_template_part('sidebar_blog'); ?>
</div>

<div class="clear"></div>
</div><!-- eof content -->


<?php get_footer(); ?>