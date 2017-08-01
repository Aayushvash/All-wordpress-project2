<?php get_header(); ?>


<div id="content">
	
    
    
    
    <div class="page-entry">
    
    		 <div class="col-ttc">
            
            

				<h2 class="pagetitle"><?php printf( __( '%s', 'bobox' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h2>
			
            	<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';



function archive_excerpt_length($length) {
return 45;
}
add_filter('excerpt_length', 'archive_excerpt_length');

			 while (have_posts()) : the_post(); 
			
			 ?>

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
        		
		
			</div>
<?php 

endwhile; 
remove_filter('excerpt_length', 'archive_excerpt_length');
?>

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


</div><!-- eof col -->

 <div class="col-otc cr">
<?php get_template_part('sidebar_blog'); ?>
</div>
	<div class="clear"></div>
</div><!-- eof page-entry -->
</div><!-- eof content -->


<?php get_footer(); ?>

