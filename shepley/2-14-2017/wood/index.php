<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
</div>
<div id="content">
    	<div id="contentCn">

            <!--  / center side\ -->
            <div id="centerSide">
        
                <!--  / about bar \ -->
                <div class="aboutBar">
                
                 <h2>BLOG</h2>
                
                     <div class="text">
                     
                   
                     <div class="blogleft">
                
                	<?php if (have_posts()) : ?>
    
   					 <?php while (have_posts()) : the_post(); ?>
                     
                     	  <div class="archive"><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                      <span><?php the_time('jS F Y') ?></span>
                      </div>
                      
                      <?php 
					  echo content(50);
					 /* $content=get_the_content();
					  $content1=substr($content,0,50);
					  echo $content1;*/
					 
					  
					  ?>
                       <p class="postmetadata">Posted in <?php the_category(', ') ?></p>
                       <?php endwhile; ?>
                      <?php else: ?>
                      <h3>Sorry, No Post Found</h3>
                      <?php endif; ?>
                      
                       <div class="navigation">
                          <ul>
                          	<li><?php next_posts_link('Next') ?></li>
                            <li><?php previous_posts_link('Previous') ?></li>
                         </ul>
        			    </div>
                        </div>
                        
                        
                          <div class="blogright"><?php get_sidebar(); ?></div>
                        
                 </div>
        
                </div>
                <!--  \ about bar / -->
        
            </div>
            <!--  \ center side/ -->
        
    	</div>    
	</div>
<?php get_footer(); ?>

