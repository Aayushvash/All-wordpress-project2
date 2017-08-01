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
							<?php $img = get_field('big_featured_image_foe_single_page');?>
                                <div class="category_banner" style="background-image:url('<?php echo $img['url'] ;?>');">
                                    <div class="title_and_date_bar">
                                <h4>
									<?php 
									if(have_posts()) : while(have_posts()) : the_post();
									?>
										<?php the_title();?>
										
									<?php endwhile; endif;?>
								</h4>

                    <span class="date">in <b>Leermethodes</b> op <b><?php echo $new_date;?></b></span>

                                    </div>
                                </div>

                                <div class="content_category">
								<?php 
								if(have_posts()) : while(have_posts()) : the_post();
								?>
                                    <?php the_content();?>
									<?php 
									subh_set_post_view( get_the_ID() ); 
									subh_get_post_view(get_the_ID()); 

									?>
									<?php  endwhile; endif;?>
                                </div>

                                <div class="social">
                                    <a class="comment" href="javascript:;"><i class="fa fa-commenting" aria-hidden="true"></i> reageer op dit artikel</a>	
									
									<!-- AddToAny BEGIN -->
									<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
									<a class="a2a_button_facebook">deel op Facebook</a>
									<a class="a2a_button_twitter">deel op Twitter</a>
									</div>
									<script async src="https://static.addtoany.com/menu/page.js"></script>
									<!-- AddToAny END -->
									
                                </div>
								
								
								<!-- start comment block -->
                                <?php comments_template(); ?>
								<!-- end comment block -->
								

                                
                                <!-- b_header -->
                                <div class="b_header">
                                    <div class="b_profile clearfix">
                                        <div class="box info">
											<?php 
											$img = get_field('category_block_icon',18);
											?>
                                            <img src="<?php echo $img;?>" alt="" />
                                        </div>
                                        <div class="box desc">
										
                                            <ul>
                                                <li>
                                                    <h3><?php the_field('category_block_heading',18);?></h3>
													<p><?php echo nl2br(get_field('category_block_content',18));?></p>
                                                </li>
												
												
					<?php 
					$get_cat = array('taxonomy'=>'category','orderby'=>'name','empty'=>0,'number'=>6,'order'=>'ASC');
					$terms = get_categories($get_cat);
					$count = 1;
					$arr = array();
					foreach($terms  as $term)
					{
						//print_r ($term);
						$termSlug = $term->slug;	
						$termId = $term->term_id;					
						$Link = get_term_link( $term );
						$arr[] = $termId ;
					?>
						<?php if($count % 3 == 1){
							echo "<li><ul class='sub'>";
							} 
						?>							
												
                                                <li>
                                                    <a href="<?php echo $Link;?>">
                                                        <?php echo $termSlug;?>
                                                    </a>
                                                </li>
                                              
					<?php if($count % 3 == 0) { 
						echo "</ul></li>";
						}
						$count++;
						}
					?>					  
                                            </ul>
											
                                            <div class="clearfix"></div>
                                        </div>
										
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="b_menu">
                                        <a href="#" class="b_menu"><span>MEER</span></a>
                                        <div class="b_menu_submenu">
                                            <ul>
                                                <?php 
											$taxonomy = array('category');
											$args = array(
												'orderby'=> 'name',
												'order'=>'ASC',
												'hide_empty'=> true,
												'exclude'=>$arr
											);
											$get_Terms = get_terms($taxonomy,$args);
											foreach($get_Terms  as $get_term){
													$slug = $get_term->slug;
													$termlink = get_term_link( $get_term );
											?>
											
											<li>
                                                <a href="<?php echo $termlink;?>">
                                                    <?php echo $slug;?>
                                                </a>
                                            </li>
                                            <?php
												}
											?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <!-- b_header -->

                                <!-- b_content -->
                                <div class="b_content clearfix">

                                    <div class="head_bar category_bar_title clearfix">
                                        <h4>Meest recente artikelen</h4>
                                        

                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="blog_row">
									
					<?php 
					$args = array('post_type'=>'post','showposts'=>3);
					$wp_query = new WP_Query($args);
					if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					?>	
                                        <div class="banner-block recent_block">
                                            <div class="readalso">

                                                <div class="img" style="background:url('<?php echo $feat_image;?>') no-repeat center; background-size:cover;">
                                                    <p><?php the_title();?></p>
                                                </div>
                                                <div class="parah">
                                                    <?php 
													$excerpt= get_the_excerpt();
													?>
                                                    <p>
                                                        <?php echo substr($excerpt, 0, 130);?>
                                                    </p>
                                                    <a href="<?php the_permalink();?>" class="moreBtn">Lees meer</a>
                                                </div>
                                            </div>
                                        </div>
										

					<?php endwhile; endif; wp_reset_query();?>

                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="clearfix"></div>
                                </div>
                                <!-- b_content -->

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

                            <div class="box recent_recentrec">
                                <div class="head">
                                    <h2>RECENTE REACTIES</h2>
                                </div>
                                <div class="reaction">
                                    <ul>
                                        <?php
											$args = array('number' => 2);
											$comments_query = new WP_Comment_Query;
											$comments = $comments_query->query( $args );
											if ( $comments ) {
											foreach ( $comments as $comment ) {
											//print_r($comment);			
											$uid = $comment->user_id ;
											$content = $comment->comment_content;;
											
										?>					
							
										<li>
											<a href="<?php the_permalink($comment->comment_post_ID);?>">
											<?php $author_badge = get_field('profile_photo', 'user_'.$uid ); ?>		
											<?php if($author_badge) { ?>
											
												<i class="img"><img src="<?php echo $author_badge['url']; ?>" alt=""></i>
												<?php } else { ?>
												
												<i class="img"><img src="<?php bloginfo('template_url');?>/images/user.png" alt=""></i>
												<?php } ?>
												
												<p>
													<span class="bld"><?php echo $comment->comment_author;?></span>
													<span class="norml"><?php echo substr($content,0,100);?></span>
												</p>
											</a>
										</li>								
										<?php 
											}
										}
										?>	

                                    </ul>
                                </div>
                            </div>

							
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