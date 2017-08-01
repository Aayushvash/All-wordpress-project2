<?php get_header();?>

<div class="centering">

    <!-- left -->
    <div id="left">
 
        <div class="articleDetail builder" id="post-<?php the_ID(); ?>">    

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="post" id="post-<?php the_ID(); ?>">

                <p>Fotostrecke / <a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a></p>
    
                <h1 class="title">
                    <?php the_title(); ?>
                </h1>
    
                <div class="articleImg">
                
                    <div class="social-buttons">
                        <span class='st_twitter_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='twitter'></span>
                        <span class='st_facebook_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='facebook'></span>
                        <span class='st_googleplus_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='plusone'></span>  
                        <?php TellAFriend(); ?>
                    </div>
                    
					<?php
						echo wp_get_attachment_image( $post->ID, 'medium' ); 
					?>
                                    
                </div>
                                        
                <div class="entry">
				<?php
					//echo get_the_ID();
				 ?>
                	<?php $data = getPostsById($post->post_parent); 
					ksort($data);
					//echo "<pre>";
					//print_r($data);
					?>
                    <?php 
					$i=1;
					$t=$_SESSION['pg_no'];
					   foreach($data as $k=>$v) 
					   {
					   if($i<=$t){
						if(get_the_ID() == $v->ID){
							$curr = $i; 
							//echo "curr " . $curr ." and id " .$v->ID;
							break;
							//exit;
							}
						}
						$i++;
					   }
					?>
                    <h5><strong>Bild <?php echo  $curr; ?> von <?php echo $_SESSION['pg_no']; ?></strong></h5>
                    
                    <?php if ( !empty($post->post_excerpt) ) the_excerpt(); ?>
                    
                    <?php the_content(); ?>
    
                    <div class="navigation">
					<?php  ?>
                        <div <?php if($curr == $_SESSION['pg_no']) { ?>style="display:  none;"<?php } ?> class="alignright"><?php next_image_link() ?></div>
                        <div class="alignleft"><?php previous_image_link() ?></div>
                    </div>
                
                </div>
                
            </div>
            
            <?php endwhile; else: ?>
            <p>Sorry, no attachments matched your criteria.</p>
            <?php endif; ?>
     
        </div>

    </div>
    <!-- left container -->
    
    <?php get_sidebar('article'); ?>

	<div class="clear"></div>
</div>

<?php get_footer(); ?>