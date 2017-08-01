<?php get_header(); ?>


<div id="content">

   <div class="col-ttc">
    
           <div class="page-entry mr">


<?php if (have_posts()) : ?>

	<h2 class="pagetitle"><?php _e('Search Results', 'bobox'); ?></h2>
        <p><?php _e('You searched for', 'bobox'); ?>: <em style="color:#c00;"><?php the_search_query() ?></em></p>
    
<?php while (have_posts()) : the_post(); ?>

<div class="blog-list-entry">
<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'bobox'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>		
			</div>

<?php endwhile; ?>
<div class="post-nav">
<?php
global $wp_query;
$big = 999999999; 
echo paginate_links( array(
'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
'format' => '?paged=%#%',
'current' => max( 1, get_query_var('paged') ),
'total' => $wp_query->max_num_pages
) );
?>
<div class="clear"> </div>

</div><!-- eof post-nav -->

	
	<?php else : ?>

		<h2>Entschuldigung, leider keine Ergebnisse zu - <span style="color:#c00;"><em><?php the_search_query() ?></em></span> - gefunden</h2>

        
	<?php endif; ?>
    </div>
</div><!-- eof col ttc -->

<div class="col-otc cr">
<?php get_template_part('sidebar_page'); ?> 
</div>

<div class="clear"></div>
</div><!-- eof content -->
<?php get_footer(); ?>
