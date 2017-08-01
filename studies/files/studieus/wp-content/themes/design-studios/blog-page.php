<?php 
/* template Name: Blog page*/
get_header();

?>

    <!-- begin content -->
    <div id="content-wrap">

        <div class="studies-block inner-page">
            <div class="centering">
                <div class="left">
                    <div class="blog">

                        <!-- b_header -->
                        <div class="b_header">
                            <div class="b_profile clearfix">
                                <div class="box info">
                                    <?php 
									$img = get_field('category_block_icon');
									?>
                                        <img src="<?php echo $img;?>" alt="" />
                                </div>
                                <div class="box desc">
                                    <ul>
                                        <li>
                                            <h3><?php the_field('category_block_heading');?></h3>
                                            <p>
                                                <?php echo nl2br(get_field('category_block_content'));?>
                                            </p>
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
						$termLink = get_term_link( $term );
						$arr[] = $termId ;
					?>

                    <?php if($count % 3 == 1){
						echo "<li><ul class='sub'>";
					} ?>

                                                <li>
                                                    <a href="<?php echo $termLink;?>">
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
													$term_link = get_term_link( $get_term );
											?>
											
                                            <li>
                                                <a href="<?php echo $term_link;?>">
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

                            <div class="head_bar clearfix">
                                <h4>Meest recente artikelen</h4>
                                <span>bekijk alle artikelen <a class="view_all" href="<?php the_permalink(236);?>"></a></span>

                            </div>
                            <div class="clearfix"></div>

                            <div class="blog_row recent">
                    <?php 
					$args = array('post_type'=>'post','showposts'=>3);
					$wp_query = new WP_Query($args);
					if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					?>

                                    <div class="banner-block recent_block">
                                        <div class="readalso">

                                            <div class="img" style="background:url('<?php echo $feat_image;?>') no-repeat center; background-size:cover;">
                                                <p>
                                                    <?php the_title();?>
                                                </p>
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

                            <div class="head_bar clearfix">
                                <h4>Meest gelezen artikelen</h4>
                                <span>bekijk alle artikelen <a class="view_all" href="<?php the_permalink(255);?>"></a></span>

                            </div>
                            <div class="clearfix"></div>
							
							<!-- more read article -->
                            <div class="blog_row read">
							<?php// dynamic_sidebar('most_sidebar'); ?>
							<?php
							$args    = array(
							'numberposts' => 3,  
							'orderby'     => 'meta_value', 
							'meta_key'    => 'post_views_count',
							'order'       => 'ASC',
							'post_type'   => 'post',
							'post_status' => 'publish'
							);
							$myposts = get_posts( $args );
							foreach ( $myposts as $mypost ) {
								//echo '<pre>' , print_r($mypost), '</pre>';
							/* do things here */
							$feat_image = wp_get_attachment_url( get_post_thumbnail_id($mypost->ID) );
							?>
							  <div class="banner-block recent_block">
                                        <div class="readalso">

                                            <div class="img" style="background:url('<?php echo $feat_image;?>') no-repeat center; background-size:cover;" >
                                                <p><?php echo $mypost->post_title; ?></p>
                                            </div>
											<?php $excerpt= $mypost->post_excerpt; ?>
                                            <div class="parah">
                                                <p><?php echo substr($excerpt, 0, 130);?>
                                                </p>
                                                <a href="<?php the_permalink($mypost->ID); ?>" class="moreBtn">Lees meer</a>
                                            </div>
                                        </div>
                                    </div>
								<?php	


									}
									?>					
                                  
                            </div>

                            <div class="clearfix"></div>
					<!--end more read article -->		
							
					<!-- start select cat blog -->
							
					<div class="cat_blog">
						<?php 
						 $variable = get_field('select_category',$post_id);
						 //print_r ($variable );
						 $i=1; 
						 foreach($variable as $value)
						 {
							 $slug = $value->slug;
							// $termId = $value->term_id;
							$Termlink = get_term_link($value);
						 
						?>	
						<div class="blog-row-<?php echo $i; ?>">						
						
                            <div class="head_bar clearfix cate">
                                <h4>Categories: <?php echo $slug;?></h4>
                                <span>less meer in deze categorie<a class="view_all" href="<?php echo $Termlink;?>"></a></span>
                            </div>
                            <div class="clearfix"></div>		
														
                            <div class="blog_row cate">
							
							<?php								 
									$args = array(
									'post_type' => 'post',
									'showposts' => 3 ,
									'tax_query' => array(
														array(
															'taxonomy' => 'category',
															'field' => 'slug',
															'terms' => array($slug)
														),
													),
									);
								$loop = new WP_Query($args);
								if($loop->have_posts()) : 
								
								while($loop->have_posts()) : $loop->the_post();
								?>
								<?php if(get_field('select_post_for_show')) { ?>
                                <div class="banner-block recent_block">
                                    <div class="readalso">

                                        <div class="img">
                                            <p><?php the_title();?></p>
                                        </div>
                                        <div class="parah">
										<?php 
										$excerpt = get_the_excerpt();
										?>
                                            <p><?php echo substr($excerpt,0,130);?></p>
                                            <a href="<?php the_permalink();?>" class="moreBtn">Lees meer</a>
                                        </div>
                                    </div>
                                </div>
								<?php } ?>
								
							<?php endwhile;	wp_reset_query(); endif; ?>
                             
                            </div>
						</div>		
                            <div class="clearfix"></div>
						<?php $i++; } ?>
					</div>
					<!-- end select cat blog -->
					
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

								<?php 
									dynamic_sidebar('mailchimp_sidebar');								
								?>

                                <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="blog">
                        <div class="box training posts">
                            <?php dynamic_sidebar('training_sidebar');?>
                        </div>

                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <div class="signin">
                        <div class="head">
                            <h2>AANMELDEN</h2>
                        </div>
                        <div class="form">
						
						<?php echo do_shortcode('[wpmem_form register]');?>	                           
							<div class="log-btn">
                            <a href="#">U bent al lid?</a>
                            <div class="clearfix"></div>
                            <a href="<?php the_permalink(120);?>" class="primaryBtn">LOGIN</a>
							</div>
                        </div>

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

                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <!-- finish content -->

    <?php //get_sidebar(); ?>

        <?php 
get_footer();
?>