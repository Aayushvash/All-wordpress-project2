<?php
/**
 * Template Name: Team page
 * @subpackage Default_Theme
 */

get_header(); ?>
</div>
	<!--  \ layout / -->
 <!--  / content \ -->
<div id="content">
    	<div id="contentCn">

            <!--  / center side\ -->
            <div id="centerSide">
        
                <!--  / about bar \ -->
                <div class="aboutBar">
              
        			  <h2>MEET OUR TEAM</h2>
                    
                    		<!--  / text bar \ -->
                            <div class="text">
                            
                       
                        
                            
							<div class="singleteam">
                             <?php while (have_posts()) : the_post(); ?>
                            <div class="singleteamleft">
                            <div class="image"><?php the_post_thumbnail( array(245,170) ); ?></div>
                            </div>
                            <div class="singleteamright">      
                              <?php 
						$title=get_field('title');
					   $direct=get_field('direct');
					   $cell=get_field('telephone_number');
					   $fax=get_field('fax');
					   $email=get_field('email');				   
					   ?>                      
                    	
                                <h2><?php the_title(); ?></h2>
                                <?php if(!empty($title)) { ?>
                                <p><?php echo get_Field('title'); ?></p>
                                <?php } ?>
                                  <?php if(!empty($direct)) { ?>
                                <p><strong>Direct: </strong><?php echo get_field('direct'); ?></p>
                                <?php } ?>
                               <?php if(!empty($cell)) { ?>
                                 <p><strong>Cell: </strong> <?php echo get_field('telephone_number'); ?></p> 
                                 <?php } ?>  
                                   <?php if(!empty($fax)) { ?>
                                  <p> <strong>Fax: </strong> <?php echo get_field('fax'); ?></p>
                                  <?php } ?>   
                                <p><strong>Email: </strong><a href="mailto:<?php echo get_field('email'); ?>"><?php echo get_field('email'); ?></a></p>
                        
                            <?php the_content(); ?>
                             
                             
                             
                            
                             </div>
                              <?php endwhile; ?>  
                             </div>   
                                
                                
                     		</div>  
                            <!--  / text bar \ -->    
          
                </div>
                <!--  \ about bar / -->
        
            </div>
            <!--  \ center side/ -->
        
    	</div>    
	</div>
	<!--  \ content / -->
    <?php get_footer(); ?>