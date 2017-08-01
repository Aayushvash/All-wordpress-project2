<?php get_header();?>
<div id="banner-wrap" class="inner-banner">
        <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/blog-banner.jpg" />
		
	</div>
</div>
<!--  content -->
<div id="content" class="content-block">
<!-- finish  header --> 
	<div class="centring">
<!--  / left container \ -->
<div class="blog-left">
<?php if ( is_active_sidebar( 'blog_sidebar' ) ) : ?>
	
		<?php dynamic_sidebar( 'blog_sidebar' ); ?>
	
<?php endif; ?>

	

</div>

<!--  \ left container / -->
<div class="blog-right">

<?php  wp_reset_query(); if (have_posts()) : ?>
    
    <?php while (have_posts()) : the_post(); ?>
	
    
    <div class="blog-box" <?php // post_class() ?> id="post-<?php the_ID(); ?>">
    
       <div class="day"> 
		<h1><?php the_time('d') ?><br/><span><?php the_time('M') ?></span></h1>
	   </div>
	   
	   <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a> 
	   <br/>
	   <small>By:<?php the_author() ?></small>
	   </h2>
	   
	  
        <div class="entry">
            <?php the_content('Read the rest of this entry &raquo;'); ?>
        </div>
    
    </div>
    
    <?php endwhile; ?>
    
    <div class="navigation">
        <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
        <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
    </div>
    
    <?php else : ?>
    
    <h2 class="center">Not Found</h2>
    
    <p class="center">Sorry, but you are looking for something that isn't here.</p>
    
	<?php get_search_form(); ?>
    
    <?php endif; ?>


</div>
</div>




<?php get_footer(); ?>