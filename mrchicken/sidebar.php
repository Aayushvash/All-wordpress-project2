<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>

	<!--  / right container \ -->
	<div id="rightCntr">
		
		<!--  / right box \ -->
		<div class="rightBox">
            
            <!--<div class="search">
            	
                <h3>Campagne zoeken</h3>
                
                <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                    <input type="text" class="field" placeholder="Campagne zoeken" value="" name="s" id="s" />
                    <input type="submit" id="searchsubmit" value="Search" />
                    <input type="hidden" name="post_type" value="campagness" />
                </form>
            
            </div>
            
            <div class="campag">
            	
                <h3>Recente campagnes</h3>
                
                <ul>
					<?php query_posts('post_type=campagness&showposts=4'); ?>
                    <?php 
                    $counter=1;
                    while (have_posts()) : the_post(); ?>
                    <li class="<?php echo $counter ?>"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('cam-thumb3'); ?></a></li>
                    <?php if($counter==2){$counter=1;}else {$counter++; }endwhile; wp_reset_query(); ?>
                </ul>
                
                <a href="<?php echo get_theme_option('campagne'); ?>" class="all">Bekijk alle campagnes</a>
                
            </div>-->
            
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Page Sidebar') ) : ?>
        	<?php endif; ?>
            
        </div>
		<!--  \ right box / -->            
                    					
	</div>
	<!--  \ right container / -->