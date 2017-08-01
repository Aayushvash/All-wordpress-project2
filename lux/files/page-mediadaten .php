<?php 
/*
Template Name: Mediadaten Page
*/
get_header(); ?> 

<!-- center -->
<div class="centering">

    <div class="breadcrumbs">
        <?php if(function_exists('bcn_display')){bcn_display();}?>
    </div>
	
    <div id="ejournalPage">
		
        <div class="firstEj">
        	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('mediadaten_sidebar') ) : ?><?php endif; ?>
        </div>
        
        <div class="listEj">
	
			<?php $the_query = new WP_Query('post_type=mediadaten&posts_per_page=-1'); ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="items">
				<?php the_post_thumbnail('journal-medium');?>
                <div class="date"><?php the_title();?></div>
                <?php the_excerpt();?>
                <?php if(get_field('pdf_file')){?>
                <a href="<?php the_field('pdf_file');?>" target="_blank" class="button"><?php if(get_field('button_text')) {?><?php the_field('button_text');?><?php } else { ?>Download PDF<?php } ?></a>
                <?php } elseif (get_field('button_text')) { ?>
                <a href="<?php the_permalink();?>" target="_blank" class="button small"><?php if(get_field('button_text')) {?><?php the_field('button_text');?><?php } else { ?>Zur letzten Ausgabe<?php } ?></a>
                <?php } ?>
                
            </div>
            <?php endwhile; wp_reset_postdata(); ?>     
                                
        </div>
                	                    
        <div class="clear"></div>
    </div>
        	
</div>
<!-- center -->

<?php get_footer(); ?>

