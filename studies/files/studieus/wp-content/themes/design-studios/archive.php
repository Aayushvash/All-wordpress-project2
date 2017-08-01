<?php get_header(); 
$object = get_queried_object();
//var_dump( $object );
//print_r ($object);
$slg = $object->slug;

$current_url = home_url(add_query_arg(array(),$wp->request));
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
									$img = get_field('category_block_icon',18);
									?>
										<img src="<?php echo $img;?>" alt=""/>
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
						$termLink = get_term_link( $term );
						$arr[] = $termId ;
					?>
						<?php if($count % 3 == 1){
							echo "<li><ul class='sub'>";
							} 
						?>
											
												<li class="<?php if($slg == $termSlug){ echo 'active';}?>">
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
											
											<li class="<?php if($slg == $slug){ echo 'active';}?>">
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
							
<script>
	jQuery(function(){
		
    if (localStorage.selectVal) {        
        jQuery('select').val( localStorage.selectVal );
    }
	
	jQuery('#sorting').change(function(){
		
		var val = jQuery(this).val();
		
		localStorage.setItem('selectVal', val );
		
		//alert(val);
		var word = val.split(" ");
		var order = word[0];
		var sortBy = word[1];
		
		var curl = window.location.href = '<?php echo $current_url; ?>?sortBy='+sortBy+'&order='+order; 
	
		
	});
	
});
</script>						
					<?php 
						$srtby = $_REQUEST['sortBy'];
						$ord = $_REQUEST['order'];
					?>						
					<?php
						$args = array('orderby'=>$srtby,'order'=>$ord);					
					?>
							
							<div class="filter_nav">
								<form>
								<select id="sorting">
									<option value="asc date">Sort by asc date</option>
									<option value="desc date">Sort by desc date</option>
									<option value="asc title">Sort by asc title</option>
									<option value="desc title">Sort by desc title</option>
								</select>
								</form>
							</div>
							
				<div class="blog_row">	

				
					<?php	
					
						if(have_posts()) : 	while(have_posts()) : the_post();
						$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );						
					?>
					
					<div class="banner-block recent_block">
						<div class="readalso">
							 
							<div class="img" style="background:url('<?php echo $feat_image;?>') no-repeat center; background-size:cover;">
							<?php 
								$title =  get_the_title();
								$len = strlen($title);
							 ?>
							 <?php if($len >= 60) {?>
								<p><?php echo substr($title,0,50);?>...</p>
							<?php } else { ?>
								<p><?php the_title();?></p>
							<?php } ?> 
							
							</div>
							<div class="parah">
								<?php 
								$excerpt= get_the_excerpt();
								?>
								<?php //echo $pfx_date = get_the_date($post_id ); ?>
								
								<p><?php echo substr($excerpt, 0, 125);?>... </p>
								<a href="<?php the_permalink();?>" class="moreBtn">Lees meer</a>
							</div>
						</div>
					</div>
					
					<?php endwhile; endif; wp_reset_query();?>
			
					<div class="clearfix"></div>
					
					
					<div class="pagination">
					
					<?php 
					if(function_exists('wp_paginate')){
						wp_paginate(); 
					}					
					?>
					
					</div>					
				 
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
					
					<div class="clearfix"></div>
					
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			
		</div>
		<!-- finish content -->

<?php get_footer(); ?>