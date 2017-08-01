<?php
require_once('../../../wp-config.php');
query_posts(array('post_type'=>'renteluser','meta_key'=>'email','meta_value'=>$_POST['email']));
if (have_posts()) : while (have_posts()) : the_post();
$id=get_the_ID();
 endwhile; endif; ?>
 <?php if($_POST['email']==get_field('email',$id) && $_POST['password']==get_field('password',$id)){
?>
<h2>Welcome <?php echo get_the_title(); ?></h2>
<ul class="afterLogin">
<li class="name"><span>Name:</span><cite><?php echo get_the_title(); ?></cite></li>
<li><span>Email:</span><?php echo $_POST['email']; ?></li>
<li class="phone"><span>Phone:</span><cite><?php echo get_field('phone'); ?></cite></li>
<li class="address"><span>Address:</span><cite><?php echo get_field('address'); ?></cite></li>
<li><a class="submitInfo" href="javascript:void(0);">Submit Information</a></li>
</ul>
<script type="text/javascript">
jQuery('.loginSucess').hide();
</script>
<?php }else { ?>
<h2>Sorry You Are Not Register User click on New Customer</h2>
<?php } ?>
 
<div class="finalSucess"></div>
<script type="text/javascript">
	jQuery('.submitInfo').click(function() {		
			var url = "<?php bloginfo('template_url'); ?>/mailnewCustomer.php"; 
			jQuery.ajax({
				type: "POST",
				url: url,
				data: { 
				name: jQuery('.afterLogin li.name cite').text(),
				email: "<?php echo $_POST['email']; ?>",
				phone: jQuery('.afterLogin li.phone cite').text() ,
				address: jQuery('.afterLogin li.address cite').text() ,			
				Watercraft:jQuery('.rental li.wtc cite').text(),
				RentalDate:jQuery('.rental li.renD cite').text(),
				RentalTime:jQuery('.rental li.renT cite').text(),
				ReturnDate:jQuery('.rental li.retD cite').text(),
				ReturnTime:jQuery('.rental li.retT cite').text(),
				RentalAmount:jQuery('.grtandBock li .price').text(),
				Accessories:jQuery('.grtandBock li .acc').text(),
				DamageWaiver:jQuery('.grtandBock li .damage').text(),
				SalesTax: jQuery('.grtandBock li .sales').text(),
				GrandTotal:jQuery('.grtandBock li .grandTotal').text(),
				boatID:jQuery('.rental-Detail-Block .boatID').text()
				}, 
				success: function(data)
					{
					  jQuery(".finalSucess").html(data);
					}
			});
			return false; 
		});
</script>