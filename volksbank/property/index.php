<?php get_header(); ?>

		<div id="content">
	    <div class="col-ttc">
    
    <div class="page-entry">
  <?php if (AdminPageFramework::getOption( 'bo_options', array( 'blog', 'bo_blog_headline'), '' )) { ?>
  <h2 class="pagetitle"> <?php	echo AdminPageFramework::getOption( 'bo_options', array( 'blog', 'bo_blog_headline'), '' ); ?> </h2><?php } ?>

<?php 
function offer_excerpt_length($length) {return 45;}
add_filter('excerpt_length', 'offer_excerpt_length');
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; 
$loop = new WP_Query( array( 'orderby' => 'date', 'paged' => $paged) );
while ( $loop->have_posts() ) : 
$loop->the_post(); ?>

<div class="blog-list-entry">
    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
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
			

<?php endwhile;
		remove_filter('excerpt_length', 'offer_excerpt_length');  ?>

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

<?php wp_reset_query(); ?>

</div><!-- eof page-entry -->
</div><!-- eof col -->


<div class="col-otc cr">
<?php get_template_part('sidebar_blog'); ?>
</div>

<div class="clear"></div>
</div><!-- eof content -->

<?php get_footer(); ?>