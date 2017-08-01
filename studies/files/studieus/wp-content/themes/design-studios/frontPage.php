<?php
/* Template Name: frontpage */
get_header();
?>
	<!-- begin banner -->
		<div id="banner-wrap">
			<div class="centering">
				<!-- begin banner-block -->
				<div class="banner-block clearfix">
					<div class="left">
						<div class="flexslider loader">								  
						  
							<?php
							$posts = get_field('select_banner');
							if( $posts ): ?>
								<ul class="slides">
								<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
									<?php setup_postdata($post); ?>
									<li>
									  <?php the_post_thumbnail('custom-banner');?>
										<div class="text-parah">
										<?php the_title();?>
											
										</div>
										<div class="text-overlay">
											<?php $excerpt = get_the_excerpt();?>
											<p><?php echo substr($excerpt,0,200);?></p>
											<div class="clearfix"></div>
											<a href="<?php the_permalink();?>" class="moreBtn">Lees meer</a>
										</div>
									</li>
								<?php endforeach; ?>
								</ul>
								<?php wp_reset_postdata();  ?>
							<?php endif; ?>					  
						  
						</div>
					</div>
					
						<div class="right">
						<?php dynamic_sidebar('default_sidebar');?>
						</div>
						
					<div class="clearfix"></div>
				</div>
				<!-- finish banner-block -->
			</div>
		</div>
		<!-- finish banner -->
		
		<!-- begin content -->
		<div id="content-wrap">
		
			<div class="studies-block">
				<div class="centering">
					<div class="left">
						<div class="blog">
 
							<!-- b_header -->
							<div class="b_header">
								<div class="b_profile clearfix">
									<div class="box info">
									<?php 
									$img = get_field('category_block_image');
									?>
										<img src="<?php echo $img;?>" alt=""/>
									</div>
									<div class="box desc">
										<ul>
											<li>
												<h3><?php the_field('category_block_title');?></h3>
												<p><?php echo nl2br(get_field('category_block_text'));?></p>
											</li>
											
											
											
<?php 
$post_cat = array('taxonomy'=>'category','orderby'=>'name','empty'=>0,'number'=>6,'order'=>'ASC');
$terms = get_categories($post_cat);
$arr = array() ;
$count = 1;
foreach($terms as $term)
{
$slugname = $term->slug;
$cat_id = $term->term_id;
$slug = $slugname;
$termLink = get_term_link( $term );
$arr[] = $cat_id;
?>

<?php if ($count%3 == 1){ 
	//echo $count; 
?>

<?php echo "<li><ul class='sub'>" ?>

<?php } ?>		

	
<li><a href="<?php echo $termLink;?>"><?php echo $slug; ?></a></li>
	
	

<?php if ($count%3 == 0)
{
echo "</ul></li>";
}
$count++; ?>

<?php } ?>						
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
$taxonomies = array("category");
$args = array( 
'orderby' => 'name',
'order' => 'ASC',
'hide_empty' => true,
'exclude' => $arr	

);
$terms = get_terms($taxonomies, $args);


foreach ( $terms as $term ) {  
  $slug = $term->slug;
  $term_link = get_term_link( $term );
?>
		<li><a href="<?php echo $term_link;?>"><?php echo $slug;?></a></li>
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
								<div class="box recentrec">
									<div class="head">
										<h2>RECENTE REACTIES</h2>										
									</div>
									<div class="reaction">
										<ul>

				<?php
				$args = array('number'=>3);
				$comments_query = new WP_Comment_Query;
				$comments = $comments_query->query( $args );
				if ( $comments ) {
				foreach ( $comments as $comment ) {
					//print_r($comment);
					$time = $comment->comment_date ;				
					$com_id = $comment->comment_ID ;
					$post_id = $comment->comment_post_ID;
				    $uid = $comment->user_id ;				

						//Let's set the current time
						$currentTime = date('Y-m-d H:i:s');
						$toTime = strtotime($currentTime);

						//And the time the notification was set
						$fromTime = strtotime($time);

						//Now calc the difference between the two
						$timeDiff = floor(abs($toTime - $fromTime) / 60);

						//Now we need find out whether or not the time difference needs to be in
						//minutes, hours, or days
												
					
					$comm_title = get_the_title($comment->comment_post_ID);				

				?>										
													
						<li>
							<a href="<?php the_permalink($comment->comment_post_ID);?>">
							  <?php $author_img = get_field('profile_photo', 'user_'.$uid ); ?>
						
								<?php if($author_img) { ?>
								<i class="img"><img src="<?php echo $author_img['url']; ?>" alt=""/></i>
								<?php } else { ?>
								<i class="img"><img src="<?php bloginfo('template_url');?>/images/user.png" alt=""/></i>
								<?php } ?>
								
								<p>
									<span class="bld"><?php echo $comment->comment_author;?></span>
									<span class="norml"><?php echo nl2br($comment->comment_content);?></span>
					<?php			
						if ($timeDiff < 2) {							
							$timeDiff = "Just now";
							echo "<span class='last'><i>".$timeDiff."</i> op <i> ".$comm_title."</i></span>";						
						} elseif ($timeDiff > 2 && $timeDiff < 60) {
							$timeDiff = floor(abs($timeDiff)) . " notulen geleden";
							echo "<span class='last'><i>".$timeDiff."</i>  <i> ".$comm_title."</i></span>";  						
						} elseif ($timeDiff > 60 && $timeDiff < 120) {
							$timeDiff = floor(abs($timeDiff / 60)) . " uur geleden";
							echo "<span class='last'><i>".$timeDiff."</i>  <i> ".$comm_title."</i></span>";	
							
						} elseif ($timeDiff < 1440) {
							$timeDiff = floor(abs($timeDiff / 60)) . " uur geleden";
							echo "<span class='last'><i>".$timeDiff."</i>  <i> ".$comm_title."</i></span>";	
							
						} elseif ($timeDiff > 1440 && $timeDiff < 2880) {
							$timeDiff = floor(abs($timeDiff / 1440)) . " dag geleden";
							echo "<span class='last'><i>".$timeDiff."</i>  <i> ".$comm_title."</i></span>";	
							
						} elseif ($timeDiff > 2880) {
							$timeDiff = floor(abs($timeDiff / 1440)) . " dagen geleden";
							echo "<span class='last'><i>".$timeDiff."</i>  <i> ".$comm_title."</i></span>";
						}
						
					?>					
								</p>
							</a>
						</li>
														
				<?php 	
				}
				} else {
					echo "<span>'No comments found here.'</span>";
					}
				?>										
											
											
										</ul>
										
									</div>
								</div>
								<div class="box training">
									<?php dynamic_sidebar('training_sidebar');?>
								</div>
								<div class="clearfix"></div>
							</div>
							<!-- b_content -->
							
						</div>
					</div>
					<div class="right">
						<div class="stay">
							<div class="newsletter">
								<h2>OP DE HOOGTE BLIJVEN?</h2>								
								<?php 
								dynamic_sidebar('mailchimp_sidebar');
								//echo do_shortcode('[mc4wp_form id="96"]');
								?>
								
								<div class="clearfix"></div>
							</div>
						</div>
						
						<div class="signin">
							<div class="head">
								<h2>AANMELDEN</h2>
							</div>
							<div class="form">
														
						<?php echo do_shortcode('[wpmem_form register]');?>		
				
								
								<div class="clearfix"></div>
								
								<div class="log-btn">
									<a href="#">U bent al lid?</a>
									<div class="clearfix"></div>
									<a href="<?php the_permalink(120);?>" class="primaryBtn">LOGIN</a>
								</div>
								
							</div>
							
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			
		</div>
		<!-- finish content -->

<?php get_footer(); ?>