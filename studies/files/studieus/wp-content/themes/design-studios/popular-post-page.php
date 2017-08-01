<?php 
/* template Name: Popular Post Page*/
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
									$img = get_field('category_block_icon' , 18);
									?>
                                        <img src="<?php echo $img;?>" alt="" />
                                </div>
                                <div class="box desc">
                                    <ul>
                                        <li>
                                            <h3><?php the_field('category_block_heading', 18);?></h3>
                                            <p>
                                                <?php echo nl2br(get_field('category_block_content', 18));?>
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

                            <div class="clearfix"></div>

                            <div class="head_bar clearfix">
                                <h4>Meest gelezen artikelen</h4>
                                

                            </div>
                            <div class="clearfix"></div>
							
							<!-- more read article -->
                            <div class="blog_row read">
							<?php// dynamic_sidebar('most_sidebar'); ?>
							<?php
							$args    = array(
							'numberposts' => -1,  
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
							
                            <a href="#">U bent al lid?</a>
                            <div class="clearfix"></div>
                            <a href="<?php the_permalink(120);?>" class="primaryBtn">LOGIN</a>
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