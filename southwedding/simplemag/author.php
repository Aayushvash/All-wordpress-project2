<?php 
/**
 * Author template. Display the author 
 * info and all posts by the author
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/ 
?>

<?php get_header(); ?>
		
	<section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">
    		
            <?php if ( have_posts() ) : ?>
			
			<div id="author-box" class="single-box">
    			<div class="clearfix inner">
			
            		<?php $curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) ); ?>
                    
            		<div class="avatar">
            			<?php echo get_avatar( $curauth->ID, 96 ); ?>
                    </div>
                    
                    <div class="author-info">
                        <h2><?php echo $curauth->display_name; ?></h2>
                        <p>
                            <?php echo $curauth->user_description; ?>
                        </p>
                    </div>
                    <ul class="author-social">
                    	<?php if ( $curauth->user_url != '' ) { ?>
                        	<li>
                            	<a href="<?php echo $curauth->user_url; ?>"><?php _e( 'Website', 'themetext' ); ?></a>
                            </li>
                        <?php } ?>
                        <?php if ( $curauth->sptwitter != '' ) { ?>
                        	<li>
                            	<a href="https://twitter.com/<?php echo $curauth->sptwitter; ?>"><?php _e( 'Twitter', 'themetext' ); ?></a>
                            </li>
                        <?php } ?>
                        <?php if ( $curauth->spfacebook != '' ) { ?>
                        	<li>
                            	<a href="http://facebook.com/<?php echo $curauth->spfacebook; ?>"><?php _e( 'Facebook', 'themetext' ); ?></a>
                            </li>
                        <?php } ?>
                        <?php if ( $curauth->spgoogle != '' ) { ?>
                        	<li>
                            	<a href="http://plus.google.com/<?php echo $curauth->spgoogle; ?>?rel=author"><?php _e( 'Google+', 'themetext' ); ?></a>
                            </li>
                        <?php } ?>
                        <?php if ( $curauth->sppinterest != '' ) { ?>
                        	<li>
                            	<a href="http://pinterest.com/<?php echo $curauth->sppinterest; ?>"><?php _e( 'Pinterest', 'themetext' ); ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                    
            	</div>
            </div>
            

            <div class="grids masonry-layout entries">
                <?php 
                 
                    while ( have_posts() ) : the_post();
                
                        get_template_part( 'content', 'post' );
            
                    endwhile; 
               
                ?>
            </div>
            
            <div class="pagination">
            	<?php ti_pagination(); ?>
            </div>
            
            <?php else: ?>
            
                    <p class="message"><?php _e('This author has no posts yet', 'themetext' ); ?></p>

    		<?php endif; ?>
            
    	</div>
    </section>
		

<?php get_footer(); ?>