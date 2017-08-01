<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 Template Name: Menu

 */



get_header(); ?>



<script type="text/javascript">



$(document).ready(function() {

	//Default Action

	$(".tab_content").hide(); //Hide all content

	$("ul.tabs li:first").addClass("active").show(); //Activate first tab

	$(".tab_content:first").show(); //Show first tab content

	

	//On Click Event

	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$(this).addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content

		$(activeTab).fadeIn(); //Fade in the active content
		
		window.scrollTo(0,0);

		return false;

	});



});

$(document).ready(function() {

	//Default Action

	$(".tab_content1").hide(); //Hide all content

	$("ul.tabs1 li:first").addClass("active").show(); //Activate first tab

	$(".tab_content1:first").show(); //Show first tab content

	

	//On Click Event

	$("ul.tabs1 li").click(function() {

		$("ul.tabs1 li").removeClass("active"); //Remove any "active" class

		$(this).addClass("active"); //Add "active" class to selected tab

		$(".tab_content1").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content

		$(activeTab).fadeIn(); //Fade in the active content

		return false;

	});



});

</script>

<!-- begin content -->
<section id="content-wrap">

    <!-- begin centerwrap -->
    <section id="center-wrap">

        <!-- begin sandwich block -->
        <article class="sandwich-block">
			<div class="centering">
                <aside class="link">
    
                    <ul class="tabs">
                        <?php query_posts('post_type=menu&showposts=6'); ?>
                        <?php 
                        $counter=1;
                        while (have_posts()) : the_post(); ?>
                        <li><a href="#tab<?php echo $counter ?>"><?php the_title(); ?></a></li>
                        <?php if($counter==10){$counter=1;}else {$counter++; }endwhile; wp_reset_query(); ?>
                    </ul>
    
                	</aside>
				<div class="clear"></div>
			<?php query_posts('post_type=menu&showposts=6'); ?>
            <?php 
            $counter=1;
            while (have_posts()) : the_post(); ?>
        	<div id="tab<?php echo $counter ?>" class="tab_content details">

            	<?php the_post_thumbnail('full', array('width' => 454)); ?>

                <aside class="list">

                    

					<?php if(get_field('submenu')): ?>
                    <ul>
                    	<?php while(has_sub_field('submenu')): ?>
                    	<li>
                        	
                        	<h3 style="padding-bottom: 0;"><?php the_sub_field('title'); ?> 
							
							<?php $brac=get_sub_field('sub_title'); if(($brac)!="") { ?>
							
							
							<span>(<?php the_sub_field('sub_title'); ?>)</span>
							
							
							<?php } ?></h3>
							
							
                            <span>
							
							<?php the_sub_field('info'); ?> <?php $price=get_sub_field('price'); if(($price)!="") { ?>
							
							
							<?php
								
								$st_char_l = strlen(get_sub_field('title'));
								
								echo substr('....................', 0, (20 - $st_char_l));
							
							?>
							
							

							<span>$<?php the_sub_field('price'); ?></span><?php } ?></span>
                            
							<?php if(get_sub_field('quantity_and_prices')): ?>                            
                                <div class="qandp">
									<?php while(has_sub_field('quantity_and_prices')): ?>
                                    <p><span><?php the_sub_field('quantities'); ?> 
									
									<?php
										
										$q_char_l = strlen(get_sub_field('quantities'));
										
										echo substr('.............................. ', 0, (30 - $q_char_l));
									
									?>
									
									
									
									
									</span> $<?php the_sub_field('price1'); ?></p>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                            
                        </li>
                    	<?php endwhile; ?>
                    </ul>
                    <?php endif; ?>

                </aside>

            	<div class="clear"></div>

            </div>
            <?php if($counter==10){$counter=1;}else {$counter++; }endwhile; wp_reset_query(); ?>

            
			</div>
            <div class="clear"></div>

        </article>
        <!-- finish sandwich block -->

        <!-- begin order block -->
        <article class="order-block">
			<div class="centering">
            	<aside class="inner">

                	<h2><img src="<?php bloginfo('template_url'); ?>/images/heading1.png" alt="" /></h2>

                <aside class="sidedish">

                    <h3>Side Dishes</h3>

                    <?php if(get_field('side_dishes')): ?>

                    <ul style="padding-bottom:12px;">
                    	<?php while(has_sub_field('side_dishes')): ?>
                        <li><span><?php the_sub_field('title'); ?>. . . . .</span> $<?php the_sub_field('price'); ?></li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>

                    <h4>Choose From:</h4>

                    <?php if(get_field('choose_from')): ?>
                    <ul class="choose">
                    	<?php while(has_sub_field('choose_from')): ?>
                        <li><?php the_sub_field('title'); ?></li>
                        <?php endwhile; ?>
                    </ul>
                	<?php endif; ?>

                </aside>

                <aside class="Dessert">

                    <h3>Desserts</h3>

                    <?php if(get_field('desserts')): ?>
                    <ul>
                    	<?php while(has_sub_field('desserts')): ?>
                        <li><span><?php the_sub_field('title'); ?>. . . . .</span> <?php the_sub_field('price'); ?></li>
                        <?php endwhile; ?>
                    </ul>
              		<?php endif; ?>

                    <h3>Beverages</h3>

                    <?php if(get_field('beverages')): ?>
                    <ul>
                    	<?php while(has_sub_field('beverages')): ?>
                        <li><span><?php the_sub_field('title'); ?>. . . . </span>$<?php the_sub_field('price'); ?></li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>

                    <?php if(get_field('beverages_logo')): ?>
                    <ul class="drink">
                    	<?php while(has_sub_field('beverages_logo')): ?>
                        <li><img src="<?php the_sub_field('logo'); ?>" alt="" /></li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>

                </aside>

                <aside class="extra">

                    <span>
                        <h3>Extras</h3>
                    </span>
        
                    <?php if(get_field('extras')): ?>
                    <ul>
						<?php $stupidHack = 1; ?>
                    	<?php while(has_sub_field('extras')): ?>
						
                        <li>
						
						<span class="left">
						
							<span>
								<?php the_sub_field('title'); ?>
							  </span>
						</span>
                        
						<span class="right">
                       
							<span>. . . . .<?php the_sub_field('price_1'); ?></span>
						
							<span <?php if($stupidHack == 2) ?>>
								<?php the_sub_field('price_2'); ?>
							</span>
							<span><?php the_sub_field('price_3'); ?></span>
						</span>
						
						</li>
						
						<?php $stupidHack++; ?>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>

                    <h3>Kids Meal</h3>

                    <?php if(get_field('kids_meal')): ?>
                    <ul>
                    	<?php while(has_sub_field('kids_meal')): ?>
                        <li class="price">
                        <span class="left"> <?php the_sub_field('title'); ?></span>
                        <span class="right">. . . . .$<?php the_sub_field('price'); ?></span></li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>

                </aside>

            </aside>
			</div>	
        </article>
        <!-- finish order block -->

        <!-- begin sandwich block -->
        <article class="sandwich-block space">
        	<div class="special"><div class="centering"><h5><img src="<?php bloginfo('template_url'); ?>/images/special.png" alt="" /></h5></div></div>
            
        	<div class="centering">
		        <aside class="link">
                
                <ul class="tabs1">
					<?php query_posts('post_type=special&showposts=6'); ?>
                    <?php 
                    $counter=1;
                    while (have_posts()) : the_post(); ?>
                    <li><a href="#tabber<?php echo $counter ?>"><?php the_title(); ?></a></li>
                    <?php if($counter==10){$counter=1;}else {$counter++; }endwhile; wp_reset_query(); ?>
                </ul>

            </aside>
            
            <div class="clear"></div>

				<?php query_posts('post_type=special&showposts=6'); ?>
                <?php 
                $counter=1;
                while (have_posts()) : the_post(); ?>
                <div id="tabber<?php echo $counter ?>" class="tab_content1 details">
    
                    <div class="image">
    
                        <?php the_post_thumbnail('menu-image'); ?>
    
                    </div>
    
                    <aside class="list">
    
                            
                        <?php the_content(); ?>                        	
                                    
                        <?php if(get_field('submenu')): ?>
                        <ul>
                            <?php while(has_sub_field('submenu')): ?>
                            <li>
                                <h3><?php the_sub_field('title'); ?> <?php $brac=get_sub_field('sub_title'); if(($brac)!="") { ?><span>(<?php the_sub_field('sub_title'); ?>)</span><?php } ?></h3>
                                <span><?php the_sub_field('info'); ?> <?php $price=get_sub_field('price'); if(($price)!="") { ?>...................<span>$<?php the_sub_field('price'); ?></span><?php } ?></span>
                                
                                <?php if(get_sub_field('quantity_and_prices')): ?>                            
                                    <div class="qandp">
                                        <?php while(has_sub_field('quantity_and_prices')): ?>
                                        <p><span><?php the_sub_field('quantities'); ?>  ......................... </span> $<?php the_sub_field('price1'); ?></p>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                                
                            </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>
    
                    </aside>
    
                    <div class="clear"></div>
    
                </div>
                <?php if($counter==10){$counter=1;}else {$counter++; }endwhile; wp_reset_query(); ?>

			</div>
            <div class="clear"></div>

        </article>
        <!-- finish sandwich block -->

    </section>
    <!-- finish center wrap -->

</section>
<!-- finish content -->

<?php get_footer(); ?>