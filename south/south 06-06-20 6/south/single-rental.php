<?php get_header();?>
<div id="banner-wrap" class="inner-brand">
        <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/inventory.jpg" />
		<div class="centring2">
			<div class="bran-logo"><h1><?php the_title(); ?></h1></div>
		</div>
		
	</div>
</div>

<?php
$time=$_GET['time'];
$date=$_GET['date'];
 ?>
 
<!--  content -->
<div id="content" class="content-block">
<!-- finish  header --> 
	<div class="centring3">
		<!--  / left container \ -->
			<div class ="finalBlock">
	
		<div class="left">
			<div class="rental">
				<h2>Rental Summary</h2>
				<ul>
					<li class="wtc"><span>Watercraft:</span><cite><?php the_title(); ?></cite></li>
					<li class="renD"><span>Rental Date:</span><cite><?php echo $date; ?></cite></li>
					<li class="renT"><span>Rental Time:</span><cite><?php if($time==get_field('afternoon',10)){ echo get_field('afternoon',10); }elseif($time==get_field('all_day',10)){ echo get_field('all_day',10); }else { echo get_field('morning',10);}  ?></cite></li>
					<li class="retD"><span>Return Date:</span><cite><?php echo $date; ?></cite></li>
					<li class="retT"><span>Return Time:</span><cite><?php if($time==get_field('afternoon',10)){ echo get_field('afternoon',10); }elseif($time==get_field('all_day',10)){ echo get_field('all_day',10); }else { echo get_field('morning',10); }  ?></cite></li>
				</ul>
			</div>
			<div class="clear"></div>
			<div class="grtandBock">
				<ul>
					<li>Rental Amount:<span class="price"><?php if($time==get_field('afternoon',10)){ the_field('afternoon'); }elseif($time==get_field('all_day',10)){the_field('all_day');}else { the_field('4_hours');}  ?></span></li>
					<li>Accessories:<span class="acc">0</span></li>
					<li>Damage Waiver:<span class="damage">0</span></li>
					<li>Sales Tax: <span class="sales"><?php if(get_field('sales_taxs')){ echo get_field('sales_taxs'); }else { echo "0"; } ?></span></li>
					<li><strong>Grand Total:<span class="grandTotal"><?php if($time==get_field('afternoon',10)){ the_field('afternoon'); }elseif($time==get_field('all_day',10)){the_field('all_day');}else { the_field('4_hours');}  ?></span></strong></li>
				</ul>
			</div>
			
		</div>
		
		<div class="account">
		
			
			
				<h2>Your Account Information</h2>
				
					<div class="logBox">
					<div class="loginSucess">
						<h2>Sign In</h2>
						<form action="" method="post" class="frmlogin"  name="frmlogin">
						<ul>
							<li><label>Email:</label>
							<input type="email" class="field" name="email" required/>
							</li>
							<li><label>Password:</label>
							<input type="password" class="field" name="password" required/>
							</li>
							<li><label>&nbsp;</label><a class="fancybox" href="#forgotBox">Forgot your password?</a></li>
							<li><label>&nbsp;</label><input type="submit" name="submit" class="submit" value="Sign in"/></li>
						</ul>
						</form>
						</div>
						<div class="afterLogBox"> </div>
					</div>

					<div class="logBox newCus">
						<h2>New Customers</h2>
						<p>Get started now. It's fast and easy!</p>
						<a class="register fancybox" href="#registerBox">Register</a>
					</div>
								
				
			</div>
	</div>
	
		<div class="rental-Detail-Block">
			
			<div class="left">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="entry">
				<div class="boatID" style="display: none; "><?php echo get_the_ID(); ?></div>
					<div class="boatInfo">
					    <h2><?php the_title(); ?></h2>
						<ul>
						  <li><span>Brand:</span><?php if(get_field('brand_')) { the_field('brand_'); }else { echo "N/A";}?></li>
						  <li><span>Model:</span><?php if(get_field('model')) { the_field('model'); }else { echo "N/A";}?></li>
						  <li><span>Engine:</span><?php if(get_field('engine')) { the_field('engine'); }else { echo "N/A";}?></li>
						  <li><span>Power:</span><?php if(get_field('power')) { the_field('power'); }else { echo "N/A";}?></li>
						  <li><span>Boat Length:</span><?php if(get_field('length')) { the_field('length'); }else { echo "N/A";}?></li>
						  <li><span>Max Passengers:</span><?php if(get_field('passenger')) { the_field('passenger'); }else { echo "N/A";}?></li>
						  <li><span>Max Weight:</span><?php if(get_field('max_weight')) { the_field('max_weight'); }else { echo "N/A";}?></li>
						</ul>
					</div>
					<div class="boatText">
						<h2>Description</h2>
						<?php the_content(); ?>
					</div>
					<div class="boatrentPrice">
					    <h2>Boat Rental Pricing</h2>
						<ul>
						  <li><span>Morning:</span><?php if(get_field('4_hours')) { echo "$ ".get_field('4_hours'); }else { echo "N/A";}?></li>
						  <li><span>Afternoon:</span><?php if(get_field('afternoon')) { echo "$ ".get_field('afternoon'); }else { echo "N/A";}?></li>
						  <li><span>All Day:</span><?php if(get_field('all_day')) { echo "$ ".get_field('all_day'); }else { echo "N/A";}?></li>
						  <li><strong>*Holiday/seasonal rates not included</strong></li>
						</ul>
					</div>
				</div>
			<?php endwhile; wp_reset_query(); endif;  ?>
			</div>
			
			<div class="right">
			
				<div class="gallerySlider">
				
						<div id="slider" class="flexslider">
							<ul class="slides">
								<?php   if( have_rows('add_images') ): // loop through the rows of data
								while ( have_rows('add_images') ) : the_row();
								$image1=get_sub_field('add_images');	?>
									<li>
									  <img src="<?php echo $image1['sizes']['gallery-thumb']; ?>" />
									</li>
								<?php  endwhile; else :  endif; ?>
							</ul>
						</div>
								
						<div id="carousel" class="flexslider">
							<ul class="slides">
								<?php  if( have_rows('add_images') ): // loop through the rows of data
								while ( have_rows('add_images') ) : the_row();
								$image2=get_sub_field('add_images');	?>
									<li>
									  <img src="<?php echo $image2['sizes']['small-thumb']; ?>" />
									</li>
								<?php  endwhile; else :  endif;   ?>
							</ul>
						</div>
				</div>
        </div>
			
<div class="clear"></div>

	<div class="checkBlock">
				<div class="aleft">

					<div class="accessoriesBlock">
						<h2>Accessories</h2>
						
						<?php $arows = get_field('add_accessories');
						if($arows)
						{ ?>
							<ul>
							<?php foreach($arows as $row){ $image3=$row['image'];?>
								<li>
									<h3><?php echo $row['name']; ?></h3>
									<img src="<?php echo $image3['sizes']['small-thumb']; ?>"/>
									<p><span class="check"></span>$<span class="aprice"><?php echo $row['price']  ?></span></p>
								</li>
							<?php } ?>
							</ul>
						<?php } ?>
                        <div class="clear"></div>
					</div>
                        <div class="clear"></div>
					<div class="damageBlock">
						<h2>Damage Waiver</h2>
						<?php $drows = get_field('add_damage_waive');
						if($drows)
						{ ?>
							<ul>
								<?php foreach($drows as $row){ ?>
									<li>
										<h3><span class="check"></span><?php echo $row['name']; ?></h3>
										<p>$<span class="dprice"><?php echo $row['price']; ?></span></p>
									</li>
								<?php } ?>
							</ul>
					  <?php } ?>
					</div>

				</div>

				<div class="aright">
					<h2>Total</h2>
					<ul>
					   <li><span><?php the_title(); ?>:</span>$ <?php if($time==get_field('afternoon',10)){ the_field('afternoon'); }elseif($time==get_field('all_day',10)){the_field('all_day');}else { the_field('4_hours');}  ?></li>
					</ul>
					<div class="total">$<span class="totlePrice"><?php if($time==get_field('afternoon',10)){ the_field('afternoon'); }elseif($time==get_field('all_day',10) ){the_field('all_day');}else { the_field('4_hours');}  ?></span></div>
					<a class="checkout" herf="javascript:void(0);">Checkout</a>
				</div>
				
			</div>
			
	</div>
	
	<div class="clear"></div>
	
	
			
		<div id="registerBox" style="display:none;">
		    <h2>Get started by entering in your email and chose your password</h2>
				<form action="" method="post" class="frmUpload"  name="frmUpload">
					<ul>
					<li><label>Name:</label>
					<input type="text" class="field" name="name" required/>
					</li>
					<li><label>Phone:</label>
					<input type="text" class="field" name="phone" required/>
					</li>
					<li><label>Email:</label>
					<input type="email" class="field" name="email" required/>
					</li>
					<li><label>Password:</label>
					<input type="password" class="field" name="password" required/>
					</li>
					<li><label>Repeat Password:</label>
					<input type="password" class="field" name="password2" required/>
					</li>
					<li><label>Address:</label>
					<textarea name="address"></textarea>
					</li>
					<li><label>&nbsp;</label><input type="submit" name="submit" class="submit" value="Continue"/></li>
					</ul>
				</form>
				<div class="success"></div>
		</div>
		
		<div id="forgotBox" style="display:none; width: 300px;">
		    <h2>Please enter a valid email address.</h2>
				<form action="" method="post" class="frmforgot"  name="frmforgot">
					<ul>
					<li><label>Email:</label>
					<input type="email" class="field" name="email" required/>
					</li>
					<li><label>&nbsp;</label><input type="submit" name="submit" class="submit" value="Continue"/></li>
					</ul>
				</form>
				<div class="fsucess"></div>
		</div>
		
	<div class="clear"></div>
	</div>

<?php get_footer(); ?>

<script type="text/javascript">

jQuery(window).load(function(){
	jQuery('.fancybox').fancybox();
	jQuery('#carousel').flexslider({
	animation: "slide",
	controlNav: false,
	animationLoop: false,
	slideshow: false,
	prevText: ">",          
	nextText: "<",   
	minItems: 1,
	maxItems: 3,
	itemWidth: 128,
	itemMargin: 0,
	asNavFor: '#slider'
	});

	jQuery('#slider').flexslider({
	animation: "slide",
	controlNav: false,
	animationLoop: true,
	slideshow: true,
	sync: "#carousel",
	start: function(slider){
	jQuery('body').removeClass('loading');
	}
	});
	
	jQuery('.accessoriesBlock ul li').each(function(u){
		
		jQuery(this).click(function(){
			
			
			jQuery(this).toggleClass('active '); 
			
			if(jQuery(this).attr('class')=='active'){ 
				var head = jQuery(this).find('h3').text(); 
			//alert(head);	
			
			var headp = jQuery(this).find(' p').text(); 
		    var ap = jQuery(this).find('.aprice').text();
			var t = jQuery('.aright .total .totlePrice').text();
			jQuery('.aright ul').append('<li class="current'+u+' " id="ddleft"><span >'+head+'</span></li>');
			jQuery('.aright ul').append('<li class="curr'+u+' " id="ddright"><span >'+headp+'</span></li>');
			var at = parseInt(ap)+parseInt(t);
			jQuery('.aright .total .totlePrice').text(at);
			
			}else {			
			jQuery('.aright ul li.current'+u+'').css('display','none');			
			jQuery('.aright ul li.curr'+u+'').css('display','none');			
			
		    var ap = jQuery(this).find('.aprice').text();
			var t = jQuery('.aright .total .totlePrice').text();
			var at = parseInt(t)-parseInt(ap);
			jQuery('.aright .total .totlePrice').text(at);
			 }
			
		});
		
		
	}); 
	
	jQuery('.damageBlock ul li').each(function(u){
		jQuery(this).click(function(){
			jQuery(this).toggleClass('active');
			if(jQuery(this).attr('class')=="active"){
				var headt = jQuery(this).find('h3').text(); 
				var headdp = jQuery(this).find(' p').text(); 
						
			var dp = jQuery(this).find('.dprice').text();
			var t = jQuery('.aright .total .totlePrice').text();
			jQuery('.aright ul').append('<li class="ddmage'+u+'" id="ddleft"><span >'+headt+'</span></li>');
			jQuery('.aright ul').append('<li class="ddpmage'+u+'" id="ddright"><span >'+headdp+'</span></li>');
			var dt = parseInt(dp)+parseInt(t);	
			jQuery('.aright .total .totlePrice').text(dt);
			}else {
				
			jQuery('.aright ul li.ddpmage'+u+'').css('display','none');			
			jQuery('.aright ul li.ddmage'+u+'').css('display','none');
			var dp = jQuery(this).find('.dprice').text();
			var t = jQuery('.aright .total .totlePrice').text();
			var dt = parseInt(t)-parseInt(dp);
			jQuery('.aright .total .totlePrice').text(dt);
			}
			
		});
	});
	
});

</script>