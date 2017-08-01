<?php
get_header(); ?>
<?php $url = get_field('header_image');
global $wp_query;
$typeterms = get_the_terms( $post->ID , 'type' );

?>
<!-- begin subpage block -->
        		<article class="subpage-block" style="background: url(<?php  echo $url; ?>) no-repeat 100%/cover;">
                
                	<div class="centring">
                    
                    	<div class="head"><h3><?php foreach( $typeterms as $term ) { echo $term->name; }  ?></h3></div>
                        
                        <div class="np desktopview">
                        
                        	<ul>               
                            	<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
                                <li><?php foreach( $typeterms as $term ) { echo $term->name; }  ?></li>
                                <li><?php echo get_the_title(); ?></li>                
                            </ul>
                        
                        </div>
                    
                    </div>
            <div class="overlay"></div>
            	</article>
            	<!-- finish subpage block -->
				
					<article class="bread-block mobileview">
					<div class="centring">
						<div class="np"> 
							<ul>               
                            	<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
                                <li><?php foreach( $typeterms as $term ) { echo $term->name; }  ?></li>
                                <li><?php echo get_the_title(); ?></li>                
                            </ul>      
						</div>
					</div>	
				</article>

				<!-- begin content block -->
				<article class="content-block register">

					<div class="centring">
                    
                    	<div class="leftbox detailBox">
                       		
							<div class="imageText">
							   <?php the_post_thumbnail('img5'); ?>
							   <?php $fields = get_field('add_text'); if($fields){ ?>
								   <ul>
									   <?php $c=1; foreach($fields as $field){ ?>
										  <li class="<?php if($c%2==0) { echo "last"; } ?>"><?php echo $field['add_text']; ?></li>
									   <?php $c++; } ?>
								   </ul>
							   <?php } ?>
							</div>

							<div class="linkBox">
								<ul>
									<?php if(get_field('schrijf_direct_in_link')) { ?>
									  <li><a href="<?php echo get_field('schrijf_direct_in_link'); ?>">Schrijf direct in!<span>&nbsp;</span></a></li>
									<?php } ?>
									<?php if(get_field('neem_contact_op_link')) { ?>
									  <li class="contact"><a href="<?php echo get_field('neem_contact_op_link'); ?>">Neem contact op<span>&nbsp;</span></a></li>
									<?php } ?>
								</ul>
							</div>

                        <div class="tabBox desktopview">
						 <?php $tabfields = get_field('add_tabs'); if($tabfields){ ?>
							<div class="tabLink">
								<ul>
									<?php  $i=1; foreach($tabfields as $field){ ?>
									   <li rel="tab_<?php echo $i; ?>" class="<?php if($i==1){ echo "active"; } ?>"><a href="javascript:void(0);"><?php echo $field['add_title']; ?></a></li>
									<?php $i++;  } ?>
								</ul>
							</div>
							<div class="clear"></div>
						 <?php } ?>
						  <?php $tabfields = get_field('add_tabs'); if($tabfields){ ?>
							<div class="tabText">
									<?php $j=1; foreach($tabfields as $field){ ?>
									   <div id="tab_<?php echo $j; ?>" class="tabdetail" <?php if($j==1){ ?>style="display: block;"<?php  }else { ?>style="display: none;"<?php  } ?>><?php echo $field['add_text']; ?></div>
									<?php $j++; } ?>
							</div>
						 <?php } ?>
						</div>

                        <div class="mobiletabBox mobileview">
						  <?php $tabfields = get_field('add_tabs'); if($tabfields){ ?>
							
									<?php foreach($tabfields as $field){ ?>
									<div class="tabText">
									<div class="title"><?php echo $field['add_title']; ?><span></span></div>
									   <div class="tabdetail"><?php echo $field['add_text']; ?></div>
									   </div>
									<?php } ?>
							
						 <?php } ?>
						</div>						
								                                     
                    	</div>
                    
                    	<div class="rightbox register">
                        
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('curcus_right_sidebar') ) : ?> <?php endif; ?>
                    
                    	</div>
                    
                    </div>

				</article>
				<!-- finish content block -->
                
                <!-- begin signup block -->
                <article class="signup-block">
                
                	<div class="centring">
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('newsletter_sidebar') ) : ?> <?php endif; ?>   
                    </div>
                
                </article>
                <!-- finish signup block -->

<?php get_footer(); ?>