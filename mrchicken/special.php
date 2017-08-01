<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 Template Name: Special

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
	
	// For automatically showing a specific tabs
	$(function(){
		var href = location.href; // get the url
		var split = href.split("#"); // split the string; usually there'll be only one # in an url so there'll be only two parts after the splitting
		if(split[1] != null){
			if(split[1] == 'catering') {
				//$("ul.tabs li").removeClass("active"); //Remove any "active" class
				$("a[href='#tabber1']").parent().removeClass("active");
				$(".tab_content1").hide();
				//$("a[href='#tabber5']").parent().addClass("active");
				//$("#tabber5").fadeIn();
				$("#catering-tab-link").parent().addClass("active");
				$(".catering-content").fadeIn();
			}
		}
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

                

                <ul class="tabs1">

					<?php query_posts('post_type=special&showposts=6'); ?>

                    <?php 

                    $counter=1;

                    while (have_posts()) : the_post(); 
					
					if(the_title('', '', false) == 'Catering') {
						$cater_tab_id = 'id="catering-tab-link" ';
						$catering_position = $counter;
					}
					else {
						$cater_tab_id = '';
					}
					
					?>

                    <li><a <?php echo $cater_tab_id; ?>href="#tabber<?php echo $counter ?>"><?php the_title(); ?></a></li>

                    <?php if($counter==10){$counter=1;}else {$counter++; }endwhile; wp_reset_query(); ?>

                </ul>

            

            </aside>

			

			<?php query_posts('post_type=special&showposts=6'); ?>

            <?php 

            $counter=1;

            while (have_posts()) : the_post(); ?>
			
			<?php
			
				if($counter == $catering_position) {
					$catering_class = ' catering-content';
				}
				else {
					$catering_class = '';
				}
			
			?>

        	<div id="tabber<?php echo $counter ?>" class="tab_content1 details<?php echo $catering_class; ?>">

            	

                <div class="image">

                

            		<?php the_post_thumbnail('menu-image'); ?>

                    

            	</div>

                

                <aside class="list remove">

                    <h2><?php the_title(); ?></h2>
					
                    <?php the_content(); ?>
                    
					<?php if(get_field('submenu')): ?>
                    <ul>
                    	<?php while(has_sub_field('submenu')): ?>
                    	<li>
                        	<h3><?php the_sub_field('title'); ?> <?php $brac=get_sub_field('sub_title'); if(($brac)!="") { ?><span>(<?php the_sub_field('sub_title'); ?>)</span><?php } ?></h3>
                            <span>
								<?php 
									the_sub_field('info'); 
								?> 
								<?php 
									$price=get_sub_field('price'); if(($price)!="") { 
									
									$p_char_l = strlen(get_sub_field('price'));
									
									echo substr('....................', 0, (20 - $p_char_l));
								?>
								
								<span>
									$<?php the_sub_field('price'); ?>
								</span>
								<?php } ?>
							</span>
                            
							<?php if(get_sub_field('quantity_and_prices')): ?>                            
                                <div class="qandp">
									<?php while(has_sub_field('quantity_and_prices')): ?>
                                    <p>
										<span>
											<?php the_sub_field('quantities'); 
												$q_char_length = strlen(get_sub_field('quantities'));
												echo substr('.........................', 0, (25 - $q_char_length)); 
											?>  
										</span> 
										$<?php the_sub_field('price1'); ?>
									</p>
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