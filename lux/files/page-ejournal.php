<?php 
/*
Template Name: eJournal Page
*/
get_header(); ?> 

<!-- center -->
<div class="centering">

    <div class="breadcrumbs">
        <?php if(function_exists('bcn_display')){bcn_display();}?>
    </div>
	
    <div id="ejournalPage">
		
        <div class="firstEj first">
        
			<?php $the_query = new WP_Query('post_type=ejournal&posts_per_page=1'); ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <a class="box-button" href="<?php the_permalink();?>" target="_blank">
            	<?php the_post_thumbnail('journal-big');?>
                <h3><?php the_title();?></h3>
                <?php the_excerpt(); ?>    
            </a>
            <?php endwhile; wp_reset_postdata(); ?>    
                        
        </div>
        
        <div class="listEj">
	
			<?php $the_query = new WP_Query('post_type=ejournal&offset=1&showposts=1000'); ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <a class="items" href="<?php the_permalink();?>" target="_blank">
				<?php the_post_thumbnail('journal-medium');?>
                <div class="date"><?php the_title();?></div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>     
                    
        </div>
                	                    
        <div class="clear"></div>
    </div>
        	
</div>
<!-- center -->

<?php get_footer(); ?>

