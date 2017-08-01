<?php get_header(); ?>

<!--  main slider -->
<div id="mainSlider">
	<div class="centering">
        
        <div class="flexslider">
            <ul class="slides">   
                <?php $the_query = new WP_Query('cat='.of_get_option('slider_category').'&posts_per_page='.of_get_option('slider_number')); ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <li>
                    <div class="detail">

						<?php 
                            $attachment_id = get_field('featured_icon'); 
                            $size = "featured-img"; 
                            $image = wp_get_attachment_image_src( $attachment_id, $size ); 
                        ?>     
                    
                        <div class="cat-title">
                            <?php $category = get_the_category(); echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name;?>
                            <?php if(get_field('featured_icon')) {?>
                            <img src="<?php echo $image[0]; ?>" /> 
                            <?php } ?>
							<?php '</a>'; ?>
                        </div>            
                                    
                        <div class="inner">
                            <h1>
                                <a href="<?php the_permalink() ?>">
                                    <?php if(get_field('second_headline')) { echo '<span class="subheader">'. get_field('second_headline'). '</span>'; } the_title(); ?>
                                </a>
                            </h1>                                
                            <a href="<?php the_permalink() ?>"><?php the_excerpt(); ?></a>    
                            <a href="<?php the_permalink() ?>" class="button">
								<?php if(get_field('button_text')) {?><?php the_field('button_text');?><?php } else { ?>Jetzt Erleben!<?php } ?>
                            </a>                            
                        </div>
                        
                    </div>	
                     <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('slider-img');?></a>
                </li>
                <?php endwhile; wp_reset_postdata(); ?>    
            </ul>
        </div>
        
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        	<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
        <?php endwhile; endif; ?> 
        
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home_three_boxes') ) : ?><?php endif; ?>
        
        <div class="clear"></div>
        
    </div>
</div>    
<!--  main slider -->

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home_full_widget') ) : ?><?php endif; ?>


<div class="clear"></div>

<?php get_footer(); ?>

