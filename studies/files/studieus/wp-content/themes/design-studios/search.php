<?php get_header(); 

$object = get_queried_object();
$Date = $object->post_date;
$date = strtotime($Date); 
$new_date = date('d F Y', $date);
?>

<!-- begin content -->
            <div id="content-wrap">

                <div class="studies-block inner-page">
                    <div class="centering">
                        <div class="left">
                            <div class="blog">
							<?php  $feat_image = wp_get_attachment_url( get_post_thumbnail_id(20) ); ?>
							<div class="category_banner" style="background-image:url('<?php echo $feat_image;?>'); background-size:cover;">
                                    <div class="title_and_date_bar">
                                        <!--<span class="date">in <b>Leermethodes</b> op <b>31 januari 2016</b></span>-->
                                    </div>
                                </div>
							

                        <div class="content_category standard_page">
								
                            <div class="blog">
                                <div class="box training">
                                    <div class="head">
                                        <h2>Search Results</h2>
                                    </div>
									
				<div class="listing">
				
					<ul>
						<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>	

						<li>
							<a href="<?php the_permalink();?>"><i><?php the_post_thumbnail('search-img');?></i>
							
								<p><span class="orng"><?php the_title(); ?></span>
								
								<?php $excerpt = get_the_excerpt();?>
								<span class="norml"><?php echo substr($excerpt,0,150);?>...</span>
								</p>
								<div class="clearfix"></div>
								
							</a>
						 </li>
						
						<?php endwhile; ?>
			
						<div class="navigation">
							<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
							<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
						</div>
			
						<?php else : ?>
						
						<h2 class="center">No posts found. Try a different search?</h2>
						<?php endif; ?>

					</ul>
					
					
				</div>
									
                                </div>

                                <div class="clear"></div>
                            </div>							
                        </div>
								
                            
                                
                               

                            </div>
                        </div>
                        <div class="right inner-sidebar ">

                            <div class="banner-block">
                                <?php dynamic_sidebar('default_sidebar');?>
                            </div>

                            <div class="stay">
                                <div class="newsletter">
                                    <h2>OP DE HOOGTE BLIJVEN?</h2>
                                    <?php dynamic_sidebar('mailchimp_sidebar');	?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="blog">
                                <div class="box training">
                                    <?php dynamic_sidebar('training_sidebar');?>
                                </div>

                                <div class="clear"></div>
                            </div>
							
							
							
							 <div class="clearfix"></div>



							
                            <div class="clear"></div>
                            <div class="signin">
                                <div class="head">
                                    <h2>AANMELDEN</h2>
                                </div>
                                <div class="form">
								
                                    <?php echo do_shortcode('[wpmem_form register]');?>	
									
                                    <div class="clearfix"></div>
                                    <a href="#">U bent al lid?</a>
                                    <div class="clearfix"></div>
                                    <a href="<?php the_permalink(120);?>" class="primaryBtn">LOGIN</a>
                                </div>

                            </div>

                           
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

            </div>
            <!-- finish content -->

<?php get_footer(); ?>
