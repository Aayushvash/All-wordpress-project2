<?php get_header();

$page_for_posts = get_option( 'page_for_posts' );

$url = wp_get_attachment_url( get_post_thumbnail_id($page_for_posts ,'slider_image') );
 ?>

  <!-- baner wrap -->
        <div id="banner-wrap">
        
        	<!-- banner block -->
			
				<div class="bannerinner-block">
				<?php //if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="banner">
					<img src="<?php echo $url; ?>" alt="" />                 
                                    	
                </div>
                <?php //endwhile; endif; ?>
            </div>    
            
          <div class="sidebarBox">
					   <div class="sid-img scrollingBox">
						<a href=" http://64.131.77.249/eckel/calculation-form/" class="fancybox"><img src="<?php echo get_template_directory_uri();?>/images/ab-but.png"></a>
					   </div>
				   </div> 
        
        </div>
        <!-- finsh banner wrap -->
        
        
		<div id="content-wrap">
			
            <!-- begin content -->
			<div id="center-wrap">
				<!-- caption block -->
				<div class="caption-block">
		
					<div class="centering"> 
					
						<div class="layin">
						
						   <h2><?php echo get_the_title($page_for_posts); ?></h2>
						   
						</div>
						
					</div>

				</div>
					
					
			<!-- category box block -->	 
			<div class="categoryoverlay">
				
					
				<div class="category-block">					
					<div class="centering">
				
				<div class="category">
					<?php
						$categories = get_categories( array(
						'orderby' => 'name',
						'parent'  => 0
						) );
					?>
					<ul> 
						<li><a href="#" class="selected" data-filter="*" >All</a></li> 
						<?php
							foreach ( $categories as $category ) {?>
								<li><a href="#" data-filter=".<?php echo $category->slug; ?>" ><?php echo $category->name; ?></a></li>
						<?php } ?>
					</ul> 
					<!--<ul> -->		
						<?php
						/* $categories = get_categories( array(
						'orderby' => 'name',
						'parent'  => 0
						) );

						foreach ( $categories as $category ) {
						printf( '<li><a href="%1$s">%2$s</a></li>',
						esc_url( get_category_link( $category->term_id ) ),
						esc_html( $category->name )
						);
						}  */?>
					<!--</ul>-->
				</div>
					
						
					 </div>    
				</div>
				<!-- End category box block -->

				<!-- blog post -->
				<div class="blogpost-block">
					<div class="centering">
						<div class="centerrap">
							<div class="boxrap">
							
							<?php  $i=1; if (have_posts()) : ?>
							<?php $array=array();?>
								<?php   while (have_posts()) : the_post(); array_push($array,get_the_ID()); ?>
								<?php //get_the_category(); ?>
								<div class="boxeslefts <?php $catt = get_the_category();foreach ($catt as $cattt){			echo $cattt->slug;echo ' ';}?> ">
									<div class="post">
										<div class="post-image">
											<?php the_post_thumbnail('left-blog-image'); ?>
										</div>
										<div class="post-content">
											<h2 class="post-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h2>
											<h3 class="post-subtitle">
												<?php the_field('subtitle'); ?>
											</h3>
											<div class="post-main-content" >
												<p><?php the_excerpt(); ?></p>
												<a class="readmor" href="<?php the_permalink(); ?>">READ MORE</a>
											</div>
											<div class="clear"></div>
											<div class="socials">
												<ul>
													<li class="comments"><a href="#"><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></a></li>
													<li class="dates"><a  href="#"><?php the_time('F jS, Y') ?> </a></li>
													<li class="likes"><a href="">124 Likes</a></li>
													<li class="share"><span>Share:</span>
														<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" title="Share on Facebook."><img src="<?php   echo get_template_directory_uri();?>/images/icon-facebook.png"></a><a href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="Tweet this!"><img src="<?php echo get_template_directory_uri();?>/images/icon-twitter.png"></a><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo $url; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-p.png"></a><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
	  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo get_template_directory_uri();?>/images/icon-google.png"></a></li>
												</ul>
											</div>
										</div>
									</div>
								
									
									

								
										
								</div>
								
								<?php $i++; endwhile; else : endif;  ?>
							
								
								 <div id="result">

								</div>	
								
								
							</div>	
								<div class="postId" style="display:none;"><?php foreach($array as $ar) { echo $ar.' '; } ?></div>

								
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="centerrap">
				<div id="page-nav" class="loadmore"><?php next_posts_link('LOAD MORE') ?></div>
				<!--<a id="loadMore" class="loadmore" href="javascript:void(0);">LOAD MORE</a>	-->
				</div>
				
				
			</div>
			
		</div>
			
	</div>
		


<!--  / left container \ -->




<?php get_footer(); ?>


