<?php get_header(); /*Template Name: user post Page Template */ ?><div class="clear"></div>        			
<!-- begin content -->			
<div id="content-wrap">      
<div class="centering">		
<!-- begin leftwrap -->			
<div class="portfolio-block">
<? if ( is_user_logged_in() ):

    global $current_user;
    get_currentuserinfo();
    $author_query = array('post_type'=>'user_post', 'posts_per_page' => '-1','author' => $current_user->ID);
    $author_posts = new WP_Query($author_query);
    while($author_posts->have_posts()) : $author_posts->the_post();
    ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>  
			<img src="<?php the_field('logo'); ?>" />
			<a href="<?php the_field('pdf_link'); ?>">Pdf Link</a>
			<?php the_content(); ?>
    <?php           
    endwhile;

else :

    echo "not logged in";

endif; ?>

			
<h1><?php the_title(); ?></h1>						
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;   ?>              
<?php query_posts(array('post_type'=>'portfolio','orderby' => 'date','showposts'=>6, 'paged' => $paged));  if(have_posts()):;  $i = 3;  $k = 1;  ?>              
<?php while(have_posts()):the_post(); if( $i >3 == 0 )	$class = 'clear';   else $class = 'clear sub';   if( $k % 3 == 0 )	 $classs = 'clear'; else $classs = ''; ?>			
<div class="image">			
<a href="<?php the_permalink();?>"><?php the_post_thumbnail('port-thumb'); ?></a>			
<div class="text-right"><?php the_excerpt(); ?> </div>			
<a class="readmore" href="<?php the_permalink();?>">Read More</a>			
</div>			 
<div class="<?php echo $classs ?>"></div>			 
<?php  $k++;  $i++; endwhile;  ?>
 <?php if(function_exists('wp_paginate')) {   wp_paginate();  }  ?>                          
              
<?php else: endif; wp_reset_postdata(); ?>						
</div>			
<!-- finish leftwrap -->							
</div>		
</div>		<!-- finish content -->
<?php get_footer(); ?>